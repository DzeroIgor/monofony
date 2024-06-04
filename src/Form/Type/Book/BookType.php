<?php

declare(strict_types=1);

namespace App\Form\Type\Book;

use App\Entity\Book\Book;
use App\Form\Type\DatePickerType;
use App\Form\Type\MoneyType;

use Sylius\Bundle\CurrencyBundle\Form\Type\CurrencyChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceAutocompleteChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class BookType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Book::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('author', TextType::class, [
                'label' => 'app.ui.author',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => BookTranslationType::class,
            ])
            ->add('publishingHouse', TextType::class, [
                'label' => 'app.ui.publishing_house',
            ])
            ->add('literatureCategory', TextareaType::class, [
                'label' => 'app.ui.literature_category',
            ])
            ->add('literatureCategory', CategoryAutocompleteChoiceType::class, [
                'label' => 'app.ui.category',
                'placeholder' => 'Choose a category',
            ])
            ->add('isbn', TextType::class, [
                'label' => 'app.ui.isbn',
            ])
            ->add('age', ChoiceType::class, [
                'label' => 'app.ui.age',
                'placeholder' => 'choose',
                'choices' => [
                    '0-5 years' => '0-5 years',
                    '5-7 years' => '5-7 years',
                    '7-9 years' => '7-9 years',
                    '9-12 years' => '9-12 years',
                    '12-18 years' => '12-18 years',
                    'Adults' => 'Adults',
                ],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'app.ui.price',
                'currency' => 'USD',
                'divisor' => 100,
            ])
            ->add('currency', CurrencyChoiceType::class, [
                'label' => 'app.ui.currency',
            ])
            ->add('publishedAt', DatePickerType::class, [
                'label' => 'app.ui.published_at',
            ])
            ->add('cover', BookCoverType::class, [
                'label' => 'Cover',
            ])

        ;
    }
}
