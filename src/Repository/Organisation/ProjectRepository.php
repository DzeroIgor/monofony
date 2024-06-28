<?php

declare(strict_types=1);

namespace App\Repository\Organisation;

use App\Entity\Organisation\OrganisationInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository implements ProjectRepositoryInterface
{
    // function for displaying the projects of an organisation in the Project grid - backend
    public function findOrganisationProjects($organisationId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.organisation = :organisationId')
            ->setParameter('organisationId', $organisationId)
        ;
    }

    public function findOrganisationTaskProjects(?string $phrase = null, ?string $organisationId = null, ?int $limit = 100): array
    {
        $qb = $this->createQueryBuilder('o');

        if (null !== $organisationId) {
            $qb
                ->andWhere('o.organisation = :organisationId')
                ->setParameter('organisationId', $organisationId)
            ;
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    // function for displaying the projects of a logged user in the Project grid - frontend
    public function findProjectForMember(OrganisationInterface $organisation): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->andWhere($qb->expr()->eq('o.organisation', ':organisation'))
            ->setParameter('organisation', $organisation)
        ;

        return $qb;
    }

    // function for anonymous function in field project to set project in the CustomerTaskType
    public function getCustomerProjectsQueryBuilder(OrganisationInterface $organisation): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.organisation = :organisation')
            ->setParameter('organisation', $organisation)
        ;
    }
}
