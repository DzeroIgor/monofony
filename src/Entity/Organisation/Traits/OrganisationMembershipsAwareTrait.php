<?php

declare(strict_types=1);

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationMembershipInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait OrganisationMembershipsAwareTrait
{
    public function initializeMemberCollection(): void
    {
        $this->members = new ArrayCollection();
    }

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function setMembers(Collection $members): void
    {
        $this->members = $members;
    }

    public function addMember(?OrganisationMembershipInterface $member = null): void
    {
        if (!$this->hasMember($member)) {
            $this->members->add($member);
        }
    }

    public function hasMember(?OrganisationMembershipInterface $member = null): bool
    {
        return $this->members->contains($member);
    }

    public function removeMember(?OrganisationMembershipInterface $member = null): void
    {
        if ($this->hasMember($member)) {
            $this->members->removeElement($member);
        }
    }
}
