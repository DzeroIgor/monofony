<?php

declare(strict_types=1);

namespace App\Grid\Frontend;

use App\Entity\Organisation\Organisation;
use App\Entity\Organisation\Role;
use App\Grid\Action\DeleteOrganisationAction;
use App\Grid\Action\ShowMembersAction;
use App\Grid\Action\ShowProjectAction;
use App\Grid\Action\UpdateOrganisationAction;
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
use Symfony\Bundle\SecurityBundle\Security;

final class OrganisationGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_frontend_organisation';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setRepositoryMethod('findOrganisationsForMember', [
                '$customer' => "expr:service('App\\\Context\\\CustomerContext').getCustomer()",
            ])
            ->orderBy('name', 'asc')
            ->addField(
                StringField::create('name')
                    ->setLabel('app.ui.name')
                    ->setSortable(true)
            )
            ->addField(
                TwigField::create('enabled', '@SyliusUi\Grid\Field\enabled.html.twig')
                    ->setLabel('app.ui.enabled')
            )
            ->addField(
                DateTimeField::create('createdAt')
                    ->setLabel('app.ui.created_at')
            )
            ->addField(
                DateTimeField::create('updatedAt')
                    ->setLabel('app.ui.updated_at')
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    UpdateOrganisationAction::create(),
                    DeleteOrganisationAction::create(),
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Organisation::class;
    }
}
