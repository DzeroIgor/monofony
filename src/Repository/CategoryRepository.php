<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Book\Category;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function findByNamePart(string $phrase, ?int $limit = null): array
    {
        $queryBuilder = $this->createQueryBuilder('o');

        /** @var Category[] $results */
        $results = $queryBuilder
            ->andWhere('o.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }
}
