<?php

declare(strict_types=1);

namespace App\Context;

use App\Entity\Organisation\OrganisationInterface;
use App\Repository\OrganisationRepository;
use App\Storage\OrganisationStorageInterface;

class OrganisationContext
{
    public function __construct(
        private readonly CustomerContext $customerContext,
        private readonly OrganisationStorageInterface $organisationStorage,
        private readonly OrganisationRepository $organisationRepository,
    ) {
    }

    public function getOrganisation(): ?OrganisationInterface
    {
        if (null === $customer = $this->customerContext->getCustomer()) {
            return null;
        }

        $organisationCode = $this->organisationStorage->get($customer);

        if (null !== $organisationCode) {
            $organisation = $this->organisationRepository->findOneBy(['code' => $organisationCode]);

            if (null !== $organisation) {
                return $organisation;
            }
        }

        $organisations = $customer->getOrganisations();

        if (empty($organisations)) {
            return null;
        }

        return current($organisations);
    }
}
