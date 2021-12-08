<?php

namespace App\Entity;

use App\Manager\AuthorManager;

class Author extends BaseEntity
{
    private string $id;
    private string $firstname;
    private string $lastname;
    private string $username;
    private bool $isAdmin;
    private string $password;


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
    public function getFirstame(): string
    {
        return $this->firstname;
    }

    /**
     * @return void
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return void
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return void
     */

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return bool
     */
    public function getIsAdmin(): int
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

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}