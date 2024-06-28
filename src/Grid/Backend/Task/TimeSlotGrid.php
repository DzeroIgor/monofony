<?php

declare(strict_types=1);

namespace App\Grid\Backend\Task;

use App\Entity\Task\TimeSlot;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class TimeSlotGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_backend_time_slot';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->orderBy('date', 'asc')
            ->addField(
                StringField::create('duration')
                    ->setLabel('app.ui.duration')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('task')
                    ->setLabel('app.ui.task')
            )
            ->addField(
                StringField::create('date')
                    ->setLabel('app.ui.date')
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )
            ->addActionGroup(
                BulkActionGroup::create(
                    DeleteAction::create()
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    ShowAction::create(),
                    UpdateAction::create(),
                    DeleteAction::create()
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return TimeSlot::class;
    }
}