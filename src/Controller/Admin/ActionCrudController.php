<?php

namespace App\Controller\Admin;

use App\Entity\Action;
use App\Entity\Customer;
use App\Entity\Prospect;
use Cassandra\Custom;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Action::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $entity = $this->getContext()->getEntity()->getInstance();

        if ($entity instanceof Prospect) {
            $contactField = AssociationField::new('prospect')
                ->setCrudController(ProspectCrudController::class)
                ->setFormTypeOption('attr',['readonly' => true])
                ->renderAsNativeWidget();
        } elseif ($entity instanceof Customer) {
            $contactField = AssociationField::new('customer')
                ->setCrudController(CustomerCrudController::class)
                ->setFormTypeOption('attr',['readonly' => true])
                ->renderAsNativeWidget();
        }

        $fields = [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('type'),
            TextField::new('subject'),
            TextareaField::new('message'),
            CollectionField::new('notes')->useEntryCrudForm(NoteCrudController::class)
        ];

        if (isset($contactField)) {
            $fields[] = $contactField;
        }

        return $fields;
    }
}
