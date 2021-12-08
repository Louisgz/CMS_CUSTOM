<?php

namespace App\Controller;

use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
use App\Fram\Utils\Flash;
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

    header("Location: /account");
    exit();
  }
  public function executeLogin()
  {
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $username = $_POST['username'];
    $password = $_POST['password'];

    //TODO Effectuer toutes les verifs pour les credentials

    $res = $authorManager->login($username, $password);

    if ($res['type'] == 'error') {
      Flash::setFlash('alert', $res['message']);
      header("Location: /login-page");
      exit();
    } else {
      header("Location: /account");
      exit();
    }

    // $_SESSION['user'] = $user;
  }

  public function executeUpdate()
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
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //TODO Effectuer toutes les verifs pour les credentials


    $user = $authorManager->updateAuthor($firstname, $lastname, $username, $password, $isAdmin, $id);
    $_SESSION['user'] = $user;

    header("Location: /account");
    exit();
  }

  public function executeLogout()
  {
    $_SESSION['user'] = null;
    header('Location: /');
    exit();
  }

  public function verifyValues(string $value)
  {
    return strlen($value) > 1;
  }
}