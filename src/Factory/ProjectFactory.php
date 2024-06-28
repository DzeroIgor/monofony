<?php

namespace App\Factory;

use App\Entity\Organisation\Organisation;
use App\Entity\Project\Project;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ProjectFactory implements FactoryInterface
{
    public function __construct(
        private readonly FactoryInterface $decorated,
    ) {
    }

    public function createNew(): Project
    {
        return $this->decorated->createNew();
    }

    public function createNewWithOrganisation(?Organisation $organisation = null): Project
    {
        $project = $this->createNew();

        $project->setOrganisation($organisation);

        return $project;
    }
}
