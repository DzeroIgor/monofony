<?php

declare(strict_types=1);

namespace App\Entity\Task;

use App\Entity\Organisation\Traits\AssigneeOrganisationMembershipsAwareInterface;
use App\Entity\Organisation\Traits\AuthorOrganisationMembershipsAwareInterface;
use App\Entity\Traits\CodeAwareInterface;
use App\Entity\Traits\TimeSlotsAwareInterface;
use App\Entity\Traits\TimeStampInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface TaskInterface extends
    AuthorOrganisationMembershipsAwareInterface,
    AssigneeOrganisationMembershipsAwareInterface,
    TimeSlotsAwareInterface,
    ResourceInterface,
    TimeStampInterface,
    CodeAwareInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getStatus(): ?TaskStatus;

    public function setStatus(?TaskStatus $status): void;

    public function getCompletedAt(): ?\DateTimeInterface;

    public function setCompletedAt(?\DateTimeInterface $completedAt): void;
}

