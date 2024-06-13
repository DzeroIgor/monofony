<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class ShowProjectAction
{
    public static function create(): ActionInterface
    {
        $action = Action::create('showProjects', 'show_projects');
        $action->setLabel('Show Projects');
        $action->setIcon('clipboard outline icon');

        return $action;
    }
}