<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\Customer\Customer;
use App\Entity\TimeStampInterface;
use App\Entity\ToggleableInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface OrganisationMembershipInterface extends ResourceInterface, ToggleableInterface, TimeStampInterface
{
    public function getOrganisation(): ?Organisation;

    public function setOrganisation(?Organisation $organisation): void;

    public function getCustomer(): ?Customer;

    public function setCustomer(?Customer $customer): void;

    public function getPosition(): ?Position;

    public function setPosition(?Position $position): void;

    public function getRole(): ?Role;

    public function setRole(?Role $role): void;

    public function getStatus(): ?OrganisationMembershipStatus;

    public function setStatus(?OrganisationMembershipStatus $status): void;

    public function getEmail(): ?string;

    public function setEmail(?string $email): void;

    public function getEmailVerificationToken(): ?string;

    public function setEmailVerificationToken(?string $emailVerificationToken): void;

    public function getVerified(): ?\DateTimeInterface;

    public function setVerified(?\DateTimeInterface $verified): void;

    public function isOwner(CustomerInterface $customer): bool;

}