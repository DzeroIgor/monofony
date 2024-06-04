<?php

declare(strict_types=1);

namespace App\Entity\Book;

use App\Entity\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_book_translation')]
class BookTranslation extends AbstractTranslation implements ResourceInterface
{
    use IdentifiableTrait;

    #[ORM\Column(type: 'string')]
    protected ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
}
