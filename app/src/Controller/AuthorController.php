<?php

namespace App\Controller;

use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;

class AuthorController extends BaseController
{

  public function executeLoginPage()
  {
    $this->render(
      'login.php',
      [],
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
    $this->render(
      'account.php',
      [
        'username' => 'louisgz',
        'firstname' => 'Louis',
        'lastname' => 'Pillon',
        'isAdmin' => true
      ],
      'Account page'
    );
  }
}