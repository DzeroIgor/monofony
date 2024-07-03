<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Organisation\OrganisationMembershipInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Workflow\Registry;

final class OrganisationMembershipRegistrationSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly Registry $registry)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'app.organisation_membership.pre_create' => 'preCreate',
        ];
    }

    public function preCreate(GenericEvent $event): void
    {
        /** @var OrganisationMembershipInterface $member */
        $member = $event->getSubject();

        if (null !== $member->getCustomer()) {
            return;
        }

        $this->registry->get($member, 'app_organisation_membership')->apply($member, 'request_verification');
    }
}
