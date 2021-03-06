<?php

namespace App\Manager;

use \PDOManager;
use \PDO;
use \App\Entity\Author;

class AuthorManager extends BaseManager
{
    public function createNewAuthor(string $firstname, string $lastname, string $username, string $password): array
    {
        $ID_Author = uniqid();
        $insert = "INSERT INTO authors (`id`, `firstname`, `lastname`, `username`, `password`, `isAdmin`) VALUES (:id, :firstname, :lastname, :username, :pw, :isAdmin)";
        $request = $this->bdd->prepare($insert);
        $args = array(
            'id' => $ID_Author,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'pw' => $password,
            'isAdmin' => 0,
        );
        $request->execute($args);
        return array(
            'id' => $ID_Author,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $password,
            'isAdmin' => 0,
        );
    }

    public function login(string $username, string $password)
    {
        $userInfos = $this->getUser($username);
        if (!$userInfos) return [
            'type' => 'error',
            'message' => 'Login incorrect',
            'username' =>  $username,
        ];

        $user = new Author($userInfos);

        if (!password_verify($password, $user->getPassword())) return [
            'type' => 'error',
            'message' => 'Mot de passe incorrect',
            'username' =>  $username,
        ];

        $_SESSION['user'] = $userInfos;
        return [
            'type' => 'success',
        ];
    }

    public function updateAuthor($firstname, $lastname, $username, $password, $isAdmin, $id)
    {
        $insert = "UPDATE `authors` SET `firstname` = :firstname, `lastname` = :lastname, `isAdmin` = :isAdmin" . ($password ? ", `password` = :pw" : '') . " WHERE id = :id";
        $request = $this->bdd->prepare($insert);
        $args = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'isAdmin' => $isAdmin,
            'id' => $id,
        );
        $password && $args['pw'] = $password;
        $request->execute($args);
        return array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'password' => $password || $_SESSION['user']['password'],
            'isAdmin' => $isAdmin,
            'id' => $id,
            'username' => $username,
        );
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
        $request->execute();
        $request->setFetchMode(PDO::FETCH_CLASS, 'Author');
        $users = $request->fetchAll();
        return $users;
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
        return $author;
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
        $deleteAuthor = "DELETE FROM authors WHERE id = :id";
        $request = $this->bdd->prepare($deleteAuthor);
        $request->bindParam(':id', $id, PDO::PARAM_STR);
        $request->execute();
        return true;
    }

    public function checkCredential(string $username, string $password): array
    {
        $userInfos = $this->getUser($username);

        if (!$userInfos) return [
            'type' => 'error',
            'message' => 'Login incorrect',
        ];

        $user = new Author($userInfos);

        if (!password_verify($password, $user->getPassword())) return [
            'type' => 'error',
            'message' => 'Mot de passe incorrect',
        ];

        return [
            'type' => 'success',
        ];
    }


    public function checkAuthorExists($username)
    {
        return $this->getUser($username) ? true : false;
    }
}