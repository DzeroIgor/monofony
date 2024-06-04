<?php

declare(strict_types=1);

namespace App\Form\Type\Vehicle;

use App\Entity\Vehicle\Model;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ModelType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Model::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'app.ui.name',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'app_vehicle_model';
    }
}
