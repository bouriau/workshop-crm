<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Lead;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LeadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lead::class);
    }

    public function countAllLead()
    {
        $contacts = $this->createQueryBuilder('a')
                              ->select('count(a.id)')
                              ->getQuery()
                              ->getSingleScalarResult();
        return $contacts;
    }

    public function countAllDeadLead()
    {
        $contacts = $this->createQueryBuilder('a')
                              ->select('count(a.id)')
                              ->where('a.aLive = false')
                              ->getQuery()
                              ->getSingleScalarResult();
        return $contacts;
    }

    public function countAllAliveLead()
    {
        $contacts = $this->createQueryBuilder('a')
                              ->select('count(a.id)')
                              ->where('a.aLive = true')
                              ->getQuery()
                              ->getSingleScalarResult();
        return $contacts;
    }
}
