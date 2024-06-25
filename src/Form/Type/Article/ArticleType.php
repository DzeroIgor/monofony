<?php

declare(strict_types=1);

namespace App\Form\Type\Article;

use App\Entity\Article\Article;
use App\Entity\Article\Comment;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\FixedCollectionType;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ArticleType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'app.ui.title',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('text', TextareaType::class, [
                'label' => 'app.ui.text',
            ])

            ->add('comments', CollectionType::class, [
                'entry_type' => CommentType::class,
                'label' => 'app.ui.comments',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                //                'prototype_data' => $this->commentFactory->createNewWithPost($builder->getData()),
            ])
        ;
    }
}
