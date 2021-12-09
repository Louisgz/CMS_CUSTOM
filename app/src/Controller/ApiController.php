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

    // if (!$checkUser) {
    //   $this->HTTPResponse->setCacheHeader(300);
    //   return new ErrorController('User not connected', 'GET ');
    // }

    $postId = !empty($this->params['id']) ? $this->params['id'] : false;

    switch ($postId) {
      case false:
        $this->HTTPResponse->setCacheHeader(300);
        isset($this->params['number']) ? $number = abs(intval($this->params['number'])) : $number = null;
        return $this->renderJSON($postManager->getAllPosts($number, true));
      case true:
        $post = $postManager->getPostById($postId);
        if (!$post) return new ErrorController('No post', 'GET');
        $this->HTTPResponse->setCacheHeader(300);
        return $this->renderJSON($post);
    }
  }

  public function deletePosts()
  {
    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    // $checkUser = $authorManager->checkCredential($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

    // if (!$checkUser) {
    //   $this->HTTPResponse->setCacheHeader(300);
    //   return new ErrorController('User not connected', 'GET ');
    // }

    $postId = !empty($this->params['id']) ? $this->params['id'] : false;

    if ($postId) {
      var_dump($postId);
      $post = $postManager->deletePostById($postId);
      if (!$post) return new ErrorController('No post', 'GET');
      $this->HTTPResponse->setCacheHeader(300);
      return $this->renderJSON($postId);
    }
  }

  public function getComments()
  {
    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());

    // $checkUser = $authorManager->checkCredential($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

    // if (!$checkUser) {
    //   $this->HTTPResponse->setCacheHeader(300);
    //   return new ErrorController('User not connected', 'GET ');
    // }

    $commentId = !empty($this->params['id']) ? $this->params['id'] : false;
    $postId = !empty($this->params['mainId']) ? $this->params['mainId'] : false;

    switch ($commentId) {
      case false:
        switch ($postId) {
          case false:
            $this->HTTPResponse->setCacheHeader(300);
            isset($this->params['number']) ? $number = abs(intval($this->params['number'])) : $number = null;
            return $this->renderJSON($postManager->getAllComments($number, true));
          case true:
            $this->HTTPResponse->setCacheHeader(300);
            isset($this->params['number']) ? $number = abs(intval($this->params['number'])) : $number = null;
            return $this->renderJSON($postManager->getAllCommentFromPostId($postId, $number, true));
        }
      case true:
        $post = $postManager->getCommentById($commentId);
        if (!$post) return new ErrorController('No post', 'GET');
        $this->HTTPResponse->setCacheHeader(300);
        return $this->renderJSON($post);
    }
  }


  public function renderJSON($content)
  {
    $this->HTTPResponse->addHeader('Content-Type: application/json');
    echo json_encode($content, JSON_PRETTY_PRINT);
  }
}