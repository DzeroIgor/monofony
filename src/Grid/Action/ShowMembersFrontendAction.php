<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class ShowMembersFrontendAction
{
    public static function create(): ActionInterface
    {
        $action = Action::create('showMembers', 'show_members_frontend');
        $action->setLabel('Show Members');
        $action->setIcon('users icon');

        return $action;
    }
}