<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\MappedSuperclass;
use JetBrains\PhpStorm\Deprecated;

#[MappedSuperclass]
#[Deprecated]
abstract class AbstractMessage implements MessageInterface
{
    #[Column(type: "string", nullable: false)]
    protected ?string $subject = null;

    #[Column(type: "text", nullable: false)]
    protected ?string $message = null;

//    public function __construct(string $subject, string $message)
//    {
//        $this->subject = $subject;
//        $this->message = $message;
//    }


    public function __toString(): string
    {
        return $this->subject;
    }

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
