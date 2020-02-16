<?php

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => "Nom d'utilisateur"])
            ->add('password',PasswordType::class)
            ->add('confirm_password', PasswordType::class)
            ->add('email', EmailType::class, ['label' => 'Adresse email'])
            ->add('roles', ChoiceType::class,  [
                'label' => 'Role',
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'multiple'  => true,
            ])
        ;
    }
}