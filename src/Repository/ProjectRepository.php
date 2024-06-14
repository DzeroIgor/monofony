<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Organisation\OrganisationInterface;
use App\Entity\Organisation\OrganisationMembershipInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Customer\Model\CustomerInterface;

class ProjectRepository extends EntityRepository
{
    public function findOrganisationProjects($organisationId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.organisation = :organisationId')
            ->setParameter('organisationId', $organisationId)
        ;
    }

    public function findProjectForMember(OrganisationInterface $organisation): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->andWhere($qb->expr()->eq('o.organisation', ':organisation'))
            ->setParameter('organisation', $organisation)
        ;

        return $qb;
    }

    public function getCustomerProjectsQueryBuilder(OrganisationInterface $organisation): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.organisation = :organisation')
            ->setParameter('organisation', $organisation)
        ;
    }
}
