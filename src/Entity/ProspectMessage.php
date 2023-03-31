<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Model\AbstractMessage;
use App\Model\MessageInterface;
use App\Repository\ProspectMessageRepository;
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
#[Entity(repositoryClass: ProspectMessageRepository::class)]
class ProspectMessage extends AbstractMessage
{
    use TimestampableTrait;

    #[Id]
    #[GeneratedValue]
    #[Column]
    protected ?int $id = null;

    #[ManyToOne(targetEntity: Prospect::class, inversedBy: 'messages')]
    #[JoinColumn(name: 'prospect_id', referencedColumnName: 'id')]
    private Prospect|null $contact = null;

    /**
     * One Message has Many Responses.
     */
    #[OneToMany(mappedBy: 'parent', targetEntity: ProspectMessage::class)]
    protected Collection $responses;

    /** Many Responses have One Parent Message. */
    #[ManyToOne(targetEntity: ProspectMessage::class, inversedBy: 'responses')]
    #[JoinColumn(name: 'parent_id', referencedColumnName: 'id')]
    protected ProspectMessage|null $parent = null;

    public function __construct($subject, $message)
    {
        parent::__construct($subject, $message);

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
     * @return Prospect|null
     */
    public function getContact(): ?Prospect
    {
        return $this->contact;
    }

    /**
     * @param Prospect|null $contact
     */
    public function setContact(?Prospect $contact): void
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
