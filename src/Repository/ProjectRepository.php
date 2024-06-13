<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Customer\Customer;
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

    public function getCustomerProjectsQueryBuilder(Customer $customer): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.organisation', 'organisation')
            ->leftJoin('organisation.members', 'members')
            ->andWhere('members.customer = :customer')
            ->setParameter('customer', $customer)
        ;
    }
}
