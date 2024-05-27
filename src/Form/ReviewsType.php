<?php

namespace App\Form;

use App\Entity\Reviews;
use App\Entity\Sections;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Заголовок',
            ])
            ->add('positive', TextareaType::class, [
                'attr' => ['rows' => 5],
                'label' => 'Плюсы',
                'required' => false,
            ])
            ->add('negative', TextareaType::class, [
                'attr' => ['rows' => 5],
                'label' => 'Минусы',
                'required' => false,
            ])
            ->add('textReview', TextareaType::class, [
                'label' => 'Текст отзыва'
            ])
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'star-rating'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
