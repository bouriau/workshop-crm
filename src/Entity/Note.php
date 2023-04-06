<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\NoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: NoteRepository::class)]
class Note
{
    use TimestampableTrait;

    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: NoteType::class, inversedBy: 'notes')]
    #[JoinColumn(name: 'note_type_id', referencedColumnName: 'id')]
    private NoteType|null $type = null;

    #[ManyToOne(targetEntity: Action::class, inversedBy: 'notes')]
    #[JoinColumn(name: 'action_id', referencedColumnName: 'id')]
    private Action|null $action = null;

    #[Column(type: "text", nullable: false)]
    protected ?string $message = null;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
        $this->updatedTimestamps();
    }

    public function __toString(): string
    {
        return substr($this->message, 0, 10);
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
     * @return NoteType|null
     */
    public function getType(): ?NoteType
    {
        return $this->type;
    }

    /**
     * @param NoteType|null $type
     */
    public function setType(?NoteType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Action|null
     */
    public function getAction(): ?Action
    {
        return $this->action;
    }

    /**
     * @param Action|null $action
     */
    public function setAction(?Action $action): void
    {
        $this->action = $action;
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


}
