<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class DeleteTaskAction
{
    public static function create(array $options = []): ActionInterface
    {
        $action = Action::create('delete', 'delete_task');
        $action->setLabel('sylius.ui.delete');
        $action->setOptions($options);

        return $action;
    }
}
