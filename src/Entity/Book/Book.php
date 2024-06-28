<?php

namespace App\Entity\Book;

use App\Entity\Traits\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;


#[ORM\Entity]
#[ORM\Table(name: 'app_book')]
class Book implements ResourceInterface, TranslatableInterface
{
    use IdentifiableTrait;

    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(length: 255)]
    private ?string $publishingHouse = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    private ?Category $literatureCategory = null;

    #[ORM\Column(unique: true)]
    private ?string $isbn = null;

    #[ORM\Column(length: 255)]
    private ?string $age = null;

    #[ORM\Column(type: 'integer')]
    private ?int $price = null;

   #[ORM\Column(type: 'string', nullable: true, length: 5)]
    private ?string $currency = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $publishedAt = null;

    #[ORM\OneToOne(targetEntity: BookCover::class, cascade: ['persist'])]
    private ?BookCover $cover = null;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    public function getTitle(): ?string
    {
        return $this->getTranslation()->getTitle();
    }

    public function setTitle(?string $title): void
    {
        $this->getTranslation()->setTitle($title);
    }

    public function getPublishingHouse(): ?string
    {
        return $this->publishingHouse;
    }

    public function setPublishingHouse(?string $publishingHouse): void
    {
        $this->publishingHouse = $publishingHouse;
    }

    public function getLiteratureCategory(): ?Category
    {
        return $this->literatureCategory;
    }

    public function setLiteratureCategory(?Category $literatureCategory): void
    {
        $this->literatureCategory = $literatureCategory;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): void
    {
        $this->age = $age;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    public function getCover(): ?BookCover
    {
        return $this->cover;
    }

    public function setCover(?BookCover $cover): void
    {
        $this->cover = $cover;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getMoney(): array
    {
        return [
            'price' => $this->price,
            'currency' => $this->currency,
        ];
    }
    protected function createTranslation(): TranslationInterface
    {
        return new BookTranslation();
    }
}
