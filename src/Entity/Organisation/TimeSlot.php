<?php

declare(strict_types=1);

namespace App\Entity\Organisation;

use App\Entity\IdentifiableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_time_slot')]
class TimeSlot implements TimeSlotInterface
{
    use IdentifiableTrait;

    #[ORM\Column(type: Types::DATEINTERVAL)]
    private ?\DateInterval $duration = null;

    #[ORM\ManyToOne(targetEntity: Task::class, cascade: ['all'], inversedBy: 'timeSlots')]
    private ?Task $task = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date = null;

    public function getDuration(): ?\DateInterval
    {
        return $this->duration;
    }

    public function setDuration(?\DateInterval $duration): void
    {
        $this->duration = $duration;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): void
    {
        $this->task = $task;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): void
    {
        $this->date = $date;
    }
}