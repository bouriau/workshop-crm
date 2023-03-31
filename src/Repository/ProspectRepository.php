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
    
    public function save(Prospect $prospect)
    {
        $this->_em->persist($prospect);
        $this->_em->flush();
    }
}
