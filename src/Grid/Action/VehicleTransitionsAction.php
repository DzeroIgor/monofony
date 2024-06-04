<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class VehicleTransitionsAction
{
    public static function create(): ActionInterface
    {
        $action = Action::create('manage', 'vehicle_transitions');
        $action->setLabel('Manage variants');
        $action->setIcon('cubes icon');

        return $action;
    }
}