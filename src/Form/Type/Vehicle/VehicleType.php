<?php

declare(strict_types=1);

namespace App\Form\Type\Vehicle;

use App\Entity\Vehicle\BodyType;
use App\Entity\Vehicle\Brand;
use App\Entity\Vehicle\Category;
use App\Entity\Vehicle\Color;
use App\Entity\Vehicle\EngineType;
use App\Entity\Vehicle\Measurement;
use App\Entity\Vehicle\Model;
use App\Entity\Vehicle\NumberOfPlaces;
use App\Entity\Vehicle\Vehicle;
use App\Form\Type\DatePickerType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

final class VehicleType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('brand', EntityType::class, [
                'label' => 'sylius.form.brand',
                'placeholder' => 'sylius.ui.select',
                'class' => Brand::class,
            ]);
        $formModifier = function (FormInterface $form, ?Brand $brand = null): void {
            $models = null === $brand ? [] : $brand->getModels();

            $form->add('model', EntityType::class, [
                'class' => Model::class,
                'placeholder' => 'sylius.ui.select',
                'choices' => $models,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier): void {
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getBrand());
            }
        );

        $builder->get('brand')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier): void {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $brand = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback function!
                $formModifier($event->getForm()->getParent(), $brand);
            }
        );

        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'placeholder' => 'sylius.ui.select',
                'label' => 'sylius.form.category',
            ])
            ->add('year', DatePickerType::class, [
                'label' => 'app.ui.year',
            ])
            ->add('vin', TextType::class, [
                'label' => 'app.ui.vin',
            ])
            ->add('weight', IntegerType::class, [
                'label' => 'app.ui.weight',
            ])
            ->add('measurement', EnumType::class, [
                'class' => Measurement::class,
                'placeholder' => 'sylius.ui.select',
                'label' => 'app.ui.weight',
            ])
            ->add('engineVolume', NumberType::class, [
                'label' => 'app.ui.engine_volume',
            ])
            ->add('engineNumber', TextType::class, [
                'label' => 'app.ui.engine_number',
            ])
            ->add('engineType', EnumType::class, [
                'class' => EngineType::class,
                'placeholder' => 'sylius.ui.select',
            ])
            ->add('chassisNumber', TextType::class, [
                'label' => 'app.ui.chassis_number',
            ])
            ->add('bodyType', EnumType::class, [
                'class' => BodyType::class,
                'placeholder' => 'sylius.ui.select',
                'label' => 'app.ui.body_type',
            ])
            ->add('color', EnumType::class, [
                'class' => Color::class,
                'placeholder' => 'sylius.ui.select',
            ])
            ->add('numberOfPlaces', EnumType::class, [
                'label' => 'sylius.ui.number_of_places',
                'class' => NumberOfPlaces::class,
                'placeholder' => 'sylius.ui.select',
            ])
        ;
    }
}
