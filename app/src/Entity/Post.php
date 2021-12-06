<?php

namespace App\Entity;

class Post
{
    private string $id;
    private \DateTime $date;
    private string $title;
    private string $content;
    private string $authorId;

    /**
     * @return string
     */
    public function getId()
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
    public function getdate(): \DateTime
    {
        return $this->date;
        return $this->date;
    }

    /**
     * @return void
     */
    public function setDate(\DateTime $date): void
    {
        $this->id = $date;
    }

    /**
     *  @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->id = $content;
    }

    /**
     * @return string
     */
    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    /**
     * @return void
     */
    public function setAuthorId(string $authorId): void
    {
        $this->id = $authorId;
    }
}