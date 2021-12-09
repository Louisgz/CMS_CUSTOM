<?php

namespace App\Controller;

use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;
use App\Entity\Author;
use App\Fram\Utils\Flash;

class AuthorController extends BaseController
{

  public function getLogin()
  {
    $this->render(
      'login.php',
      [
        'username' => $this->params['username']
      ],
      'Login page'
    );
  }

  public function postLogin()
  {
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $username = $_POST['username'];
    $password = $_POST['password'];

    //TODO Effectuer toutes les verifs pour les credentials

    $res = $authorManager->login($username, $password);

    if ($res['type'] == 'error') {
      Flash::setFlash('alert', $res['message']);
      header("Location: /login?username=" . $res['username']);
      exit();
    } else {
      header("Location: /account");
      exit();
    }
  }

  public function getSignup()
  {
    if (!isset($_SESSION['user'])) {
      $this->render(
        'signup.php',
        [],
        'signup page'
      );
    } else {
      header('Location: /');
    }
  }

  public function getAccount()
  {
    if (isset($_SESSION['user'])) {
      $user = new Author($_SESSION['user']);
      $username = $user->getUsername();
      $firstname = $user->getFirstname();
      $lastname = $user->getLastname();
      $isAdmin = $user->getIsAdmin();


      $this->render(
        'account.php',
        [
          'username' => $username,
          'firstname' => $firstname,
          'lastname' => $lastname,
          'isAdmin' => $isAdmin
        ],
        'Account page'
      );
    } else {
      header('Location: /');
      exit();
    }
  }

  public function getListUsers()
  {
    if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
      $user = new Author($_SESSION['user']);
      $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());

      $this->render(
        'list-users.php',
        [
          'users' => $authorManager->getAllAuthors(),
          'userId' => $user->getId(),
        ],
        'List users'
      );
    } else {
      header('Location: /');
      exit();
    }
  }

  public function postSignup()
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

  public function postLogout()
  {
    $_SESSION['user'] = null;
    header('Location: /');
    exit();
  }
}