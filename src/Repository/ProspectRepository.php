<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Prospect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProspectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prospect::class);
    }

    public function countAllProspect()
    {
        $contacts = $this->createQueryBuilder('a')
                              ->select('count(a.id)')
                              ->getQuery()
                              ->getSingleScalarResult();
        return $contacts;
    }

    public function countAllDeadProspect()
    {
        $contacts = $this->createQueryBuilder('a')
                              ->select('count(a.id)')
                              ->where('a.aLive = false')
                              ->getQuery()
                              ->getSingleScalarResult();
        return $contacts;
    }

    public function countAllAliveProspect()
    {
        $contacts = $this->createQueryBuilder('a')
                              ->select('count(a.id)')
                              ->where('a.aLive = true')
                              ->getQuery()
                              ->getSingleScalarResult();
        return $contacts;
    }
}
