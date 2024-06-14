<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use App\Entity\Organisation\TimeSlot;
use App\Form\Type\DatePickerType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\FormBuilderInterface;

final class TimeSlotType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(TimeSlot::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('duration', DateIntervalType::class, [
                'label' => 'sylius.form.duration',
                'with_minutes' => true,
                'with_hours' => true,
                'with_years' => false,
                'with_months' => false,
                'with_days' => false,
                'minutes' => [00 => 00, 15 => 15, 30 => 30, 45 => 45],
            ])
            ->add('date', DatePickerType::class, [
                'label' => 'sylius.form.date',
            ])
        ;
    }
}
