<?php

declare(strict_types=1);

namespace App\Grid\Backend\Vehicle;

use App\Entity\Vehicle\Brand;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class VehicleBrandGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_backend_vehicle_brand';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->orderBy('name', 'asc')
            ->addField(
                StringField::create('name')
                ->setLabel('app.ui.name')
                ->setSortable(true)
            )
            // main action group
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )
            // item action group
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
        return Brand::class;
    }
}
