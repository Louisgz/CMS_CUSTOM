<?php

namespace App\Manager;
use \PDOManager;
use \PDO;
use \App\Entity\Author;


class AuthorManager extends BaseManager
{
    public function createNewAuthor($firstName, $lastName, $userName, $isAdmin )
    {
        $ID_Author = uniqid();
        $bdd = PDOManager::getBdd();

        $insert = "INSERT INTO Authors (`id`, `firstname`, `lastname`, `username`, `isadmin`) VALUES (:id, :firstName, :lastName, :userName, :isAdmin)";
        $request = $bdd->prepare($insert);
        $request->execute(array(
            'id' => $ID_Author,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'username' => $userName,
            'isadmin' => $isAdmin,
        ));
    }

    public function getSingleAuthor($id)
    {
        $bdd = PDOManager::getBdd();
        $getAuthor = 'SELECT * FROM Authors WHERE id = :id';
        $request = $bdd->prepare($getAuthor);
        $request->execute(array($id));
        $author = $request->fetch(PDO::FETCH_ASSOC);
        return new Author($author);
    }

}