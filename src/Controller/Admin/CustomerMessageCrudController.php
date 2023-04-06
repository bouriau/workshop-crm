<?php

namespace App\Controller\Admin;

use App\Entity\CustomerMessage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerMessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CustomerMessage::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('contact')
                ->setCrudController(CustomerCrudController::class)
                ->setFormTypeOption('attr',['readonly' => true])
                ->renderAsNativeWidget()
            ,
            TextField::new('subject'),
            TextField::new('message'),
        ];
    }

}
