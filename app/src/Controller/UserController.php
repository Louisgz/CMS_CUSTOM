<?php

namespace App\Controller;

class UserController extends BaseController
{

  public function executeLogin()
  {
    $this->render(
      'login.php',
      [],
      'Login page'
    );
  }

  public function executeSignup()
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