<?php

declare(strict_types=1);

namespace App\Form\Type\Book;

use App\Entity\Book\BookTranslation;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class BookTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'app.ui.title',
            ])
        ;
    }
}
