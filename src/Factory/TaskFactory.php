<?php

namespace App\Factory;

use App\Entity\Organisation\OrganisationInterface;
use App\Entity\Organisation\Project;
use App\Entity\Organisation\Task;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class TaskFactory implements FactoryInterface
{
    public function __construct(
        private readonly FactoryInterface $decorated,
    ) {
    }

    public function createNew(): Task
    {
        return $this->decorated->createNew();
    }

    public function createNewWithProject(?Project $project = null): Task
    {
        $task = $this->createNew();

        $task->setProject($project);

        return $task;
    }

    public function createNewWithAuthor(?OrganisationInterface $organisation, ?CustomerInterface $customer): Task
    {
        $task = $this->createNew();

        $member = $organisation->getCustomerMember($customer);
        $task->setAuthor($member);

        return $task;
    }
}