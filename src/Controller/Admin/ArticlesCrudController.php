<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
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
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Статью')
            ->setEntityLabelInPlural('Статьи')
            ->setSearchFields(['name'])
            ->setDefaultSort(['name' => 'ASC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('typesSport', 'Вид спорта'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('typesSport', 'Вид спорта');
        yield TextField::new('name');
        yield TextEditorField::new('text');
        yield ImageField::new('title_image')->setUploadDir('assets/images/');

        $createdAt = DateTimeField::new('createdAt')->setFormTypeOptions([
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text',
        ]);
        if (Crud::PAGE_EDIT === $pageName) {
            yield $createdAt->setFormTypeOption('disabled', true);
        } else {
            yield $createdAt;
        }

    }

}
