<?php

declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Monofony\Contracts\Front\Menu\AccountMenuBuilderInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class AccountMenuBuilder implements AccountMenuBuilderInterface
{
    public const EVENT_NAME = 'sylius.menu.app.account';

    public function __construct(
        private readonly FactoryInterface $factory,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setLabel('sylius.ui.my_account');

        $menu
            ->addChild('dashboard', ['route' => 'sylius_frontend_account_dashboard'])
            ->setLabel('sylius.ui.dashboard')
            ->setLabelAttribute('icon', 'home')
        ;
        $menu
            ->addChild('personal_information', ['route' => 'sylius_frontend_account_profile_update'])
            ->setLabel('sylius.ui.personal_information')
            ->setLabelAttribute('icon', 'user')
        ;
        $menu
            ->addChild('change_password', ['route' => 'sylius_frontend_account_change_password'])
            ->setLabel('sylius.ui.change_password')
            ->setLabelAttribute('icon', 'lock')
        ;
        $menu
            ->addChild('organisation', ['route' => 'app_frontend_organisation_index'])
            ->setLabel('app.ui.organisation')
            ->setLabelAttribute('icon', 'warehouse')
        ;
        $menu
            ->addChild('organisation_membership', ['route' => 'app_frontend_organisation_membership_index'])
            ->setLabel('app.ui.organisation_membership')
            ->setLabelAttribute('icon', 'users')
        ;
        $menu
            ->addChild('project', ['route' => 'app_frontend_project_index'])
            ->setLabel('app.ui.project')
            ->setLabelAttribute('icon', 'file alternate')
        ;
        $menu
            ->addChild('task', ['route' => 'app_frontend_task_index'])
            ->setLabel('app.ui.task')
            ->setLabelAttribute('icon', 'tasks')
        ;
        $menu
            ->addChild('assignee', ['route' => 'app_frontend_task_index_assignee'])
            ->setLabel('app.ui.assignee')
            ->setLabelAttribute('icon', 'user')
        ;

        $this->eventDispatcher->dispatch(new MenuBuilderEvent($this->factory, $menu), self::EVENT_NAME);

        return $menu;
    }
}
