<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\CodeAwareInterface;
use App\Entity\TimeStampInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;

interface ProjectInterface extends ResourceInterface, CodeAwareInterface, TimeStampInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getTasks(): Collection;

    public function addTask(?Task $task = null): void;

    public function hasTask(?Task $task = null): bool;

    public function removeTask(?Task $task = null): void;

    public function getOrganisation(): ?Organisation;

    public function setOrganisation(?Organisation $organisation): void;
}