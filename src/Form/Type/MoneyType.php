<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Intl\Currencies;

class MoneyType extends AbstractType
{
    public function getParent(): string
    {
        return \Symfony\Component\Form\Extension\Core\Type\MoneyType::class;
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        parent::buildView($view, $form, $options);

        $view->vars['currency'] = Currencies::getSymbol($options['currency']);
    }

    public function getBlockPrefix()
    {
        return 'app_money';
    }
}
