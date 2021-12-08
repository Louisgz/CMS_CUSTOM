<?php

namespace App\Controller;

use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;

class AuthController extends BaseController
{
  public function executeSignup()
  {
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //TODO Effectuer toutes les verifs pour les credentials

    $user = $authorManager->createNewAuthor($firstname, $lastname, $username, $password);
    $_SESSION['user'] = $user;
    var_dump($user->getIsAdmin());

    // header("Location: /account");
    // die();
  }

  public function verifyValues(string $value)
  {
    return strlen($value) > 1;
  }
}