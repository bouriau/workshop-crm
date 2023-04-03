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

    #[OneToMany(mappedBy: 'contact', targetEntity: ProspectMessage::class)]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();

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
}
