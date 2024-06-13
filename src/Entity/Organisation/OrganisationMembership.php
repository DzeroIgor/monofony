<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\Customer\Customer;
use App\Entity\IdentifiableTrait;
use App\Entity\TimeStampTrait;
use App\Entity\ToggleableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Customer\Model\CustomerInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_organisation_membership')]
class OrganisationMembership implements OrganisationMembershipInterface
{
    use IdentifiableTrait;

    use ToggleableTrait;

    use TimeStampTrait;

    #[ORM\ManyToOne(targetEntity: Organisation::class, inversedBy: 'members')]
    private ?Organisation $organisation = null;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'members')]
    private ?Customer $customer = null;

    #[ORM\Column(type: 'string', enumType: Position::class)]
    private ?Position $position = Position::TeamLeader;

    #[ORM\Column(type: 'string', enumType: Role::class)]
    private ?Role $role = null;

    #[ORM\Column(type: 'string', enumType: OrganisationMembershipStatus::class)]
    private ?OrganisationMembershipStatus $status = OrganisationMembershipStatus::New;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $email = null;

     #[ORM\Column(type: 'string', nullable: true)]
    private ?string $emailVerificationToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $verified = null;

    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    public function setOrganisation(?Organisation $organisation): void
    {
        $this->organisation = $organisation;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): void
    {
        $this->position = $position;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): void
    {
        $this->role = $role;
    }

    public function getStatus(): ?OrganisationMembershipStatus
    {
        return $this->status;
    }

    public function setStatus(?OrganisationMembershipStatus $status): void
    {
        $this->status = $status;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEmailVerificationToken(): ?string
    {
        return $this->emailVerificationToken;
    }

    public function setEmailVerificationToken(?string $emailVerificationToken): void
    {
        $this->emailVerificationToken = $emailVerificationToken;
    }

    public function getVerified(): ?\DateTimeInterface
    {
        return $this->verified;
    }

    public function setVerified(?\DateTimeInterface $verified): void
    {
        $this->verified = $verified;
    }

    public function isOwner(CustomerInterface $customer): bool
    {
        return $this->getCustomer() === $customer && $this->role->isOwner();
    }

    public function __toString(): string
    {
        if (null !== $this->customer) {
            return $this->customer->getEmail();
        }

        return $this->email;
    }
}