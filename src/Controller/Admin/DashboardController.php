<?php

namespace App\Controller\Admin;

use App\Entity\Action;
use App\Entity\ActionType;
use App\Entity\Customer;
use App\Entity\Lead;
use App\Entity\NoteType;
use App\Entity\Prospect;
use App\Entity\Sale;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin/{_locale}', name: 'admin')]
    public function index(): Response
    {
//        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(LeadCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App')
            ->setLocales(['fr'])
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Contact', 'fa fa-address-book')->setSubItems([
            MenuItem::linkToCrud('Lead', 'fas fa-circle-info', Lead::class),
            MenuItem::linkToCrud('Prospect', 'fas fa-message', Prospect::class),
            MenuItem::linkToCrud('Customer', 'fas fa-sack-dollar', Customer::class)
        ]);
        yield MenuItem::subMenu('Actions', 'fa fa-paper-plane')->setSubItems([
            MenuItem::linkToCrud('Action', 'fas fa-bolt', Action::class),
            MenuItem::linkToCrud('Action type', 'fas fa-tags', ActionType::class),
            MenuItem::linkToCrud('Note type', 'fas fa-tags', NoteType::class)
        ]);
        yield MenuItem::linkToCrud('Sale', 'fa fa-cart-shopping', Sale::class);

    }
}
