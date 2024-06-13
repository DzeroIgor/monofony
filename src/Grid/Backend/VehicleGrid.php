<?php

declare(strict_types=1);

namespace App\Grid\Backend;

use App\Entity\Vehicle\Vehicle;
use App\Grid\Action\VehicleTransitionsAction;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class VehicleGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_backend_vehicle';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->orderBy('vin', 'asc')
            ->addField(
                StringField::create('brand')
                    ->setLabel('app.ui.brand')
                    ->setPath('brand.name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('model')
                    ->setLabel('app.ui.model')
                    ->setPath('model.name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('vin')
                    ->setLabel('app.ui.vin')
            )
            ->addField(
                StringField::create('category')
                    ->setLabel('app.ui.category')
                    ->setPath('category.name')
                    ->setSortable(true)
            )
//            ->addField(
//                DateTimeField::create('year', 'Y')
//                    ->setLabel('app.ui.year')
//                    ->setSortable(true)
//            )
//            ->addField(
//                StringField::create('color')
//                    ->setLabel('app.ui.color')
//                    ->setPath('color.name')
//                    ->setSortable(true)
//            )
//            ->addField(
//                StringField::create('bodyType')
//                    ->setLabel('app.ui.body_type')
//                    ->setPath('bodyType.name')
//            )
//            ->addField(
//                StringField::create('weight')
//                    ->setLabel('app.ui.weight')
//            )
//            ->addField(
//                StringField::create('measurement')
//                    ->setLabel('app.ui.measurement')
//                    ->setPath('measurement.name')
//
//            )
//            ->addField(
//                StringField::create('engineVolume')
//                    ->setLabel('app.ui.engine_volume')
//            )
//            ->addField(
//                StringField::create('engineType')
//                    ->setLabel('app.ui.engine_type')
//                    ->setPath('engineType.name')
//            )
//            ->addField(
//                StringField::create('engineNumber')
//                    ->setLabel('app.ui.engine_number')
//            )
//            ->addField(
//                StringField::create('engineNumber')
//                    ->setLabel('app.ui.engine_number')
//            )
//            ->addField(
//                StringField::create('engineVolume')
//                    ->setLabel('app.ui.engine_volume')
//            )
//            ->addField(
//                StringField::create('numberOfPlaces')
//                    ->setLabel('app.ui.number_of_places')
//                    ->setPath('numberOfPlaces.name')
//            )
//            ->addField(
//                StringField::create('chassisNumber')
//                    ->setLabel('app.ui.chassis_number')
//            )
            ->addField(
                StringField::create('state')
                    ->setLabel('app.ui.state')
            )
            ->addField(
                StringField::create('hasAccident')
                    ->setLabel('app.ui.has_accident')
            )
            ->addField(
                TwigField::create('hasAccident', '@SyliusUi\Grid\Field\yesNo.html.twig')
                    ->setLabel('app.ui.has_accident')
            )
            ->addField(
                StringField::create('chassisNumber')
                    ->setLabel('app.ui.chassis_number')
            )
            ->addField(
                StringField::create('numberOfAccident')
                    ->setLabel('app.ui.numberOfAccident')
            )
            // main action group
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
            // item action group
            ->addActionGroup(
                ItemActionGroup::create(
                    VehicleTransitionsAction::create(),
                    ShowAction::create(),
                    UpdateAction::create(),
                    DeleteAction::create()
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Vehicle::class;
    }
}
