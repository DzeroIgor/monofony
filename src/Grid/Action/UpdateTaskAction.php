<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class UpdateTaskAction
{
    public static function create(array $options = []): ActionInterface
    {
        $action = Action::create('update', 'update_task');
        $action->setLabel('sylius.ui.edit');
        $action->setOptions($options);

        return $action;
    }
}
