<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Organisation\OrganisationMembershipInterface;
use App\Form\Type\Customer\CustomerRegistrationType;
use App\Repository\Organisation\OrganisationMembershipRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Workflow\Registry;
use Twig\Environment;

class JoinOrganisationAction
{
    public function __construct(
        private readonly OrganisationMembershipRepositoryInterface $organisationMembershipRepository,
        private readonly FactoryInterface $customerFactory,
        private readonly EntityManagerInterface $entityManager,
        private readonly FormFactoryInterface $formFactory,
        private readonly Environment $twig,
        private readonly Security $security,
        private readonly RouterInterface $router,
        private readonly Registry $registry,
    ) {
    }

    public function __invoke(Request $request, string $token): Response
    {
        /** @var OrganisationMembershipInterface $member */
        $member = $this->organisationMembershipRepository->findOneBy(['emailVerificationToken' => $token]);

        if (!$member) {
            throw new \InvalidArgumentException('invalid token');
        }

        $customer = $member->getCustomer();

        if (null !== $customer) {
            $this->registry->get($member, 'app_organisation_membership')->apply($member, 'accept_membership');

            $member->getCustomer()->getUser()->isVerified(true);
            $member->getCustomer()->getUser()->setVerifiedAt(new \DateTime());
            $member->setEmailVerificationToken(null);
            $member->setVerified(new \DateTime());


            $this->entityManager->persist($customer);
            $this->entityManager->flush();

            $this->security->login($customer->getUser(), 'form_login', 'app');

            return new RedirectResponse($this->router->generate('sylius_frontend_account_dashboard'));
        }

        $customer = $this->customerFactory->createNew();
        $customer->setEmail($member->getEmail());
        $customer->setEmailCanonical($member->getEmail());

        $form = $this->formFactory->create(CustomerRegistrationType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $member->setCustomer($customer);
            $member->setEmailVerificationToken(null);
            $member->setVerified(new \DateTime());

            $this->registry->get($member, 'app_organisation_membership')->apply($member, 'accept_membership');

            $member->getCustomer()->getUser()->isVerified(true);
            $member->getCustomer()->getUser()->setVerifiedAt(new \DateTime());

            $this->entityManager->persist($customer);
            $this->entityManager->flush();

            $this->security->login($customer->getUser(), 'form_login', 'app');

            return new RedirectResponse($this->router->generate('sylius_frontend_account_dashboard'));
        }

        $content = $this->twig->render(
            'frontend/organisation_membership/join.html.twig',
            [
                'form' => $form->createView(),
            ]
        );

        return new Response($content);
    }
}
