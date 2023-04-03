<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\SaleRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: SaleRepository::class)]
class Sale
{
    use TimestampableTrait;

    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[Column(type: "string", nullable: false)]
    private string $name;

    #[Column(type: "text", nullable: false)]
    private string $description;

    #[Column(type: "decimal", nullable: false)]
    private float $price;

    #[ManyToOne(targetEntity: Customer::class, inversedBy: 'sales')]
    #[JoinColumn(name: 'customer_id', referencedColumnName: 'id')]
    private Customer|null $customer = null;

    public function __construct($name, $description, $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;

        $this->setCreatedAt(new \DateTime('now'));
        $this->updatedTimestamps();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     */
    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }
}
