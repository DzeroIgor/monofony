<?php

namespace App\Factory;

use App\Entity\Organisation\OrganisationInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class OrganisationFactory implements FactoryInterface
{
    public function __construct(
        private readonly FactoryInterface $decorated,
        private readonly FactoryInterface $organisationMembershipFactory
    ) {
    }

    public function createNew(): OrganisationInterface
    {
        return $this->decorated->createNew();
    }

    public function createNewOrganisationWithMember(?CustomerInterface $customer): OrganisationInterface
    {
        $organisation = $this->createNew();
        $member = $this->organisationMembershipFactory->createNewWithCustomer($organisation, $customer);

        $organisation->addMember($member);

        return $organisation;
    }
}
