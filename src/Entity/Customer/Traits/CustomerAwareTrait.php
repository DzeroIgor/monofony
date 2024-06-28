<?php

declare(strict_types=1);

namespace App\Entity\Customer\Traits;

use App\Entity\Customer\CustomerInterface;
use Doctrine\ORM\Mapping as ORM;

trait CustomerAwareTrait
{
    #[ORM\ManyToOne(targetEntity: CustomerInterface::class, cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'customer_id', referencedColumnName: 'id', nullable: true)]
    private ?CustomerInterface $customer = null;

    public function getCustomer(): ?CustomerInterface
    {
        return $this->customer;
    }

    public function setCustomer(?CustomerInterface $customer): void
    {
        $this->customer = $customer;
    }
}
