<?php

declare(strict_types=1);

namespace App\Repository\Organisation;

use App\Entity\Organisation\OrganisationInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ProjectRepositoryInterface extends RepositoryInterface
{
    public function findOrganisationProjects($organisationId): QueryBuilder;

    public function findProjectForMember(OrganisationInterface $organisation): QueryBuilder;

    public function getCustomerProjectsQueryBuilder(OrganisationInterface $organisation): QueryBuilder;
}
