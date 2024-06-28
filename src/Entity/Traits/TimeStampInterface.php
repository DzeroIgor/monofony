<?php

declare(strict_types=1);

namespace App\Entity\Traits;
interface TimeStampInterface
{
    public function getCreatedAt(): ?\DateTimeInterface;

    public function setCreatedAt(?\DateTimeInterface $createdAt): void;

    public function getUpdatedAt(): ?\DateTimeInterface;

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void;
}