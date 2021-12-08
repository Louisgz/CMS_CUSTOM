<?php

namespace App\Controller;

use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;
use App\Manager\PostManager;

class ApiController extends BaseController
{



  public function executeCreatePost()
  {
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $title = $_POST['title'];
    $content = $_POST['content'];
    if (isset($_SESSION['user'])) $user = new Author($_SESSION['user']);

    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    $postManager->createPost($title, $content, $user->getId());


    // return $user;
  }
}