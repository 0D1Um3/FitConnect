<?php

namespace App\Controller\Admin;

use App\Entity\TypeSport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeSportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeSport::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Вид спорта')
            ->setEntityLabelInPlural('Виды спорта')
            ->setSearchFields(['sportName'])
            ->setDefaultSort(['sportName' => 'ASC']);
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('sport_name', 'Вид спорта');
        yield IntegerField::new('entries', 'Количество записей');
        yield ImageField::new('titleImage', 'Титульное изображение')
            ->setUploadDir('assets/images/typeSport/')
            ->setBasePath('images/typeSport/');
    }
}
