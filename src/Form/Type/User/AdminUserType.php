<?php

declare(strict_types=1);

namespace App\Form\Type\User;

use App\Entity\User\AdminUser;
use App\Form\Type\LocaleCodeChoiceType;
use Sylius\Bundle\LocaleBundle\Form\Type\LocaleChoiceType;
use Sylius\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminUserType extends UserType
{
    public function __construct()
    {
        parent::__construct(AdminUser::class, ['sylius']);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('firstName', TextType::class, [
                'label' => 'sylius.ui.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'sylius.ui.last_name',
            ])
            ->add('avatar', AdminAvatarType::class, [
                'label' => 'app.ui.avatar',
                'required' => false,
            ])
            ->add('localeCode', LocaleCodeChoiceType::class, [
                'label' => 'app.ui.locale',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_admin_user';
    }
}
