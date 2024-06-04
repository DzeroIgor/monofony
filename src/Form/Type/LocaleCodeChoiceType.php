<?php

declare(strict_types=1);

namespace App\Form\Type;

use Sylius\Bundle\LocaleBundle\Form\Type\LocaleChoiceType;
use Sylius\Bundle\ResourceBundle\Form\DataTransformer\ResourceToIdentifierTransformer;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

class LocaleCodeChoiceType extends AbstractType
{
    public function __construct(private readonly RepositoryInterface $localeRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ReversedTransformer(new ResourceToIdentifierTransformer($this->localeRepository, 'code')));
    }

    public function getParent(): string
    {
        return LocaleChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'app_locale_code';
    }
}
