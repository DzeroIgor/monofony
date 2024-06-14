<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\CodeAwareInterface;
use App\Entity\TimeStampInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface TaskInterface extends ResourceInterface, TimeStampInterface, CodeAwareInterface
{
    public function getProject(): ?Project;

    public function setProject(?Project $project): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getStatus(): ?TaskStatus;

    public function setStatus(?TaskStatus $status): void;

    public function getAuthor(): ?OrganisationMembership;

    public function setAuthor(?OrganisationMembership $author): void;

    public function isAuthor(CustomerInterface $customer): bool;

    public function getAssignee(): ?OrganisationMembership;

    public function setAssignee(?OrganisationMembership $assignee): void;

    public function getCompletedAt(): ?\DateTimeInterface;

    public function setCompletedAt(?\DateTimeInterface $completedAt): void;
}

