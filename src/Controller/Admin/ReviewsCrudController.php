<?php

namespace App\Controller\Admin;

use App\Entity\Reviews;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reviews::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Отзыв')
            ->setEntityLabelInPlural('Отзывы')
            ->setSearchFields(['author', 'text_review', 'email', 'title', 'positive', 'negative'])
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('sections', 'Секция'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('sections', 'Секция')
            ->setFormTypeOptions(['choice_label' => 'name']);
        yield AssociationField::new('users', 'Пользователь')
            ->setFormTypeOptions([
                'class' => \App\Entity\User::class,
                'choice_label' => 'login'
            ]);
        yield TextField::new('title', 'Заголовок');
        yield IntegerField::new('rating', 'Рэйтинг');
        yield TextareaField::new('positive', 'Плюсы');
        yield TextareaField::new('negative', 'Минусы');
        yield TextareaField::new('textReview', 'Текст отзыва');
        yield TextField::new('state', 'Состояние');

        $createdAt = DateTimeField::new('createdAt', 'Дата написания')->setFormTypeOptions([
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text'
        ]);
        if (Crud::PAGE_EDIT === $pageName) {
            yield $createdAt->setFormTypeOption('disabled', true);
        }
    }

}
