<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Validator\PasswordStrength;
use App\Validator\PasswordStrengthValidator;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('login', TextType::class)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('patronymic', TextType::class)
            ->add('phoneNumber', TelType::class)
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Ваш пароль должен быть не короче {{ limit }} символов',
                        'max' => 4096,
                    ]),
//                    new PasswordStrength(),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
