<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use App\Entity\Organisation\OrganisationMembership;
use App\Entity\Organisation\Status;
use App\Entity\Organisation\Task;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class TaskType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Task::class, [
        ]);
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
            ])
            ->add('author', EntityType::class, [
                'class' => OrganisationMembership::class,
                'placeholder' => 'sylius.ui.select',
                'label' => 'app.ui.author',
            ])
//            ->add('status', EnumType::class, [
//                'class' => Status::class,
//                'placeholder' => 'sylius.ui.select',
//                'label' => 'app.ui.status',
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