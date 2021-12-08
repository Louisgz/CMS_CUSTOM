<?php

namespace App\Entity;

class Comment extends BaseEntity
{
    private string $id;
    private \DateTime $date;
    private string $content;
    private string $authorId;
    private string $postId;
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
    }

    /**
     * @return void
     */
    public function setDate(\DateTime $date): void
    {
        $this->id = $date;
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
    /**
     * @return string
     */
    public function getPostId(): string
    {
        return $this->postId;
    }

    /**
     * @return void
     */
    public function setPostId(string $postId): void
    {
        $this->id = $postId;
    }
}