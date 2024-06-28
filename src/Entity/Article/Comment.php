<?php

namespace App\Entity\Article;

use App\Entity\Customer\Customer;
use App\Entity\Traits\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity]
#[ORM\Table(name: 'app_comment')]

class Comment implements ResourceInterface
{
    use IdentifiableTrait;

    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $post = null;


    #[NotBlank]
    #[ORM\Column(length: 500)]
    private ?string $comment = null;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id', nullable: true)]
    private ?Customer $author = null;

    public function __construct(?Article $post = null)
    {
        $this->post = $post;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPost(): ?Article
    {
        return $this->post;
    }

    public function setPost(?Article $post): void
    {
        $this->post = $post;
    }

    public function getAuthor(): ?Customer
    {
        return $this->author;
    }

    public function setAuthor(?Customer $author): void
    {
        $this->author = $author;
    }

}
