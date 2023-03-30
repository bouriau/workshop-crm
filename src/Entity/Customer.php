<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\AbstractContact;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: CustomerRepository::class)]
class Customer extends AbstractContact
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column]
    private ?int $id = null;

    #[OneToMany(mappedBy: 'customer', targetEntity: CustomerMessage::class)]
    private Collection $messages;

    #[OneToMany(mappedBy: 'customer', targetEntity: Sale::class)]
    private Collection $sales;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->sales = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(CustomerMessage $message): void
    {
        $this->messages->add($message);
    }

    public function removeMessage(CustomerMessage $message): void
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
        }
    }

    public function hasMessage(CustomerMessage $message): bool
    {
        return $this->messages->contains($message);
    }

    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addSale(Sale $sale): void
    {
        $this->sales->add($sale);
    }

    public function removeSale(Sale $sale): void
    {
        if ($this->sales->contains($sale)) {
            $this->sales->removeElement($sale);
        }
    }

    public function hasSale(Sale $sale): bool
    {
        return $this->sales->contains($sale);
    }

}
