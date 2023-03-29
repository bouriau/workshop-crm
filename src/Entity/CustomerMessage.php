<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\AbstractMessage;
use App\Repository\CustomerMessageRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: CustomerMessageRepository::class)]
class CustomerMessage extends AbstractMessage
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: Customer::class, inversedBy: 'features')]
    #[JoinColumn(name: 'customer_id', referencedColumnName: 'id')]
    private Customer|null $contact = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Customer|null
     */
    public function getContact(): ?Customer
    {
        return $this->contact;
    }

    /**
     * @param Customer|null $contact
     */
    public function setContact(?Customer $contact): void
    {
        $this->contact = $contact;
    }
}
