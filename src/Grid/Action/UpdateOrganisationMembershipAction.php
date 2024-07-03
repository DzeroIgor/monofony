<?php

namespace App\Grid\Action;

use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ActionInterface;

class UpdateOrganisationMembershipAction
{
    public static function create(array $options = []): ActionInterface
    {
        $action = Action::create('update', 'update_organisation_membership');
        $action->setLabel('sylius.ui.edit');
        $action->setOptions($options);

        return $action;
    }
}
