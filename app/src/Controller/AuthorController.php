<?php

namespace App\Controller;

use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;
use App\Entity\Author;

class AuthorController extends BaseController
{

  public function executeLoginPage()
  {
    $this->render(
      'login.php',
      [
        'username' => $this->params['username']
      ],
      'Login page'
    );
  }

  public function executeSignupPage()
  {
    $this->render(
      'signup.php',
      [],
      'signup page'
    );
  }

  public function executeAccount()
  {
    if ($_SESSION['user']) {
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
}