<?php

declare(strict_types=1);

namespace App\Grid\Frontend;

use App\Entity\Organisation\Task;
use App\Grid\Action\DeleteTaskAction;
use App\Grid\Action\FrontendTaskStatusTransitionsAction;
use App\Grid\Action\UpdateTaskAction;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
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
        return 'app_frontend_task';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setRepositoryMethod('findTasksForMember', [
                '$customer' => "expr:service('App\\\Context\\\CustomerContext').getCustomer()",
                '$organisation' => "expr:service('App\\\Context\\\OrganisationContext').getOrganisation()",
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
                    ->setSortable(true)
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
                TwigField::create('timeSlots', 'backend/task/grids/fields/time_slot.html.twig')
                    ->setLabel('app.ui.time_slots')
            )
            ->addField(
                DateTimeField::create('completedAt')
                    ->setLabel('app.ui.completed_at')
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    FrontendTaskStatusTransitionsAction::create(),
                    UpdateTaskAction::create(),
                    DeleteTaskAction::create(
                        //                        [
                        //                            'visible' => 'resource.isAuthor',
                        //                        ]
                    )
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Task::class;
    }
}
