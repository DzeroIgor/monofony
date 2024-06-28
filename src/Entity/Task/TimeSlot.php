<?php

declare(strict_types=1);

namespace App\Entity\Task;

use App\Entity\Task\Traits\TaskAwareTrait;
use App\Entity\Traits\IdentifiableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AssociationOverride;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity]
#[ORM\AssociationOverrides([
    new AssociationOverride(
        name: 'task',
        joinColumns: new JoinColumn(
            name: 'task_id',
            referencedColumnName: 'id',
            nullable: true,
            onDelete: 'CASCADE'
        ),
        inversedBy: 'timeSlots'
    ),
])]
#[ORM\Table(name: 'app_time_slot')]
class TimeSlot implements TimeSlotInterface
{
    use IdentifiableTrait;
    use TaskAwareTrait;

    #[ORM\Column(type: Types::DATEINTERVAL, nullable: true)]
    private ?\DateInterval $duration = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $date = null;

    public function getDuration(): ?\DateInterval
    {
        return $this->duration;
    }

    public function setDuration(?\DateInterval $duration): void
    {
        $this->duration = $duration;
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