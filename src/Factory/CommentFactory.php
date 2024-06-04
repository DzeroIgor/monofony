<?php

namespace App\Factory;

use App\Context\CustomerContext;
use App\Entity\Article\Article;
use App\Entity\Article\Comment;
use App\Entity\Customer\Customer;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class CommentFactory implements FactoryInterface
{
    public function __construct(
        private readonly FactoryInterface $decorated,
        private readonly RepositoryInterface $articleRepository,
        private readonly CustomerContext $customerContext
    ) {
    }

    public function createNew(): Comment
    {
        return $this->decorated->createNew();
    }

    public function createNewWithPost(?string $postId = null): Comment
    {
        $post = $this->articleRepository->find($postId);

        $comment = $this->createNew();
        $comment->setPost($post);
        $comment->setAuthor($this->customerContext->getCustomer());

        return $comment;
    }

    public function createNewWithPostAndAuthor(?Article $post = null, ?Customer $customer = null): Comment
    {
        $comment = $this->createNew();
        $comment->setPost($post);
        $comment->setAuthor($customer);

        return $comment;
    }
}