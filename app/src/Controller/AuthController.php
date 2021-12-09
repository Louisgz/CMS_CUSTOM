<?php

namespace App\Controller;

use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
use App\Fram\Utils\Flash;
use App\Manager\AuthorManager;

class AuthController extends BaseController
{
  public function postUpdate()
  {
    $user = new Author($_SESSION['user']);
    $id = $user->getId();
    $username = $user->getUsername();
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $isAdmin = $_POST['isAdmin'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    if (isset($_POST['isAdmin']) && $_POST['isAdmin'] == '1') {
      $isAdmin = 1;
    } else {
      $isAdmin = 0;
    }
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    //TODO Effectuer toutes les verifs pour les credentials


    $user = $authorManager->updateAuthor($firstname, $lastname, $username, $password, $isAdmin, $id);
    $_SESSION['user'] = $user;

    header("Location: /account");
    exit();
  }

  public function verifyValues(string $value)
  {
    return strlen($value) > 1;
  }
}