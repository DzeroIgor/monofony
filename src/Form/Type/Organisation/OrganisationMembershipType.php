<?php

declare(strict_types=1);

namespace App\Form\Type\Organisation;

use App\Entity\Customer\Customer;
use App\Entity\Organisation\Position;
use App\Entity\Organisation\Role;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class OrganisationMembershipType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('customer', EntityType::class, [
                'label' => 'sylius.form.customer',
                'placeholder' => 'sylius.ui.select',
                'class' => Customer::class,
            ])
            ->add('position', EnumType::class, [
                'class' => Position::class,
                'placeholder' => 'sylius.ui.select',
                'label' => 'app.ui.position',
            ])
            ->add('role', EnumType::class, [
                'class' => Role::class,
                'placeholder' => 'sylius.ui.role',
                'label' => 'app.ui.role',
            ])
            ->add('email', TextType::class, [
                'label' => 'app.ui.email',
            ])
        ;
    }
}