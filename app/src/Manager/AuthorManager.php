<?php

namespace App\Manager;

use \PDOManager;
use \PDO;
use \App\Entity\Author;

class AuthorManager extends BaseManager
{
    public function createNewAuthor($firstName, $lastName, $userName, $isAdmin)
    {
        $ID_Author = uniqid();

        $insert = "INSERT INTO Authors (`id`, `firstname`, `lastname`, `username`, `isAdmin`) VALUES (:id, :firstName, :lastName, :userName, :isAdmin)";
        $request = $this->bdd->prepare($insert);
        $request->execute(array(
            'id' => $ID_Author,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'username' => $userName,
            'isAdmin' => $isAdmin,
        ));
    }

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
        $getUser = 'SELECT * FROM Authors WHERE username = :username';
        $request = $this->bdd->prepare($getUser);
        $request->execute(array($username));
        $author = $request->fetch(PDO::FETCH_ASSOC);
        return new Author($author);
    }

    public function checkCredential(string $username, string $password)
    {
        //Function to check credential

        $user = $this->getUser($username);
        return $user;
    }
}