<?php

declare(strict_types=1);

namespace App\Form\Type\Project;

use Sylius\Bundle\ResourceBundle\Form\Type\ResourceAutocompleteChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectAutocompleteChoiceType extends AbstractType
{
    public function getParent(): string
    {
        return ResourceAutocompleteChoiceType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'resource' => 'app.project',
            'choice_name' => 'name',
            'choice_value' => 'id',
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['remote_criteria_type'] = 'contains';
        $view->vars['remote_criteria_name'] = 'phrase';
    }

    public function getBlockPrefix(): string
    {
        return 'app_project_autocomplete';
    }
}
