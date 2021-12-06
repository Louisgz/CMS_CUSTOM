<?php
    namespace App\Entity;

    class Post{
        private int $id;
        private \DateTime $date;
        private string $title;
        private string $content;
        private int $authorId

        /**
         * @return string
         */
        public function getId(): string
        {
            return $this -> id;
        }

        /**
         * @return string
         */
        public function setId(): string
        {
            $this -> id = $id;
        }

        /**
         * @return string
         */
        public function getdate(): string
        {
            return $this -> date;
        }

        /**
         * @return string
         */
        public function setDate(): string
        {
            $this -> id = $date;
        }

         /**
         *  @return string
         */
        public function getTitle(): string
        {
            return $this -> title; 
        }

        /**
         * @return string
         */
        public function setTitle(string $title): void
        {
            $this -> title = $title;
        }

        /**
         * @return string
         */
        public function getContent(): string
        {
            return $this -> content;
        }

        /**
         * @return string
         */
        public function setContent(): string
        {
            $this -> id = $content;
        }

        /**
         * @return string
         */
        public function getAuthorId(): string
        {
            return $this -> authorId;
        }
        
        /**
         * @return string
         */
        public function setAuthorId(): string
        {
            $this -> id = $authorId;
        }
    }