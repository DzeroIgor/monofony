<?php

declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\Organisation\Traits\OrganisationAwareInterface;
use App\Entity\Task\Traits\TasksAwareInterface;
use App\Entity\Traits\CodeAwareInterface;
use App\Entity\Traits\TimeStampInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface ProjectInterface extends
    OrganisationAwareInterface,
    TasksAwareInterface,
    CodeAwareInterface,
    TimeStampInterface,
    ResourceInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;
}
