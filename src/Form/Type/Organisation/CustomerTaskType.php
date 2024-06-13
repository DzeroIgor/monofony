<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use App\Context\CustomerContext;
use App\Entity\Organisation\OrganisationMembership;
use App\Entity\Organisation\Project;
use App\Entity\Organisation\Status;
use App\Entity\Organisation\Task;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerTaskType extends AbstractResourceType
{
    public function __construct(private readonly CustomerContext $customerContext)
    {
        parent::__construct(Task::class, [
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'app.ui.name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'app.ui.description',
            ])
            ->add('assignee', EntityType::class, [
                'class' => OrganisationMembership::class,
                'placeholder' => 'sylius.ui.assignee',
                'label' => 'app.ui.assignee',
            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'placeholder' => 'sylius.ui.select',
                'label' => 'app.ui.project',
                'query_builder' => function (ProjectRepository $repository) {
                    return $repository->getCustomerProjectsQueryBuilder($this->customerContext->getCustomer());
                }
            ])
        ;
    }
}