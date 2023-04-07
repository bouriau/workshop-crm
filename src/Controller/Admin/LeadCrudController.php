<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Lead;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LeadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lead::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        // this action executes the 'renderInvoice()' method of the current CRUD controller
        $viewInvoice = Action::new('addMessage', 'Message', 'fa fa-file-invoice')
            ->linkToCrudAction('addMessage');

        // if the method is not defined in a CRUD controller, link to its route
//        $sendInvoice = Action::new('sendInvoice', 'Send invoice', 'fa fa-envelope')
            // if the route needs parameters, you can define them:
            // 1) using an array
//            ->linkToRoute('invoice_send', [
//                'send_at' => (new \DateTime('+ 10 minutes'))->format('YmdHis'),
//            ])
//
//            // 2) using a callable (useful if parameters depend on the entity instance)
//            // (the type-hint of the function argument is optional but useful)
//            ->linkToRoute('invoice_send', function (Order $order): array {
//                return [
//                    'uuid' => $order->getId(),
//                    'method' => $order->getUser()->getPreferredSendingMethod(),
//                ];
//            });


        return $actions
            ->add(Crud::PAGE_DETAIL, $viewInvoice)
            ->add(Crud::PAGE_EDIT, $viewInvoice)
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('phone'),
            EmailField::new('email'),
            BooleanField::new('aLive'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }

    public function addMessage(AdminContext $context)
    {
        dump($context);
        dd($context->getEntity()->getInstance());
//        $order = $context->getEntity()->getInstance();

        // add your logic here...
    }
}
