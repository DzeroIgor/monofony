<?php

declare(strict_types=1);

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationMembershipInterface;
use Doctrine\Common\Collections\Collection;

interface OrganisationMembershipsAwareInterface
{
    public function initializeMemberCollection(): void;

    public function getMembers(): Collection;

    public function setMembers(Collection $members): void;

    public function addMember(?OrganisationMembershipInterface $member = null): void;

    public function hasMember(?OrganisationMembershipInterface $member = null): bool;

    public function removeMember(?OrganisationMembershipInterface $member = null): void;
}