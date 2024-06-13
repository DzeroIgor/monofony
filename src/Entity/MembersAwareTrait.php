<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Organisation\OrganisationMembership;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait MembersAwareTrait
{
    public function initializeMembersCollection(): void
    {
        $this->members = new ArrayCollection();
    }

    /**
     * @return Collection|OrganisationMembership[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function setMembers(Collection $members): void
    {
        $this->members = $members;
    }

    public function addMember(?OrganisationMembership $member = null): void
    {
        if (!$this->hasMember($member)) {
            $this->members->add($member);
        }
    }
    public function hasMember(?OrganisationMembership $member = null): bool
    {
        return $this->members->contains($member);
    }

    public function removeMember(?OrganisationMembership $member = null): void
    {
        if ($this->hasMember($member)) {
            $this->members->removeElement($member);
        }
    }
}