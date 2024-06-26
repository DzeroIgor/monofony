<?php

declare(strict_types=1);

namespace App\Repository\Organisation;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Customer\Model\CustomerInterface;

class OrganisationRepository extends EntityRepository implements OrganisationRepositoryInterface
{
    // function for displaying the organisations of a member in the grid
    public function findOrganisationsForMember(CustomerInterface $customer): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o')
            ->addSelect('members')
            ->leftJoin('o.members', 'members')
            ->where('members.customer = :customer')
            ->setParameter('customer', $customer)
        ;

        return $qb;
    }
}
