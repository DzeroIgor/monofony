<?php

declare(strict_types=1);

namespace App\Context;

use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Context\LocaleNotFoundException;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class RequestBasedLocaleContext implements LocaleContextInterface
{
    public function __construct(private RequestStack $requestStack, private LocaleProviderInterface $localeProvider)
    {
    }

    public function getLocaleCode(): string
    {
        $request = $this->requestStack->getMainRequest();

        if (null === $request) {
            throw new LocaleNotFoundException('No main request available.');
        }

        $localeCode = $request->attributes->get('_locale');
        if (null === $localeCode) {
            $localeCode = $request->getDefaultLocale();
        }

        $availableLocalesCodes = $this->localeProvider->getAvailableLocalesCodes();

        if (!in_array($localeCode, $availableLocalesCodes, true)) {
            throw LocaleNotFoundException::notAvailable($localeCode, $availableLocalesCodes);
        }

        return $localeCode;
    }
}
