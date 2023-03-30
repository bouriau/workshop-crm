<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerController extends AbstractController
{
    #[Route('/customers', name: 'customer_index')]
    public function index(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();

        return $this->render('Customer/index.html.twig', [
            'customers' => $customers
        ]);
    }

    #[Route('/customer/{id}', name: 'customer_show')]
    public function show(CustomerRepository $customerRepository, int $id): Response
    {
        $customer = $customerRepository->find($id);

        if (!$customer) {
            throw new NotFoundHttpException('Customer not found');
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

        $response = new JsonResponse(['message' => 'Customer added'], 201);
        return $response;
    }
}
