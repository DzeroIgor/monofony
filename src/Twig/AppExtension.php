<?php

namespace App\Twig;

use Symfony\Component\Intl\Currencies;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
        ];
    }

    public function formatPrice(int $amount, string $currency): string
    {
        $symbol = Currencies::getSymbol($currency);
        $price = number_format($amount / 100, 2);

        return sprintf('%s%s', $symbol, $price);
    }
}
