<?php

declare(strict_types=1);

namespace App\Context;

use App\Entity\User\AdminUser;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Context\LocaleNotFoundException;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;

final class AdminUserBasedLocaleContext implements LocaleContextInterface
{
    public function __construct(private Security $security, private LocaleProviderInterface $localeProvider)
    {
    }

    public function getLocaleCode(): string
    {
        $admin = $this->security->getUser();

        if (!$admin instanceof AdminUser) {
            throw new LocaleNotFoundException('No main request available.');
        }

        $localeCode = $admin->getLocaleCode();

        $availableLocalesCodes = $this->localeProvider->getAvailableLocalesCodes();

        if (!in_array($localeCode, $availableLocalesCodes, true)) {
            throw LocaleNotFoundException::notAvailable($localeCode, $availableLocalesCodes);
        }

        return $localeCode;
    }
}
