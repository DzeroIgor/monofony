<?php

declare(strict_types=1);

namespace App\Entity\Organisation\Traits;

use App\Entity\Organisation\OrganisationMembership;

interface AssigneeOrganisationMembershipsAwareInterface
{
    public function getAssignee(): ?OrganisationMembership;

    public function setAssignee(?OrganisationMembership $assignee): void;
}
