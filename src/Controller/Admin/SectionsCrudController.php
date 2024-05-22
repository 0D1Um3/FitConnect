<?php

namespace App\Controller\Admin;

use App\Entity\Sections;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
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
            ->setEntityLabelInSingular('Секцию')
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
        yield IntegerField::new('price', 'Стоимость посещения');
        yield AssociationField::new('cities')->autocomplete();
        yield AssociationField::new('typesSport')->autocomplete();
        yield BooleanField::new('it_free', 'Посещение бесплатно?');
        yield TextareaField::new('description', 'Описание');
        yield TextareaField::new('link_to_map', 'Ссылка на карту')->hideOnIndex();
        yield TextField::new('address', 'Местоположение секции');
        yield TextField::new('contact_phone', 'Контактный телефон');
        yield EmailField::new('contact_email', 'Почта для связи');
        yield IntegerField::new('count_places', 'Количество мест');
        yield TextareaField::new('for_who', 'Для кого');
        yield TextareaField::new('format', 'Формат проведения');
        yield BooleanField::new('softDelete', 'Мягкая блокировка');
    }
}
