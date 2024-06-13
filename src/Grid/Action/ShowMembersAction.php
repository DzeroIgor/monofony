<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class ShowMembersAction
{
    public static function create(): ActionInterface
    {
        $action = Action::create('showMembers', 'show_members');
        $action->setLabel('Show Members');
        $action->setIcon('users icon');

        return $action;
    }
}