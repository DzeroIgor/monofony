<?php

declare(strict_types=1);

namespace App\Doctrine\ORM\Type;

interface EnumTypeInterface
{
    public function getName(): string;

    static public function getValues(): array;

    static public function getChoice($value): string;

    static public function getChoices(): array;

    public static function isValueExist($value): bool;
}
