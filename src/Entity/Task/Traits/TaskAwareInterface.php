<?php

namespace App\Entity\Task\Traits;

use App\Entity\Task\TaskInterface;

interface TaskAwareInterface
{
    public function getTask(): ?TaskInterface;

    public function setTask(?TaskInterface $task): void;
}