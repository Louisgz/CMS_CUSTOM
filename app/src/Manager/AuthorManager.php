<?php

namespace App\Manager;

use \PDOManager;
use \PDO;
use \App\Entity\Author;

class AuthorManager extends BaseManager
{
    public function createNewAuthor($firstName, $lastName, $userName, $password)
    {
        $ID_Author = uniqid();
        $insert = "INSERT INTO authors (`id`, `firstname`, `lastname`, `username`, `password`, `isAdmin`) VALUES (:id, :firstname, :lastname, :username, :pw, :isAdmin)";
        $request = $this->bdd->prepare($insert);
        $args = array(
            'id' => $ID_Author,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'username' => $userName,
            'pw' => $password,
            'isAdmin' => 0,
        );
        $request->execute($args);
        return new Author($args);
    }

    public function getAuthorByUsername($username)
    {
        $select = "SELECT * FROM authors WHERE `user` = :username";
        $request = $this->bdd->prepare($select);
        $request->setFetchMode(PDO::FETCH_CLASS, 'Author');
        $author = $request->fetchAll();
        return $author;
    }


    /**

     * @return Author[]
     */
    public function getAllAuthors()
    {
        $select = "SELECT * FROM authors";
        $request = $this->bdd->prepare($select);
        $request->fetchAll(PDO::FETCH_CLASS, 'Author');
        return $request->fetchAll();
    }

    /**
     * @param id
     * @return Author
     */
    public function getSingleAuthor($id)
    {
        $getAuthor = 'SELECT * FROM authors WHERE id = ?';
        $request = $this->bdd->prepare($getAuthor);
        $request->execute(array($id));
        $author = $request->fetch(PDO::FETCH_ASSOC);
        return new Author($author);
    }

    public function getUser($username)
    {
        $getUser = 'SELECT * FROM Authors WHERE username = ?';
        $request = $this->bdd->prepare($getUser);
        $request->execute(array($username));
        $author = $request->fetch(PDO::FETCH_ASSOC);
        return new Author($author);
    }

    /**
     * @param Author
     * @return Boolean
     */
    public function updateAuthorNames($username, $firstname, $lastname, $id)
    {
        $update = "UPDATE authors SET username = :username, firstname = :firstname, lastname = :lastname WHERE id = :id";
        $request = $this->bdd->prepare($update);
        $request->bindparam(':username', $username, PDO::PARAM_STR);
        $request->bindparam(':firstname', $firstname, PDO::PARAM_STR);
        $request->bindparam(':lastname', $lastname, PDO::PARAM_STR);
        $request->bindparam(':id', $id, PDO::PARAM_STR);
        $request->execute(array(
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'id' => $id,
        ));
        return true;
    }

    /**
     * @param id
     * @return Boolean
     */
    public function deleteAuthor($id)
    {
        $delete = "DELETE FROM authors WHERE id = :id";
        $request = $this->bdd->prepare($delete);
        $request->bindParam(':id', $id, PDO::PARAM_STR);
        $request->execute(array(
            'id' => $id,
        ));
        return true;
    }

    public function checkCredential(string $username, string $password)
    {
        //Function to check credential

        $user = $this->getUser($username);
        return $user;
    }
}