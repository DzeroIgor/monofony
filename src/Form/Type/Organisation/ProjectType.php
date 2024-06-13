<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use App\Entity\Organisation\Project;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProjectType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(Project::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'app.ui.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'app.ui.description',
            ])
        ;
    }
}