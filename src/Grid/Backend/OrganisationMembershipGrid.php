<?php

declare(strict_types=1);

namespace App\Grid\Backend;

use App\Entity\Organisation\OrganisationMembership;
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

final class OrganisationMembershipGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_backend_organisation_membership';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setRepositoryMethod('findOrganisationMembers', [
                '$organisationId' => '$organisationId',
            ])
            ->addField(
                TwigField::create('enabled', '@SyliusUi\Grid\Field\enabled.html.twig')
                    ->setLabel('app.ui.enabled')
            )
            ->addField(
                StringField::create('customer')
                    ->setLabel('app.ui.customer')
            )
            ->addField(
                StringField::create('position')
                    ->setPath('position.name')
                    ->setLabel('app.ui.position')
            )
            ->addField(
                StringField::create('role')
                    ->setPath('role.name')
                    ->setLabel('app.ui.role')
            )
            ->addField(
                StringField::create('status')
                    ->setPath('status.name')
                    ->setLabel('app.ui.status')
            )
            ->addField(
                StringField::create('email')
                    ->setLabel('app.ui.email')
            )
            ->addField(
                DateTimeField::create('verified')
                    ->setLabel('app.ui.verified_at')
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create([
                        'link' => [
                            'parameters' => [
                                'organisationId' => '$organisationId',
                            ],
                        ],
                    ]),
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    UpdateAction::create([
                        'link' => [
                            'parameters' => [
                                'organisationId' => '$organisationId',
                                'id' => 'resource.id',
                            ],
                        ],
                    ]),
                    DeleteAction::create([
                        'link' => [
                            'parameters' => [
                                'organisationId' => '$organisationId',
                                'id' => 'resource.id',
                            ],
                        ],
                    ]),
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return OrganisationMembership::class;
    }
}
