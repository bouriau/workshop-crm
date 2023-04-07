<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Model\AbstractContact;
use App\Model\MessageInterface;
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
    use TimestampableTrait;

    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[OneToMany(mappedBy: 'contact', targetEntity: ProspectMessage::class, cascade: ['persist'])]
    private Collection $messages;

    #[OneToMany(mappedBy: 'prospect', targetEntity: Action::class, cascade: ['persist'])]
    private Collection $actions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
        $this->messages = new ArrayCollection();

        $this->setCreatedAt(new \DateTime('now'));
        $this->updatedTimestamps();
    }

    public function __toString(): string
    {
        return $this->firstname.' '.$this->lastname;
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

    public function addMessage(MessageInterface $message): void
    {
        $this->messages->add($message);
    }

    public function removeMessage(MessageInterface $message): void
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
        }
    }

    public function hasMessage(MessageInterface $message): bool
    {
        return $this->messages->contains($message);
    }

    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): void
    {
        $this->actions->add($action);
    }

    public function removeAction(Action $action): void
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
        }
    }

    public function hasAction(Action $action): bool
    {
        return $this->actions->contains($action);
    }
}
