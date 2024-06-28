<?php

declare(strict_types=1);

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationMembership;
use App\Entity\Organisation\OrganisationMembershipInterface;
use Doctrine\ORM\Mapping as ORM;

trait AssigneeOrganisationMembershipsAwareTrait
{
    #[ORM\ManyToOne(targetEntity: OrganisationMembershipInterface::class)]
    private ?OrganisationMembershipInterface $assignee = null;

    public function getAssignee(): ?OrganisationMembership
    {
        return $this->assignee;
    }

    public function setAssignee(?OrganisationMembership $assignee): void
    {
        $this->assignee = $assignee;
    }
}
