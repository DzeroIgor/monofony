<?php

declare(strict_types=1);

namespace App\Repository\Organisation;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface OrganisationRepositoryInterface extends RepositoryInterface
{
    public function findOrganisationsForMember(CustomerInterface $customer): QueryBuilder;
}