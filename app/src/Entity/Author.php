<?php

namespace App\Entity;

class Author
{
    private string $id;
    private string $name;
    private string $surname;
    private bool $isAdmin;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return void
     */

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return bool
     */
    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @return void
     */
    public function setBooks(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }
}