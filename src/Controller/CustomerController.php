<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerController extends AbstractController
{
    #[Route('/customers', name: 'customer_index', methods: "GET")]
    public function index(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();

        return $this->render('Customer/index.html.twig', [
            'customers' => $customers
        ]);
    }

    #[Route('/customer/{id}', name: 'customer_show', methods: "GET")]
    public function show(CustomerRepository $customerRepository, int $id): Response
    {
        $customer = $customerRepository->find($id);

        if (!$customer) {
            throw new NotFoundHttpException(sprintf('The customer with id %d does not exist', $id));
        }

        return $this->render('Customer/show.html.twig', [
            'customer' => $customer

        ]);
    }

    #[Route('/add_customer', name: 'customer_add', methods: "POST")]
    public function add(CustomerRepository $customerRepository, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $firstname = $data['firstname'] ?? null;
        $lastname = $data['lastname'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;

        if (!$firstname || !$lastname || !$email || !$phone) {
            $response = new JsonResponse(['message' => 'Invalid data'], 400);
            return $response;
        }

        $customer = new Customer();
        $customer->setFirstname($firstname);
        $customer->setLastname($lastname);
        $customer->setEmail($email);
        $customer->setPhone($phone);

        $customerRepository->save($customer);

        $response = new JsonResponse(['message' => sprintf('Le Client %s %s a bien été ajouté', $firstname, $lastname)], 201);
        return $response;
    }

    #[Route('/edit_customer/{id}', name: 'customer_edit', methods: "PUT")]
    public function edit(CustomerRepository $customerRepository, Request $request, int $id): Response
    {
        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new BadRequestHttpException('Invalid JSON format');
        }

        $customer = $customerRepository->find($id);

        if (!$customer) {
            throw new NotFoundHttpException(sprintf('The customer with id %d does not exist', $id));
        }

        $firstname = $data['firstname'] ?? null;
        $lastname = $data['lastname'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;

        if($firstname){
            $customer->setFirstName($firstname);
        }
        if($lastname){
            $customer->setLastName($lastname);
        }
        if($email){
            $customer->setEmail($email);
        }
        if($phone){
            $customer->setPhone($phone);
        }


        $customerRepository->save($customer);

        return new JsonResponse(['message' => 'Le Client d\'id %d a bien été supprimé', $id]);
    }

    #[Route('/remove_customer/{id}', name: 'customer_remove', methods: "DELETE")]
    public function remove(CustomerRepository $customerRepository, int $id, EntityManagerInterface $entityManager): Response
    {
        $customer = $customerRepository->find($id);

        if (!$customer) {
            throw new NotFoundHttpException(sprintf('The customer with id %d does not exist', $id));
        }

        $entityManager->remove($customer);
        $entityManager->flush();
        return new JsonResponse(['message' => sprintf('Le Client d\'id %d a bien été supprimé', $id)]);
    }
}
