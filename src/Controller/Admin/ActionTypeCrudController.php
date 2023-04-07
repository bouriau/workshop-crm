<?php

namespace App\Controller\Admin;

use App\Entity\ActionType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActionTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ActionType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('code'),
            TextField::new('name'),
        ];
    }
}
