<?php

declare(strict_types=1);

namespace App\Entity\Task;

use App\Entity\Task\Traits\TaskAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface TimeSlotInterface extends ResourceInterface, TaskAwareInterface
{
    public function getDuration(): ?\DateInterval;

    public function setDuration(?\DateInterval $duration): void;

    public function getDate(): ?\DateTimeInterface;

    public function setDate(?\DateTimeInterface $date): void;
}