<?php

declare(strict_types=1);

namespace App\Form\Type\Vehicle;

use App\Entity\Vehicle\Brand;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class BrandType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Brand::class, [
            'user',
            'admin',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'app.ui.name',
            ])
            ->add('models', CollectionType::class, [
                'entry_type' => ModelType::class,
                'label' => 'app.ui.models',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'app_vehicle_brand';
    }
}
