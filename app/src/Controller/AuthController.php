<?php

namespace App\Controller;

use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
use App\Fram\Utils\Flash;
use App\Manager\AuthorManager;

class AuthController extends BaseController
{
  public function verifyValues(string $value)
  {
    return strlen($value) > 1;
  }
}