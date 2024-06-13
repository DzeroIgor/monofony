<?php

namespace App\Entity;

interface CodeAwareInterface
{
    public function initializeCode(): void;

    public function getCode(): ?string;

    public function setCode(?string $code): void;
}