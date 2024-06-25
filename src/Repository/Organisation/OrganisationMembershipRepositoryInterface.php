<?php

declare(strict_types=1);

namespace App\Repository\Organisation;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface OrganisationMembershipRepositoryInterface extends RepositoryInterface
{
    public function findOrganisationMembers($organisationId): QueryBuilder;

    public function findOrganisationMemberships(?string $phrase = null, ?string $organisationId = null, ?int $limit = 100): array;
}
