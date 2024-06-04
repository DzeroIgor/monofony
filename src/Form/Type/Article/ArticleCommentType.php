<?php

declare(strict_types=1);

namespace App\Form\Type\Article;

use App\Entity\Article\Article;
use App\Entity\Article\Comment;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\FixedCollectionType;
use Symfony\Component\Form\FormBuilderInterface;

final class ArticleCommentType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Article::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('comments', FixedCollectionType::class, [
                'entry_type' => CommentType::class,
                'entry_name' => fn (Comment $comment) => 'test',
                'entries' => [
                    new Comment($options['data']),
                ],
                'label' => 'app.ui.text',
            ])
        ;
    }
}
