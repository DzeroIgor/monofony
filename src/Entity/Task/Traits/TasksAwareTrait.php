<?php

declare(strict_types=1);

namespace App\Entity\Task\Traits;

use App\Entity\Task\TaskInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TasksAwareTrait
{
    /** @var Collection|TaskInterface[] */
    protected Collection $tasks;

    public function initializeTaskCollection(): void
    {
        $this->tasks = new ArrayCollection();
    }

    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function hasTask(TaskInterface $task): bool
    {
        return $this->tasks->contains($task);
    }

    public function addTask(TaskInterface $task): void
    {
        if (false === $this->hasTask($task)) {
            $this->tasks->add($task);
        }
    }

    public function removeTask(TaskInterface $task): void
    {
        if (true === $this->hasTask($task)) {
            $this->tasks->removeElement($task);
        }
    }
}
