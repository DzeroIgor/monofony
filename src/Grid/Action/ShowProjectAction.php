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
        $action->setOptions([
            'link' => [
                'route' => 'app_backend_organisation_project_create',
                'parameters' => [
                    'organisationId' => '$organisationId',
                    'id' => 'resource.id',
                ],
            ],
        ]);
        $action->setIcon('clipboard outline icon');

        return $action;
    }
}