<?php

namespace App\Workflow\EventListener;

use App\Entity\Vehicle\Vehicle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\TransitionEvent;

class VehicleWorkflowEventListener implements EventSubscriberInterface
{
    public function onCrashTransition(TransitionEvent $event): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = $event->getSubject();
        $vehicle->setHasAccident(true);
        $vehicle->addAccident();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.app_vehicle.transition.crash' => 'onCrashTransition',
        ];
    }
}
