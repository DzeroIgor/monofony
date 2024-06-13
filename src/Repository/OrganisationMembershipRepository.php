<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class OrganisationMembershipRepository extends EntityRepository
{
    public function findOrganisationMembers($organisationId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.organisation = :organisationId')
            ->setParameter('organisationId', $organisationId)
        ;
    }
}
