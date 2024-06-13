<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class DeleteOrganisationAction
{
    public static function create(array $options = []): ActionInterface
    {
        $action = Action::create('delete', 'delete_organisation');
        $action->setLabel('sylius.ui.delete');
        $action->setOptions($options);

        return $action;
    }
}
