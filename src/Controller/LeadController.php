<?php

namespace App\Controller;

use App\Repository\LeadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeadController extends AbstractController
{
    #[Route('/leads', name: 'lead_index')]
    public function index(LeadRepository $leadRepository): Response
    {
        $leads = $leadRepository->findAll();

        return $this->render('Lead/index.html.twig', [
            'leads' => $leads
        ]);
    }
}
