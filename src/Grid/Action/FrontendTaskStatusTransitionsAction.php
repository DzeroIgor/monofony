<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class FrontendTaskStatusTransitionsAction
{
    public static function create(): ActionInterface
    {
        $action = Action::create('manage', 'frontend_task_status_transitions');
        $action->setLabel('Manage status');
        $action->setIcon('cubes icon');
        $action->setOptions([
            'route_prefix' => 'app_frontend_task_transition_',
        ]);

        return $action;
    }
}