<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Organisation\OrganisationMembershipInterface;
use App\Entity\Organisation\OrganisationMembershipStatus;
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

class DeniedOrganisationAction
{
    public function __construct(
        private readonly OrganisationMembershipRepositoryInterface $organisationMembershipRepository,
        private readonly EntityManagerInterface $entityManager,
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

        $this->registry->get($member, 'app_organisation_membership')->apply($member, 'deny_membership');
        $member->setEmailVerificationToken(null);

        $this->entityManager->persist($member);
        $this->entityManager->flush();

        return new RedirectResponse($this->router->generate('app_frontend_homepage'));
    }
}
