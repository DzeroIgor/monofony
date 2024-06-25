<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Organisation\OrganisationInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Customer\Model\CustomerInterface;

class TaskRepository extends EntityRepository
{
    // function for displaying the tasks of a project in the Task grid - backend
    public function findProjectTasks($projectId): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->andWhere($qb->expr()->eq('o.project', ':projectId'))
            ->setParameter('projectId', $projectId)
        ;

        return $qb;
    }

    // function for displaying the tasks of a logged user like author in the Task grid - frontend
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

    // function for displaying the tasks of a logged user like assignee in the AssignedTask grid - frontend
    public function findAssignedTasks(CustomerInterface $customer, OrganisationInterface $organisation): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->leftJoin('o.assignee', 'assignee')
            ->leftJoin('o.project', 'project')
            ->andWhere($qb->expr()->eq('assignee.customer', ':customer'))
            ->andWhere($qb->expr()->eq('project.organisation', ':organisation'))
            ->setParameter('customer', $customer)
            ->setParameter('organisation', $organisation)
        ;

        return $qb;
    }
}
