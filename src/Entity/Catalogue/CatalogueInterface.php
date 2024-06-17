<?php

declare(strict_types=1);

namespace App\Entity\Catalogue;

interface CatalogueInterface
{
    public function getTitle(): ?string;

    public function setTitle(?string $title): void;

    public function getUrl(): ?string;

    public function setUrl(?string $url): void;

    public function getCover(): ?CatalogueCover;

    public function setCover(?CatalogueCover $cover): void;
}