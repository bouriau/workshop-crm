<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\AbstractContact;
use App\Repository\ProspectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: ProspectRepository::class)]
class Prospect extends AbstractContact
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[OneToMany(mappedBy: 'prospect', targetEntity: ProspectMessage::class)]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
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

    public function addMessage(ProspectMessage $message): void
    {
        $this->messages->add($message);
    }

    public function removeMessage(ProspectMessage $message): void
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
        }
    }

    public function hasMessage(ProspectMessage $message): bool
    {
        return $this->messages->contains($message);
    }
}
