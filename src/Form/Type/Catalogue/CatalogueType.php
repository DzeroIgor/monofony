<?php

declare(strict_types=1);

namespace App\Form\Type\Catalogue;

use App\Entity\Catalogue\Catalogue;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CatalogueType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Catalogue::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'app.ui.title',
            ])
            ->add('url', TextType::class, [
                'label' => 'app.ui.url',
            ])
            ->add('cover', CatalogueCoverType::class, [
                'label' => 'Cover',
            ])

        ;
    }
}
