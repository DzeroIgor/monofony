<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use App\Context\OrganisationContext;
use App\Entity\Organisation\OrganisationMembership;
use App\Entity\Organisation\Project;
use App\Repository\Organisation\OrganisationMembershipRepository;
use App\Repository\ProjectRepository;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerTaskType extends AbstractResourceType
{
    public function __construct(
        private readonly OrganisationContext $organisationContext,
        protected array $validationGroups,
        protected string $dataClass,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'app.ui.name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'app.ui.description',
            ])
            ->add('assignee', EntityType::class, [
                'class' => OrganisationMembership::class,
                'placeholder' => 'sylius.ui.assignee',
                'label' => 'app.ui.assignee',
                'query_builder' => function (OrganisationMembershipRepository $repository) {
                    return $repository->findOrganisationMembers($this->organisationContext->getOrganisation());
                },
            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'placeholder' => 'sylius.ui.select',
                'label' => 'app.ui.project',
                'query_builder' => function (ProjectRepository $repository) {
                    return $repository->getCustomerProjectsQueryBuilder($this->organisationContext->getOrganisation());
                },
            ])
        ;
    }
}
