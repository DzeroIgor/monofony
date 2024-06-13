<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class ShowTasksAction
{
    public static function create(): ActionInterface
    {
        $action = Action::create('showTasks', 'show_tasks');
        $action->setLabel('Show Tasks');
        $action->setIcon('tasks icon');

        return $action;
    }
}