<?php

namespace App\Controller\Admin;

use App\Entity\Sections;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SectionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sections::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Section')
            ->setEntityLabelInPlural('Секции')
            ->setSearchFields(['name', 'price'])
            ->setDefaultSort(['name' => 'ASC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('typesSport', 'Вид спорта'))
            ->add(EntityFilter::new('cities', 'Города'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Название секции');
        yield TextField::new('price', 'Стоимость посещения');
        yield BooleanField::new('it_free', 'Посещение бесплатно?');
        yield TextareaField::new('description', 'Описание');
        yield TextField::new('latitude', 'Широта');
        yield TextField::new('longitude', 'Долгота');
        yield TextField::new('contact_phone', 'Контактный телефон');
        yield EmailField::new('contact_email', 'Почта для связи');
        yield TextareaField::new('for_who', 'Для кого');
        yield TextareaField::new('format', 'Формат проведения');
    }
}
