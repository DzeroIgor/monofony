<?php

declare(strict_types=1);

namespace App\Repository\Organisation;

use App\Entity\Organisation\OrganisationInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface TaskRepositoryInterface extends RepositoryInterface
{
    public function findProjectTasks($projectId): QueryBuilder;

    public function findTasksForMember(CustomerInterface $customer, OrganisationInterface $organisation): QueryBuilder;

    public function findAssignedTasks(CustomerInterface $customer, OrganisationInterface $organisation): QueryBuilder;
}
