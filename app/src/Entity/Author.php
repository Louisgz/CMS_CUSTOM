<?php
    namespace App\Entity;
    
    class Author
    {
        private $id;
        private $name;
        private $surname;
        private $books;

         /**
         * @return string
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return string
         */
        public function setId($id)
        {
            $this->id = $id;
        }
        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @return string
         */
        public function setName($name)
        {
            $this->name = $name;
        }
        /**
         * @return string
         */
        public function getSurname()
        {
            return $this->surname;
        }
         
        /**
         * @return string
         */

        public function setSurname($surname)
        {
            $this->surname = $surname;
        }

        /**
         * @return string
         */
        public function getBooks()
        {
            return $this->books;
        }

        /**
         * @return string
         */
        public function setBooks($books)
        {
            $this->books = $books;
        }

    }