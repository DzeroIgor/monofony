<?php

declare(strict_types=1);

namespace App\Form\Type\Task;

use App\Context\OrganisationContext;
use App\Form\Type\Organisation\MemberAutocompleteChoiceType;
use App\Form\Type\Project\ProjectAutocompleteChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('assignee', MemberAutocompleteChoiceType::class, [
                'label' => 'app.ui.assignee',
                'placeholder' => 'Choose an assignee',
            ])
            ->add('project', ProjectAutocompleteChoiceType::class, [
                'label' => 'app.ui.project',
                'placeholder' => 'Chose a project',
            ])
//            ->add('project', EntityType::class, [
//                'class' => Project::class,
//                'placeholder' => 'sylius.ui.select',
//                'label' => 'app.ui.project',
//                'query_builder' => function (ProjectRepository $repository) {
//                    return $repository->getCustomerProjectsQueryBuilder($this->organisationContext->getOrganisation());
//                },
//            ])
            ->add('timeSlots', CollectionType::class, [
                'entry_type' => TimeSlotType::class,
                'label' => 'app.ui.time_slot',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }
}
