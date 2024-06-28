<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Entity\Task\TimeSlotInterface;
use Doctrine\Common\Collections\Collection;

interface TimeSlotsAwareInterface
{
    public function initializeTimeSlotsCollection(): void;

    public function getTimeSlots(): Collection;

    public function addTimeSlot(?TimeSlotInterface $timeSlot = null): void;

    public function hasTimeSlot(?TimeSlotInterface $timeSlot = null): bool;

    public function removeTimeSlot(?TimeSlotInterface $timeSlot = null): void;
}