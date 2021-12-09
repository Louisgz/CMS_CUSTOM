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
        [
          'firstname' => $_GET['firstname'],
          'lastname' => $_GET['lastname'],
          'username' => $_GET['username'],
          'password' => $_GET['password'],
        ],
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
    $values = array(
      'firstname' => $_POST['firstname'],
      'lastname' => $_POST['lastname'],
      'username' => $_POST['username'],
      'password' => $_POST['password'] !== '' ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null,
    );
    $isValid = true;
    $message = '';

    if (!$values['firstname']) {
      $isValid = false;
      $message = "Merci de renseigner un firstname";
    }

    if (!$values['lastname']) {
      $isValid = false;
      !$message && $message = "Merci de renseigner un lastname";
    }

    if (!$values['username']) {
      $isValid = false;
      !$message && $message = "Merci de renseigner un username";
    }

    if (!$values['password']) {
      $isValid = false;
      !$message && $message = "Merci de renseigner un password";
    }

    if ($authorManager->checkAuthorExists($values['username'])) {
      $isValid = false;
      !$message && $message = "L'utilisateur existe déjà ! ";
    }

    if (!$isValid) {
      Flash::setFlash('alert', $message);
      $args = '?';
      $index = 1;
      foreach ($values as $key => $value) {
        $key !== 'password' && $args .= $key . '=' . $value . ($index !== count($values) - 1 ? '&' : '');
        $index++;
      };
      header("Location: /signup" . $args);
      exit();
    }

    $user = $authorManager->createNewAuthor($values['firstname'], $values['lastname'], $values['username'], $values['password']);
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