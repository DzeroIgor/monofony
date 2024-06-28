<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Entity\Task\TimeSlotInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TimeSlotsAwareTrait
{
    public function initializeTimeSlotsCollection(): void
    {
        $this->timeSlots = new ArrayCollection();
    }

    public function getTimeSlots(): Collection
    {
        return $this->timeSlots;
    }

    public function addTimeSlot(?TimeSlotInterface $timeSlot = null): void
    {
        if (!$this->hasTimeSlot($timeSlot)) {
            $this->timeSlots->add($timeSlot);
        }
    }
    public function hasTimeSlot(?TimeSlotInterface $timeSlot = null): bool
    {
        return $this->timeSlots->contains($timeSlot);
    }

    public function removeTimeSlot(?TimeSlotInterface $timeSlot = null): void
    {
        if ($this->hasTimeSlot($timeSlot)) {
            $this->timeSlots->removeElement($timeSlot);
        }
    }
}