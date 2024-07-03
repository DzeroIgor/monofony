<?php

namespace App\Workflow\EventListener;

use Sylius\Component\User\Security\Generator\GeneratorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Workflow\Event\TransitionEvent;

class OrganisationMembershipStatusWorkflowEventListener implements EventSubscriberInterface
{
    public function __construct(private readonly MailerInterface $mailer, private readonly GeneratorInterface $tokenGenerator)
    {
    }

    public function onRequestVerificationTransition(TransitionEvent $event): void
    {
        $member = $event->getSubject();
        $token = $this->tokenGenerator->generate();
        $member->setEmailVerificationToken($token);

        $email = (new TemplatedEmail())
            ->from('support@example.com')
            ->to($member->getEmail())
            ->subject('New Organisation Membership Request!')
            ->htmlTemplate('emails/signup.html.twig')
            ->context([
                'emailVerificationToken' => $token,
                'member' => $member,
            ])
        ;

        $this->mailer->send($email);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.app_organisation_membership.transition.request_verification' => 'onRequestVerificationTransition',
        ];
    }
}
