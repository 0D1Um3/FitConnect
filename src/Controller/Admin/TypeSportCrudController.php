<?php

namespace App\Controller\Admin;

use App\Entity\TypeSport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
            ->setEntityLabelInSingular('TypeSport')
            ->setEntityLabelInPlural('Виды спорта')
            ->setSearchFields(['sportName'])
            ->setDefaultSort(['sportName' => 'ASC']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('sport_name', 'Вид спорта'),
        ];
    }
}
