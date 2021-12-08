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
        if ($userInfos) {
            $user = new Author($userInfos);
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['user'] = $userInfos;
                return [
                    'type' => 'success',
                ];
            } else {
                return [
                    'type' => 'error',
                    'message' => 'Mot de passe incorrect',
                ];
            }
        } else {
            return [
                'type' => 'error',
                'message' => 'Login incorrect',
            ];
        }
    }

    public function updateAuthor($firstname, $lastname, $username, $password, $idAdmin, $id)
    {
        $insert = "UPDATE `authors` SET `firstname` = :firstname, `lastname` = :lastname, `isAdmin` = :isAdmin WHERE id = :id";
        $request = $this->bdd->prepare($insert);
        $args = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'isAdmin' => $idAdmin,
            'id' => $id,
        );
        $request->execute($args);
        return array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'password' => $password,
            'isAdmin' => $idAdmin,
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
        $delete = "DELETE FROM authors WHERE id = :id";
        $request = $this->bdd->prepare($delete);
        $request->bindParam(':id', $id, PDO::PARAM_STR);
        $request->execute(array(
            'id' => $id,
        ));
        return true;
    }
}