<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\Customer\Traits\CustomerAwareInterface;
use App\Entity\Organisation\Traits\OrganisationAwareInterface;
use App\Entity\Traits\TimeStampInterface;
use App\Entity\Traits\ToggleableInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface OrganisationMembershipInterface extends
    OrganisationAwareInterface,
    CustomerAwareInterface,
    ResourceInterface,
    ToggleableInterface,
    TimeStampInterface
{
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

    public function getName(): string;
}
