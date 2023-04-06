<?php

namespace App\Controller\Admin;

use App\Entity\ProspectMessage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProspectMessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProspectMessage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('contact')
                ->setCrudController(ProspectCrudController::class)
                ->setFormTypeOption('attr',['readonly' => true])
                ->renderAsNativeWidget()
            ,
            TextField::new('subject'),
            TextField::new('message'),

//            AssociationField::new('parent')
//                ->setCrudController(ProspectMessageCrudController::class)
//                ->setFormTypeOption('attr',['readonly' => true])
//                ->renderAsNativeWidget()
//            ,
//            CollectionField::new('responses')->useEntryCrudForm(ProspectMessageCrudController::class)
        ];
    }
}
