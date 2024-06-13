<?php

declare(strict_types=1);

namespace App\Storage;

use Sylius\Component\Customer\Model\CustomerInterface;

interface OrganisationStorageInterface
{
    public function set(CustomerInterface $customer, string $organisationCode): void;

    public function get(CustomerInterface $customer): ?string;
}