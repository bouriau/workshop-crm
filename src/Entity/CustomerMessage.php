<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Model\AbstractMessage;
use App\Model\MessageInterface;
use App\Repository\CustomerMessageRepository;
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
#[Entity(repositoryClass: CustomerMessageRepository::class)]
class CustomerMessage extends AbstractMessage
{
    use TimestampableTrait;

    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: Customer::class, inversedBy: 'messages')]
    #[JoinColumn(name: 'customer_id', referencedColumnName: 'id')]
    private Customer|null $contact = null;

    /**
     * One Message has Many Responses.
     */
    #[OneToMany(mappedBy: 'parent', targetEntity: CustomerMessage::class)]
    protected Collection $responses;

    /** Many Responses have One Parent Message. */
    #[ManyToOne(targetEntity: CustomerMessage::class, inversedBy: 'responses')]
    #[JoinColumn(name: 'parent_id', referencedColumnName: 'id')]
    protected CustomerMessage|null $parent = null;

    public function __construct(string $subject, string $message)
    {
        parent::__construct($subject, $message);

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

    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(MessageInterface $response): void
    {
        $this->responses->add($response);
    }

    public function removeResponse(MessageInterface $response): void
    {
        if ($this->responses->contains($response)) {
            $this->responses->removeElement($response);
        }
    }

    public function hasResponse(MessageInterface $response): bool
    {
        return $this->responses->contains($response);
    }

    /**
     * @return MessageInterface|null
     */
    public function getParent(): ?MessageInterface
    {
        return $this->parent;
    }

    /**
     * @param MessageInterface|null $parent
     */
    public function setParent(?MessageInterface $parent): void
    {
        $this->parent = $parent;
    }
}
