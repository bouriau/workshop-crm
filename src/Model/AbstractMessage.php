<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\Prospect;
use App\Model\AbstractContactInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping\OneToMany;

abstract class AbstractMessage
{
    #[Column(type: "string", nullable: false)]
    protected string $subject;

    #[Column(type: "text", nullable: false)]
    protected string $message;

    /**
     * One Message has Many Responses.
     */
    #[OneToMany(mappedBy: 'parent', targetEntity: AbstractMessage::class)]
    private Collection $responses;

    /** Many Responses have One Parent Message. */
    #[ManyToOne(targetEntity: AbstractMessage::class, inversedBy: 'children')]
    #[JoinColumn(name: 'parent_id', referencedColumnName: 'id')]
    private AbstractMessage|null $parent = null;

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
