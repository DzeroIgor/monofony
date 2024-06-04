<?php

declare(strict_types=1);

namespace App\Form\Type\Article;

use App\Entity\Article\Comment;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

final class CommentType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Comment::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('comment', TextareaType::class, [
                'label' => 'app.ui.comment',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'app_comment';
    }
}
