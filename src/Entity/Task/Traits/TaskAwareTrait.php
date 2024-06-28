<?php

declare(strict_types=1);

namespace App\Entity\Task\Traits;

use App\Entity\Task\TaskInterface;
use Doctrine\ORM\Mapping as ORM;

trait TaskAwareTrait
{
    #[ORM\ManyToOne(targetEntity: TaskInterface::class, cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'task_id', referencedColumnName: 'id', nullable: true)]
    protected ?TaskInterface $task = null;

    public function getTask(): ?TaskInterface
    {
        return $this->task;
    }

    public function setTask(?TaskInterface $task): void
    {
        $this->task = $task;
    }
}
