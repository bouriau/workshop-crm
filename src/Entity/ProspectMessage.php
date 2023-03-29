<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\AbstractMessage;
use App\Repository\ProspectMessageRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Table]
#[Entity(repositoryClass: ProspectMessageRepository::class)]
class ProspectMessage extends AbstractMessage
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: Prospect::class, inversedBy: 'features')]
    #[JoinColumn(name: 'prospect_id', referencedColumnName: 'id')]
    private Prospect|null $contact = null;

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
}
