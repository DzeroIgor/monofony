<?php

namespace App\Entity\Traits;

interface CodeAwareInterface
{
    public function initializeCode(): void;

    public function getCode(): ?string;

    public function setCode(?string $code): void;
}