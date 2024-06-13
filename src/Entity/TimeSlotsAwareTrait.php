<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Organisation\TimeSlot;
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

    public function addTimeSlot(?TimeSlot $timeSlot = null): void
    {
        if (!$this->hasTimeSlot($timeSlot)) {
            $this->timeSlots->add($timeSlot);
        }
    }
    public function hasTimeSlot(?TimeSlot $timeSlot = null): bool
    {
        return $this->timeSlots->contains($timeSlot);
    }

    public function removeTimeSlot(?TimeSlot $timeSlot = null): void
    {
        if ($this->hasTimeSlot($timeSlot)) {
            $this->timeSlots->removeElement($timeSlot);
        }
    }
}