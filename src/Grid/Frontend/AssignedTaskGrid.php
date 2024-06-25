<?php

declare(strict_types=1);

namespace App\Grid\Frontend;

use App\Entity\Organisation\Task;
use App\Grid\Action\FrontendTaskStatusTransitionsAction;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class AssignedTaskGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_frontend_task_assignee';
    }

    public function getResourceClass(): string
    {
        return Task::class;
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder->extends('app_frontend_task');

        $gridBuilder->removeField('assignee');
        $gridBuilder->addField(
            StringField::create('author')
                ->setLabel('app.ui.author')
            ->setPosition(0)
        );
        $gridBuilder->addOrderBy('createdAt', 'asc');

        $gridBuilder
            ->setRepositoryMethod('findAssignedTasks', [
                '$customer' => "expr:service('App\\\Context\\\CustomerContext').getCustomer()",
                '$organisation' => "expr:service('App\\\Context\\\OrganisationContext').getOrganisation()",
            ])
        ;
        $gridBuilder->addActionGroup(
            MainActionGroup::create(
                CreateAction::create()
                ->setEnabled(false),
            )
        );
        $gridBuilder->addActionGroup(
            ItemActionGroup::create(
                FrontendTaskStatusTransitionsAction::create(),
            )
        );
    }
}
