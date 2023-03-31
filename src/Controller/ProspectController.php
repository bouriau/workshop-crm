<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Repository\ProspectRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProspectController extends AbstractController
{
    //LISTE
    #[Route('/prospects', name: 'prospect_index')]
    public function index(ProspectRepository $prospectRepository): Response
    {
        $prospects = $prospectRepository->findAll();

        return $this->render('Prospect/index.html.twig', [
            'prospects' => $prospects
        ]);
    }

    //DETAIL
    #[Route('/prospect/{id}', name: 'prospect_detail')]
    public function detail(ProspectRepository $prospectRepository, int $id): Response
    {
        $prospect = $prospectRepository->find($id);

        if (!$prospect) {
            throw new NotFoundHttpException(sprintf('not exist'));
        }

        return $this->render('Prospect/detail.html.twig', [
            'prospect' => $prospect
        ]);
    }

    //AJOUT
    #[Route('/add-prospect/', name: 'prospect_add')]
    public function add(ProspectRepository $prospectRepository, Request $request): Response
    {
        $prospect = new Prospect();
        $prospect->setFirstname('baba');
        $prospect->setLastname('test');
        $prospect->setEmail('babatest@idk.fr');
        $prospect->setPhone('012354698');

        $prospectRepository->save($prospect);

        $response = new JsonResponse(['message' => sprintf($prospect->getFirstname().' '.$prospect->getLastname().' a ete ajoute')], 201);
        return $response;
    }

    //EDIT
    #[Route('/edit-prospect/{id}', name: 'prospect_edit')]
    public function edit(ProspectRepository $prospectRepository, int $id): Response
    {
        $prospect = $prospectRepository->find($id);

        if (!$prospect) {
            throw new NotFoundHttpException(sprintf('not exist'));
        }

        $firstname = $data['firstname'] ?? null;
        $lastname = $data['lastname'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;

        if ($firstname) {
            $prospect->setFirstName($firstname);
        }
        if ($lastname) {
            $prospect->setLastName($lastname);
        }
        if ($email) {
            $prospect->setEmail($email);
        }
        if ($phone) {
            $prospect->setPhone($phone);
        }

        $prospectRepository->save($prospect);

        return $this->render('Prospect/detail.html.twig', [
            'prospect' => $prospect
        ]);
    }

    //SUPPRESSION
    #[Route('/remove-prospect/{id}', name: 'prospect_remove')]
    public function remove(ProspectRepository $prospectRepository, int $id, EntityManagerInterface $entityManager): Response
    {
        $prospect = $prospectRepository->find($id);

        if (!$prospect) {
            throw new NotFoundHttpException(sprintf('not exist'));
        }

        $entityManager->remove($prospect);
        $entityManager->flush();

        return new JsonResponse(['message' => sprintf('delete'.$id)]);
    }
}
