<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use Sylius\Component\Resource\Model\ResourceInterface;

interface TimeSlotInterface extends ResourceInterface
{
    public function getDuration(): ?\DateInterval;

    public function setDuration(?\DateInterval $duration): void;

    public function getTask(): ?Task;

    public function setTask(?Task $task): void;

    public function getDate(): ?\DateTimeInterface;

    public function setDate(?\DateTimeInterface $date): void;
}