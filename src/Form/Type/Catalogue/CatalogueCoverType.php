<?php

declare(strict_types=1);

namespace App\Form\Type\Catalogue;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

final class CatalogueCoverType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('file', FileType::class, [
                'label' => false,
            ])
        ;
    }
}
