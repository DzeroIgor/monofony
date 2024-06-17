<?php

declare(strict_types=1);

namespace App\Grid\Backend;

use App\Entity\Catalogue\Catalogue;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\Filter\StringFilter;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class CatalogueGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_backend_catalogue';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
//            ->setRepositoryMethod('createListQueryBuilder', [$this->localeContext->getLocaleCode()])
            ->orderBy('title', 'asc')
            ->addField(
                StringField::create('title')
                    ->setLabel('app.ui.title')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('url')
                    ->setLabel('app.ui.url')
            )
            ->addField(
                TwigField::create('cover', 'backend/catalogue/fields/_cover.html.twig')
                    ->setLabel('app.ui.cover')
                    ->setSortable(true)
            )
            ->addFilter(StringFilter::create('search', ['title']))
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )->addActionGroup(
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
        return Catalogue::class;
    }
}
