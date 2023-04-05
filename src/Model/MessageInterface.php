<?php

namespace App\Model;

use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Deprecated;

#[Deprecated]
interface MessageInterface
{
    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void;

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @param string $message
     */
    public function setMessage(string $message): void;

    public function getResponses(): Collection;

    public function addResponse(MessageInterface $response): void;

    public function removeResponse(MessageInterface $response): void;

    public function hasResponse(MessageInterface $response): bool;
}
