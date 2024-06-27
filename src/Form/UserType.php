<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
//use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //dd($builder);

        $builder
            ->add('username',TextType::class)
            ->add('password',PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('mail',EmailType::class)
            ->add('Role',EntityType::class,
                [
                    'class'=> Role::class,
                    'choice_label'=>'name'
                ]

            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            "validation_groups" => ['Default','registration'],
        ]);
    }
}
