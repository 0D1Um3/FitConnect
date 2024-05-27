<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Изображение')
            ->setEntityLabelInPlural('Изображения Статей')
            ->setSearchFields(['name'])
            ->setDefaultSort(['photoFilename' => 'ASC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('typesSport', 'Вид спорта'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('articles', 'Название статьи')
            ->setFormTypeOptions([
                'class' => \App\Entity\Articles::class,
                'choice_label' => 'name'
            ]);
        yield ImageField::new('photoFilename', 'Изображение')
            ->setUploadDir('assets/images/articles/')
            ->setBasePath('images/articles/');

    }

}
