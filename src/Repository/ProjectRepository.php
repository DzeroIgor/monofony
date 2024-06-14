<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Customer\Customer;
use App\Entity\Organisation\OrganisationInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function findOrganisationProjects($organisationId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.organisation = :organisationId')
            ->setParameter('organisationId', $organisationId)
        ;
    }

    public function getCustomerProjectsQueryBuilder(OrganisationInterface $organisation): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.organisation = :organisation')
            ->setParameter('organisation', $organisation)
        ;
    }
}
