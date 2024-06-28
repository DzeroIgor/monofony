<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\Organisation\Traits\OrganisationMembershipsAwareInterface;
use App\Entity\Project\Traits\ProjectsAwareInterface;
use App\Entity\Traits\CodeAwareInterface;
use App\Entity\Traits\TimeStampInterface;
use App\Entity\Traits\ToggleableInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface OrganisationInterface extends
    OrganisationMembershipsAwareInterface,
    ProjectsAwareInterface,
    ToggleableInterface,
    TimeStampInterface,
    CodeAwareInterface,
    ResourceInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function isOwner(CustomerInterface $customer): bool;

    public function getCustomerMember(?CustomerInterface $customer): ?OrganisationMembershipInterface;

    public function getCustomers(): array;
}