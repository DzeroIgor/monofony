<?php

declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Monofony\Component\Admin\Menu\AdminMenuBuilderInterface;

final class AdminMenuBuilder implements AdminMenuBuilderInterface
{
    public function __construct(private FactoryInterface $factory)
    {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $this->addCustomerSubMenu($menu);
        $this->addArticleSubMenu($menu);
        $this->addBookSubMenu($menu);
        $this->addVehicleSubMenu($menu);
        $this->addOrganisationSubMenu($menu);
        $this->addConfigurationSubMenu($menu);
        //        dd($menu);

        return $menu;
    }

    private function addCustomerSubMenu(ItemInterface $menu): void
    {
        $customer = $menu
            ->addChild('customer')
            ->setLabel('sylius.ui.customer')
        ;

        $customer->addChild('backend_customer', ['route' => 'sylius_backend_customer_index'])
            ->setLabel('sylius.ui.customers')
            ->setLabelAttribute('icon', 'users')
        ;
    }

    private function addArticleSubMenu(ItemInterface $menu): void
    {
        $article = $menu
            ->addChild('article')
            ->setLabel('Article')
        ;

        $article->addChild('backend_article', ['route' => 'app_backend_article_index'])
            ->setLabel('Articles')
            ->setLabelAttribute('icon', 'file alternate outline')
        ;

        $article->addChild('backend_comment', ['route' => 'app_backend_comment_index'])
            ->setLabel('Comments')
            ->setLabelAttribute('icon', 'comment')
        ;
    }

    private function addBookSubMenu(ItemInterface $menu): void
    {
        $book = $menu
            ->addChild('book')
            ->setLabel('app.ui.book')
        ;

        $book->addChild('backend_book', ['route' => 'app_backend_book_index'])
            ->setLabel('app.ui.book')
            ->setLabelAttribute('icon', 'book')
        ;

        $book->addChild('backend_category', ['route' => 'app_backend_category_index'])
            ->setLabel('app.ui.category')
            ->setLabelAttribute('icon', 'book')
        ;
    }

    private function addVehicleSubMenu(ItemInterface $menu): void
    {
        $vehicle = $menu
            ->addChild('vehicle')
            ->setLabel('app.ui.vehicle')
        ;

        $vehicle->addChild('backend_vehicle', ['route' => 'app_backend_vehicle_index'])
            ->setLabel('app.ui.vehicle')
            ->setLabelAttribute('icon', 'car')
        ;

        $vehicle->addChild('backend_vehicle_brand', ['route' => 'app_backend_vehicle_brand_index'])
            ->setLabel('app.ui.brand')
            ->setLabelAttribute('icon', 'car')
        ;

        $vehicle->addChild('backend_vehicle_category', ['route' => 'app_backend_vehicle_category_index'])
            ->setLabel('app.ui.category')
            ->setLabelAttribute('icon', 'car')
        ;
    }

    public function addOrganisationSubMenu(ItemInterface $menu): void
    {
        $organisation = $menu
            ->addChild('organisation')
            ->setLabel('app.ui.organisation')
        ;

        $organisation
            ->addChild('backend_organisation', ['route' => 'app_backend_organisation_index'])
            ->setLabel('app.ui.organisation')
            ->setLabelAttribute('icon', 'warehouse')
            ->setExtra('routes', [
                'app_backend_organisation_index',
                'app_backend_organisation_show',
                'app_backend_organisation_create',
                'app_backend_organisation_update',
                'app_backend_organisation_membership_create',
                'app_backend_organisation_membership_index',
                'app_backend_organisation_membership_update',
                'app_backend_project_create',
                'app_backend_project_index',
                'app_backend_project_update',
                'app_backend_task_create',
                'app_backend_task_index',
                'app_backend_task_update',

            ])
        ;

//        $organisation
//            ->addChild('backend_time_slot', ['route' => 'app_backend_time_slot_index'])
//            ->setLabel('app.ui.time_slot')
//            ->setLabelAttribute('icon', 'clock')
//        ;
    }

    private function addConfigurationSubMenu(ItemInterface $menu): void
    {
        $configuration = $menu
            ->addChild('configuration')
            ->setLabel('sylius.ui.configuration')
        ;

        $configuration->addChild('backend_admin_user', ['route' => 'sylius_backend_admin_user_index'])
            ->setLabel('sylius.ui.admin_users')
            ->setLabelAttribute('icon', 'lock')
        ;

        $configuration->addChild('backend_locale', ['route' => 'sylius_admin_locale_index'])
            ->setLabel('sylius.ui.locales')
            ->setLabelAttribute('icon', 'language')
        ;

        $configuration->addChild('backend_currency', ['route' => 'sylius_admin_currency_index'])
            ->setLabel('sylius.ui.currency')
            ->setLabelAttribute('icon', 'money bill alternate outline')
        ;
    }
}
