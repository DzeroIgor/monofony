<?php

namespace App\Entity\Traits;
interface ToggleableInterface
{
    public function isEnabled(): bool;

    public function setEnabled(?bool $enabled): void;

    public function enable(): void;

    public function disable(): void;
}