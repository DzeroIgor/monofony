<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class TaskType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        //        /** @var TaskInterface|null $task */
        //        $task = $builder->getData();
        //        $projectId = null;
        //
        //        if (null !== $task && ($project = $task->getProject())) {
        //            $projectId = $project->getId();
        //        }

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
            ->add('author', MemberAutocompleteChoiceType::class, [
                'label' => 'app.ui.author',
                'placeholder' => 'Choose an author',
            ])
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
