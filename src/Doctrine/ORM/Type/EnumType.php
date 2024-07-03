<?php

declare(strict_types=1);

namespace App\Doctrine\ORM\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class EnumType extends Type implements EnumTypeInterface
{
    static protected string $name;
    static protected string $choicePrefix = '';
    static protected string $choiceSuffix = '';
    static protected array $values = [];

    public function getName(): string
    {
        return static::$name;
    }
    
    static public function getValues(): array
    {
        return static::$values;
    }

    static public function getChoice($value): string
    {
        return static::$choicePrefix.strtolower($value).static::$choiceSuffix;
    }

    static public function getChoices($values=null): array
    {
        $choices = array();
        $values = $values ?: static::$values;
        foreach($values as $value){
            $choice = static::getChoice($value);
            $choices[$choice] = $value;
        }

        return $choices;
    }

    static public function getTranslatedValues(TranslatorInterface $translator, $prefix = ''): array
    {
        $choices = array();
        foreach(static::$values as $value){
            $choice = static::getChoice($value);
            $choices[$value] = $translator->trans($prefix.$choice);
        }

        return $choices;
    }

    static public function getTranslatedValue(TranslatorInterface $translator, $value, $prefix = ''): string
    {
        $choice = static::getChoice($value);
        return $translator->trans($prefix.$choice);
    }

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = array_map(function($val) { return "'".$val."'"; }, static::$values);

        return "ENUM(".implode(", ", $values).") COMMENT '(DC2Type:".static::$name.")'";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (!in_array($value, static::$values)) {
            throw new \InvalidArgumentException("Invalid '".static::$name."' value.");
        }
        return $value;
    }

    /**
     * Check if some string value exists in the array of ENUM values
     *
     * @param string $value ENUM value
     *
     * @return bool
     */
    public static function isValueExist($value): bool
    {
        return in_array($value, static::getValues());
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }
}
