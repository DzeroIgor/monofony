<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class TaskStatusTransitionsAction
{
    public static function create(): ActionInterface
    {
        $action = Action::create('manage', 'task_status_transitions');
        $action->setLabel('Manage status');
        $action->setIcon('cubes icon');
        $action->setOptions([
            'route_prefix' => 'app_backend_task_transition_',
            'route_parameters' => [
                'projectId' => '$projectId',
            ],
        ]);

        return $action;
    }
}