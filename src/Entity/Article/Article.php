<?php

namespace App\Entity\Article;

use App\Entity\IdentifiableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_article')]

class Article implements ResourceInterface
{
    use IdentifiableTrait;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $text = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class,  cascade: ['all'])]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function hasComments(): bool
    {
       return !$this->comments->isEmpty();
    }

    public function hasComment(Comment $comment): bool
    {
       return $this->comments->contains($comment);
    }

    public function removeComment(Comment $comment): void
    {
        if ($this->hasComment($comment)) {
            $this->comments->removeElement($comment);
        }
    }

    public function addComment(Comment $comment): void
    {
        if (!$this->hasComment($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }
    }
}
