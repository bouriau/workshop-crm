<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: ActionRepository::class)]
class Action
{
    use TimestampableTrait;

    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: ActionType::class, inversedBy: 'actions')]
    #[JoinColumn(name: 'action_type_id', referencedColumnName: 'id')]
    private ActionType|null $type = null;

    #[ManyToOne(targetEntity: Prospect::class, inversedBy: 'action')]
    #[JoinColumn(name: 'prospect_id', referencedColumnName: 'id', nullable: true)]
    private Prospect|null $prospect = null;

    #[ManyToOne(targetEntity: Customer::class, inversedBy: 'actions')]
    #[JoinColumn(name: 'customer_id', referencedColumnName: 'id', nullable: true)]
    private Customer|null $customer = null;

    #[Column(type: "string", nullable: false)]
    protected ?string $subject = null;

    #[Column(type: "text", nullable: false)]
    protected ?string $message = null;

    #[OneToMany(mappedBy: 'action', targetEntity: Note::class, cascade: ['persist'])]
    private Collection $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();

        $this->setCreatedAt(new \DateTime('now'));
        $this->updatedTimestamps();
    }

    public function __toString(): string
    {
        return $this->subject;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ActionType|null
     */
    public function getType(): ?ActionType
    {
        return $this->type;
    }

    /**
     * @param ActionType|null $type
     */
    public function setType(?ActionType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Prospect|null
     */
    public function getProspect(): ?Prospect
    {
        return $this->prospect;
    }

    /**
     * @param Prospect|null $prospect
     */
    public function setProspect(?Prospect $prospect): void
    {
        $this->prospect = $prospect;
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

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     */
    public function setSubject(?string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): void
    {
        $this->notes->add($note);
    }

    public function removeNote(Note $note): void
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
        }
    }

    public function hasNote(Note $note): bool
    {
        return $this->notes->contains($note);
    }
}
