<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class ProjectTaskRepository extends EntityRepository
{
    public function findProjectTasks($projectId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.project = :projectId')
            ->setParameter('projectId', $projectId)
        ;
    }
}
