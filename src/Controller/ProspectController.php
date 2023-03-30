<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Repository\ProspectRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProspectController extends AbstractController
{
    #[Route('/prospects', name: 'prospect_index')]
    public function index(ProspectRepository $prospectRepository): Response
    {
        $prospects = $prospectRepository->findAll();

        return $this->render('Prospect/index.html.twig', [
            'prospects' => $prospects
        ]);
    }

    #[Route('/prospect/{id}', name: 'prospect_detail')]
    public function detail(ProspectRepository $prospectRepository, int $id): Response
    {
        $prospect = $prospectRepository->find($id);

        return $this->render('Prospect/detail.html.twig', [
            'prospect' => $prospect
        ]);
    }
}
