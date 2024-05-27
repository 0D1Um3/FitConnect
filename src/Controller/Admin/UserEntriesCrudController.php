<?php

namespace App\Controller\Admin;

use App\Entity\UserEntries;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserEntriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserEntries::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('sections', 'Секция')
            ->setFormTypeOptions(['choice_label' => 'name']);
        yield AssociationField::new('user', 'Пользователь')
            ->setFormTypeOptions([
                'class' => \App\Entity\User::class,
                'choice_label' => 'login'
            ]);
        $createdAt = DateTimeField::new('createdAt', 'Дата написания')->setFormTypeOptions([
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text'
        ]);
        if (Crud::PAGE_EDIT === $pageName) {
            yield $createdAt->setFormTypeOption('disabled', true);
        }
    }

}
