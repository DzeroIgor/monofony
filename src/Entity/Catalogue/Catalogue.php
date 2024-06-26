<?php

namespace App\Entity\Catalogue;

use App\Entity\CodeAwareTrait;
use App\Entity\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

#[ORM\Entity]
#[ORM\Table(name: 'app_catalogue')]
class Catalogue implements ResourceInterface, CatalogueInterface
{
    use IdentifiableTrait;

    use CodeAwareTrait;

    #[ORM\Column(type: 'string')]
    private ?string $title = null;

    #[ORM\Column(type: 'string')]
    private ?string $url = null;

    #[ORM\OneToOne(targetEntity: CatalogueCover::class, cascade: ['persist'])]
    private ?CatalogueCover $cover = null;

    public function __construct()
    {
        $this->initializeCode();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getCover(): ?CatalogueCover
    {
        return $this->cover;
    }

    public function setCover(?CatalogueCover $cover): void
    {
        $this->cover = $cover;
    }
}
