<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Organisation\Task;
use Doctrine\ORM\Query\Expr\Join;
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

    public function findTasksForMember(CustomerInterface $customer): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->leftJoin('o.author', 'author')
            ->andWhere($qb->expr()->eq('author.customer', ':customer'))
            ->setParameter('customer', $customer)
        ;

        return $qb;
    }

    public function findAssignedTasks(CustomerInterface $customer): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->leftJoin('o.assignee', 'assignee')
            ->andWhere($qb->expr()->eq('assignee.customer', ':customer'))
            ->setParameter('customer', $customer)
        ;

        return $qb;
    }
}
