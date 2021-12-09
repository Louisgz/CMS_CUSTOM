<?php

namespace App\Controller;

use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;
use App\Manager\PostManager;

class ApiController extends BaseController
{
  public function getPosts()
  {
    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());

    // $checkUser = $authorManager->checkCredential($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
    $postId = !empty($this->params['id']) ? $this->parmas['id'] : false;
    // $post = $postManager->postExists($postId) ? $postManager->getPostById($postId) : false;

    switch ($postId) {
      case false:
        $this->HTTPResponse->setCacheHeader(300);
        isset($this->params['number']) ? $number = abs(intval($this->params['number'])) : $number = null;
        return $this->renderJSON($postManager->getAllPosts($number, true));
    }
  }

  public function postCreatePost()
  {
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $title = $_POST['title'];
    $content = $_POST['content'];
    if (isset($_SESSION['user'])) $user = new Author($_SESSION['user']);

    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    $postManager->createPost($title, $content, $user->getId());

    header('Location: /');
    exit();
    // return $user;
  }

  public function postCreateComment()
  {
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
    $content = $_POST['comment'];
    $postId = $_GET['id'];
  //   echo("content: ".  $content. " postid :".  $postId 
  // ) ;
    if (isset($_SESSION['user'])) $user = new Author($_SESSION['user']);

    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    $postManager->createComment($postId, $user->getId(), $content);
    // header('Location: /');
    exit();
  }

  public function renderJSON($content)
  {
    $this->HTTPResponse->addHeader('Content-Type: application/json');
    echo json_encode($content, JSON_PRETTY_PRINT);
  }
}