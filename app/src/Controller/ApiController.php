<?php

namespace App\Controller;

use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;


class ApiController extends BaseController
{

  public function executeCreatePost()
  {
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $user = $authorManager->checkCredential($_POST['username'], $_POST['passord']);
    return $user;
  }
}