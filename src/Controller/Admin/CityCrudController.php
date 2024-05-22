<?php

namespace App\Controller\Admin;

use App\Entity\City;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return City::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Город секции')
            ->setEntityLabelInPlural('Города секций')
            ->setSearchFields(['cityName'])
            ->setDefaultSort(['cityName' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('cityName');
    }
}
