<?php

declare(strict_types=1);

namespace App\Entity\Task\Traits;

use App\Entity\Task\TaskInterface;
use Doctrine\Common\Collections\Collection;

interface TasksAwareInterface
{
    public function initializeTaskCollection(): void;

    public function getTasks(): Collection;

    public function hasTask(TaskInterface $task): bool;

    public function addTask(TaskInterface $task): void;

    public function removeTask(TaskInterface $task): void;
}
