<?php

namespace App\Model;

use Doctrine\ORM\Mapping\Column;

abstract class AbstractContact implements AbstractContactInterface
{
    #[Column(type: "string", nullable: true)]
    protected ?string $firstname;

    #[Column(type: "string", nullable: true)]
    protected ?string $lastname;

    #[Column(type: "string", nullable: true)]
    protected ?string $email;

    #[Column(type: "string", nullable: true)]
    protected ?string $phone;

    #[Column(type: "boolean", nullable: false, options: ['default' => true])]
    protected bool $aLive = true;

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function isALive(): bool
    {
        return $this->aLive;
    }

    public function setALive($aLive): void
    {
        $this->aLive = $aLive;
    }
}
