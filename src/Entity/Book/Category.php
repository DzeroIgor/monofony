<?php

namespace App\Entity\Book;

use App\Entity\CodeAwareTrait;
use App\Entity\IdentifiableTrait;
use App\Entity\ToggleableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_book_category')]
class Category implements ResourceInterface, CodeAwareInterface
{
    use IdentifiableTrait;

    use CodeAwareTrait;

    use ToggleableTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->initializeCode();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
