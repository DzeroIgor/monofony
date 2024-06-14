<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Organisation\OrganisationInterface;
use App\Entity\Organisation\Task;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Customer\Model\CustomerInterface;

class TaskRepository extends EntityRepository
{
    public function findProjectTasks($projectId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.project = :projectId')
            ->setParameter('projectId', $projectId)
        ;
    }

    public function findTasksForMember(CustomerInterface $customer, OrganisationInterface $organisation): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->leftJoin('o.author', 'author')
            ->leftJoin('o.project', 'project')
            ->andWhere($qb->expr()->eq('author.customer', ':customer'))
            ->andWhere($qb->expr()->eq('project.organisation', ':organisation'))
            ->setParameter('customer', $customer)
            ->setParameter('organisation', $organisation)
        ;

        return $qb;
    }

    public function findAssignedTasks(CustomerInterface $customer, OrganisationInterface $organisation): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->leftJoin('o.assignee', 'assignee')
            ->leftJoin('o.project', 'project')
            ->andWhere($qb->expr()->eq('project.organisation', ':organisation'))
            ->andWhere($qb->expr()->eq('assignee.customer', ':customer'))
            ->setParameter('customer', $customer)
            ->setParameter('organisation', $organisation)
        ;

        return $qb;
    }
}
