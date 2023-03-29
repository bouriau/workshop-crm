<?php

namespace App\Model;

interface AbstractContactInterface
{
    /**
     * @return string|null
     */
    public function getFirstname(): ?string;

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void;

    /**
     * @return string|null
     */
    public function getLastname(): ?string;

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void;

    /**
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void;

    /**
     * @return int|null
     */
    public function getPhone(): ?int;

    /**
     * @param int|null $phone
     */
    public function setPhone(?int $phone): void;
}
