<?php

namespace App\Workflow\Guard;

use App\Entity\Vehicle\Color;
use App\Entity\Vehicle\Vehicle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

class VehicleGuard implements EventSubscriberInterface
{
    public function guardBuy(GuardEvent $guardEvent): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = $guardEvent->getSubject();
        //        (Color::Red === $vehicle->getColor() || Color::Black === $vehicle->getColor())
        //        (in_array($vehicle->getColor(), Color::cases(), true))  // control all cases from array
        //        (in_array($vehicle->getColor(), [Color::Red, Color::Black, Color::White], true))
        if (Color::Red === $vehicle->getColor()) {
            $guardEvent->setBlocked(true);
        }
    }

    public function guardRepair(GuardEvent $guardEvent): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = $guardEvent->getSubject();

        if ($vehicle->getNumberOfAccident() > 5) {
            $guardEvent->setBlocked(true);
        }
    }

    //    public function guardNumberOfPlaces(GuardEvent $guardEvent)
    //    {
    //        /** @var Vehicle $vehicle */
    //        $vehicle = $guardEvent->getSubject();
    //
    //        if ($vehicle->getNumberOfPlaces() < 2) {
    //            $guardEvent->setBlocked(true);
    //        }
    //    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.app_vehicle.guard.buy' => 'guardBuy',
            'workflow.app_vehicle.guard.repair' => 'guardRepair',
        ];
    }
}
