<?php

declare(strict_types=1);

namespace App\Grid\Backend;

use App\Entity\Organisation\Project;
use App\Grid\Action\ShowTasksAction;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class OrganisationProjectGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_backend_organisation_project';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setRepositoryMethod('findOrganisationProjects', [
                '$organisationId' => '$organisationId',
            ])
            ->orderBy('name', 'asc')
            ->addField(
                StringField::create('name')
                    ->setLabel('app.ui.name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('description')
                    ->setLabel('app.ui.description')
            )
            ->addField(
                DateTimeField::create('createdAt')
                    ->setLabel('app.ui.created_at')
            )
            ->addField(
                DateTimeField::create('updatedAt')
                    ->setLabel('app.ui.updated_at')
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create([
                        'link' => [
                            'route' => 'app_backend_organisation_project_create',
                            'parameters' => [
                                'organisationId' => '$organisationId',
                            ],
                        ],
                    ])
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    ShowTasksAction::create(),
                    UpdateAction::create([
                        'link' => [
                            'route' => 'app_backend_organisation_project_update',
                            'parameters' => [
                                'organisationId' => '$organisationId',
                                'id' => 'resource.id',
                            ],
                        ],
                    ]),
                    DeleteAction::create([
                        'link' => [
                            'route' => 'app_backend_organisation_project_delete',
                            'parameters' => [
                                'organisationId' => '$organisationId',
                                'id' => 'resource.id',
                            ],
                        ],
                    ])
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Project::class;
    }
}
