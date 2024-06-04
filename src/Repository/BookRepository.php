<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository
{
    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');

        return $qb
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere($qb->expr()->eq('translation.locale', ':locale'))
            ->setParameter('locale', $locale)
        ;
    }
}