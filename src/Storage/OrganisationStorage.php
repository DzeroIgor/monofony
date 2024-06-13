<?php

declare(strict_types=1);

namespace App\Storage;

use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Storage\StorageInterface;

class OrganisationStorage implements OrganisationStorageInterface
{
    public function __construct(private readonly StorageInterface $storage)
    {
    }

    public function set(CustomerInterface $customer, string $organisationCode): void
    {
        $this->storage->set($this->provideKey($customer), $organisationCode);
    }

    public function get(CustomerInterface $customer): ?string
    {
        return $this->storage->get($this->provideKey($customer));
    }

    private function provideKey(CustomerInterface $customer): string
    {
        return '_organisation_'.$customer->getEmailCanonical();
    }
}
