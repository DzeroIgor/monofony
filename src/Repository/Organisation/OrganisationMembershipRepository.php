<?php

declare(strict_types=1);

namespace App\Repository\Organisation;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class OrganisationMembershipRepository extends EntityRepository implements OrganisationMembershipRepositoryInterface
{
    // function for anonymous function in field assignee to filter assignees in the CustomerTaskType
    public function findOrganisationMembers($organisationId): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->andWhere($qb->expr()->eq('o.organisation', ':organisationId'))
            ->setParameter('organisationId', $organisationId)
        ;

        return $qb;
    }

    public function findOrganisationMemberships(?string $phrase = null, ?string $organisationId = null, ?int $limit = 100): array
    {
        $qb = $this->createQueryBuilder('o');

        if (null !== $organisationId) {
            $qb
                ->leftJoin('o.organisation', 'organisation')
                ->andWhere('organisation.id = :organisationId')
                ->setParameter('organisationId', $organisationId)
            ;
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}
