<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\MessageInterface;
use Doctrine\Common\Collections\Collection;

interface ProspectInterface
{
    public function getMessages(): Collection;

    public function addMessage(MessageInterface $message): void;

    public function removeMessage(MessageInterface $message): void;

    public function hasMessage(MessageInterface $message): bool;

}
