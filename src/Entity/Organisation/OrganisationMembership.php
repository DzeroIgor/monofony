<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\Customer\Traits\CustomerAwareTrait;
use App\Entity\Organisation\Traits\OrganisationAwareTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\TimeStampTrait;
use App\Entity\Traits\ToggleableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AssociationOverride;
use Doctrine\ORM\Mapping\JoinColumn;
use Sylius\Component\Customer\Model\CustomerInterface;

#[ORM\Entity]
#[ORM\AssociationOverrides([
    new AssociationOverride(
        name: 'customer',
        joinColumns: new JoinColumn(
            name: 'customer_id',
            referencedColumnName: 'id',
            nullable: true,
            onDelete: 'CASCADE'
        ),
        inversedBy: 'members'
    ),
    new AssociationOverride(
        name: 'organisation',
        joinColumns: new JoinColumn(
            name: 'organisation_id',
            referencedColumnName: 'id',
            nullable: true,
            onDelete: 'CASCADE'
        ),
        inversedBy: 'members'
    ),
])]
#[ORM\Table(name: 'app_organisation_membership')]
class OrganisationMembership implements OrganisationMembershipInterface
{
    use OrganisationAwareTrait;
    use CustomerAwareTrait;
    use IdentifiableTrait;
    use ToggleableTrait;
    use TimeStampTrait;

    #[ORM\Column(type: 'string', enumType: Position::class)]
    private ?Position $position = Position::TeamLeader;

    #[ORM\Column(type: 'string', enumType: Role::class)]
    private ?Role $role = null;

    #[ORM\Column(type: 'string', enumType: OrganisationMembershipStatus::class)]
    private ?OrganisationMembershipStatus $status = OrganisationMembershipStatus::new;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $emailVerificationToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $verified = null;

    public function __toString(): string
    {
        if (null !== $this->customer) {
            return $this->customer->getEmail();
        }

        return $this->email;
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

    public function getName(): string
    {
        $customer = $this->getCustomer();

        if (null !== $customer) {
            return $customer->getFullName();
        }

        return $this->email ?? '';
    }

    public function getStateAsString(): string
    {
        return $this->status->value;
    }

    public function setStateAsString(string $stateAsString): OrganisationMembership
    {
        $this->status = OrganisationMembershipStatus::from($stateAsString);

        return $this;
    }
}
