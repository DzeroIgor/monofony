<?php

declare(strict_types=1);

namespace App\Translation\Provider;

use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;

class TranslationLocaleProvider implements TranslationLocaleProviderInterface
{
    public function __construct(private readonly RepositoryInterface $localeRepository, private readonly string $defaultLocaleCode)
    {
    }

    public function getDefinedLocalesCodes(): array
    {
        $locales = $this->localeRepository->findAll();

        return array_map(
            function (LocaleInterface $locale) {
                return (string) $locale->getCode();
            },
            $locales,
        );
    }

    public function getDefaultLocaleCode(): string
    {
        return $this->defaultLocaleCode;
    }
}