<?php

namespace App\Factory;

use App\Entity\Organisation\Organisation;
use App\Entity\Organisation\OrganisationInterface;
use App\Entity\Organisation\OrganisationMembershipInterface;
use App\Entity\Organisation\Role;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class MemberFactory implements FactoryInterface
{
    public function __construct(
        private readonly FactoryInterface $decorated,
    ) {
    }

    public function createNew(): OrganisationMembershipInterface
    {
        return $this->decorated->createNew();
    }

    public function createNewWithOrganisation(?OrganisationInterface $organisation = null): OrganisationMembershipInterface
    {
        $member = $this->createNew();

        $member->setOrganisation($organisation);

        return $member;
    }

    public function createNewWithCustomer(?Organisation $organisation, ?CustomerInterface $customer): OrganisationMembershipInterface
    {
        $member = $this->createNewWithOrganisation($organisation);
        $member->setCustomer($customer);
        $member->setRole(Role::ROLE_OWNER);

        return $member;
    }
}
