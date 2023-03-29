<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\AbstractContact;
use App\Repository\LeadRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: LeadRepository::class)]
class Lead extends AbstractContact
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;
}
