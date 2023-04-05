<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use App\Entity\Lead;
use App\Entity\Prospect;
use App\Repository\LeadRepository;
use App\Repository\ProspectRepository;
use App\Repository\CustomerRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected $leadRepository;
    protected $prospectRepository;
    protected $customerRepository;

    public function __construct(
        LeadRepository $leadRepository,
        ProspectRepository $prospectRepository,
        CustomerRepository $customerRepository
        ) 
    {
        $this->leadRepository = $leadRepository;
        $this->prospectRepository = $prospectRepository;
        $this->customerRepository = $customerRepository;
    }

    #[Route('/admin/{_locale}', name: 'admin')]
    public function index(): Response
    {
       return $this->render('bundles\EasyAdminBundle\page\content.html.twig',[
        'countDeadLeads' => $this->leadRepository->countAllDeadLead(),
        'countAliveLeads' => $this->leadRepository->countAllAliveLead(),
        'countLeads' => $this->leadRepository->countAllLead(),
        'countDeadProspects' => $this->prospectRepository->countAllDeadProspect(),
        'countAliveProspects' => $this->prospectRepository->countAllAliveProspect(),
        'countProspects' => $this->prospectRepository->countAllProspect(),
        'countCustomers' => $this->customerRepository->countAllCustomer()
       ]);
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
            MenuItem::linkToCrud('Lead', 'fas fa-list', Lead::class),
            MenuItem::linkToCrud('Prospect', 'fas fa-list', Prospect::class),
            MenuItem::linkToCrud('Customer', 'fas fa-list', Customer::class)
        ]);
    }
}
