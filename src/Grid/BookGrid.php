<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\Book\Book;
use App\Entity\Book\Category;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\Filter\DateFilter;
use Sylius\Bundle\GridBundle\Builder\Filter\EntityFilter;
use Sylius\Bundle\GridBundle\Builder\Filter\ExistsFilter;
use Sylius\Bundle\GridBundle\Builder\Filter\MoneyFilter;
use Sylius\Bundle\GridBundle\Builder\Filter\SelectFilter;
use Sylius\Bundle\GridBundle\Builder\Filter\StringFilter;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
final class BookGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public function __construct(private readonly LocaleContextInterface $localeContext)
    {
    }
    public static function getName(): string
    {
        return 'app_backend_book';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setRepositoryMethod('createListQueryBuilder', [$this->localeContext->getLocaleCode()])
            ->orderBy('translation.title', 'asc')
            ->addField(
                StringField::create('translation.title')
                    ->setLabel('app.ui.title')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('author')
                    ->setLabel('app.ui.author')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('publishingHouse')
                    ->setLabel('app.ui.publishing_house')
                    ->setSortable(true)
            )
            ->addField(
                //                TwigField::create('literatureCategory', 'backend/book/fields/_category.html.twig')
                StringField::create('literatureCategory')
                    ->setLabel('app.ui.literature_category')
                    ->setPath('literatureCategory.name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('isbn')
                    ->setLabel('app.ui.isbn')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('age')
                    ->setLabel('app.ui.age')
                    ->setSortable(true)
            )
            ->addField(
                TwigField::create('money', 'backend/book/fields/_money.html.twig')
                    ->setLabel('app.ui.price')
            )
            ->addField(
                DateTimeField::create('publishedAt', 'Y-m-d')
                    ->setLabel('app.ui.published_at')
                    ->setSortable(true)
            )
            ->addField(
                TwigField::create('cover', 'backend/book/fields/_cover.html.twig')
                    ->setLabel('app.ui.cover')
                    ->setSortable(true)
            )
            ->addFilter(StringFilter::create('search', ['title', 'author', 'isbn']))
            ->addFilter(ExistsFilter::create('author'))
            ->addFilter(MoneyFilter::create('price', 'currency'))
            ->addFilter(EntityFilter::create('literatureCategory', Category::class))
            ->addFilter(DateFilter::create('publishedAt'))
            ->addFilter(SelectFilter::create('age', [
                '0-5 years' => '0-5 years',
                '5-7 years' => '5-7 years',
                '7-9 years' => '7-9 years',
                '9-12 years' => '9-12 years',
                '12-18 years' => '12-18 years',
                'Adults' => 'Adults',
            ])) // , true
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
        return Book::class;
    }
}
