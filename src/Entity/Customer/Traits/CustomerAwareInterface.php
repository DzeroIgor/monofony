<?php

namespace App\Entity\Customer\Traits;

use App\Entity\Customer\CustomerInterface;

interface CustomerAwareInterface
{
    public function getCustomer(): ?CustomerInterface;

    public function setCustomer(?CustomerInterface $customer): void;
}