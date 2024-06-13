<?php

declare(strict_types=1);

namespace App\Grid\Backend;

use App\Entity\Organisation\Task;
use App\Grid\Action\TaskStatusTransitionsAction;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class TaskGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_backend_task';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setRepositoryMethod('findProjectTasks', [
                '$projectId' => '$projectId',
            ])
            ->orderBy('name', 'asc')
            ->addField(
                StringField::create('name')
                    ->setLabel('app.ui.name')
                    ->setSortable(true)
            )
            ->addField(
                DateTimeField::create('createdAt')
                    ->setLabel('app.ui.created_at')
            )
            ->addField(
                DateTimeField::create('updatedAt')
                    ->setLabel('app.ui.updated_at')
            )
            ->addField(
                StringField::create('description')
                    ->setLabel('app.ui.description')
            )
            ->addField(
                StringField::create('status')
                    ->setPath('status.name')
                    ->setLabel('app.ui.status')
            )
            ->addField(
                StringField::create('assignee')
                    ->setLabel('app.ui.assignee')
            )
            ->addField(
                StringField::create('author')
                    ->setLabel('app.ui.author')
                    ->setPosition(2)
            )
            ->addField(
                TwigField::create('timeSlots', 'backend/task/grids/fields/time_slot.html.twig')
                    ->setLabel('app.ui.time_slots')
            )
            ->addField(
                DateTimeField::create('completedAt')
                    ->setLabel('app.ui.completed_at')
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create([
                        'link' => [
                            'parameters' => [
                                'projectId' => '$projectId',
                            ],
                        ],
                    ]),
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    TaskStatusTransitionsAction::create(),
                    UpdateAction::create([
                        'link' => [
                            'parameters' => [
                                'projectId' => '$projectId',
                                'id' => 'resource.id',
                            ],
                        ],
                    ]),
                    DeleteAction::create([
                        'link' => [
                            'parameters' => [
                                'projectId' => '$projectId',
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
        return Task::class;
    }
}
