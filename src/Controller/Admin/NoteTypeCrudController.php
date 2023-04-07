<?php

namespace App\Controller\Admin;

use App\Entity\NoteType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NoteTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NoteType::class;
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
