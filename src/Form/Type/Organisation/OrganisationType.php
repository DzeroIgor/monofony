<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class OrganisationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.form.enabled',
            ])
            ->add('name', TextType::class, [
                'label' => 'sylius.form.name',
            ])
        ;
    }
}