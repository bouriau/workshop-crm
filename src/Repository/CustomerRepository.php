<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

        public function countAllCustomer()
    {
        $contacts = $this->createQueryBuilder('a')
                              ->select('count(a.id)')
                              ->getQuery()
                              ->getSingleScalarResult();
        return $contacts;
    }
}
