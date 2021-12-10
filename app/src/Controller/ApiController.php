<?php

namespace App\Controller;

use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;
use App\Manager\CommentManager;
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

    $postId = !empty($this->params['postId']) ? $this->params['postId'] : false;

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

  public function postPosts()
  {
    //TODO Fonction pour ajouter un post par API
  }

  public function putPosts()
  {
    //TODO Fonction pour updater un post par API
  }


  public function deletePosts()
  {
    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    // $checkUser = $authorManager->checkCredential($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

    // if (!$checkUser) {
    //   $this->HTTPResponse->setCacheHeader(300);
    //   return new ErrorController('User not connected', 'GET ');
    // }

    $postId = !empty($this->params['postId']) ? $this->params['postId'] : false;

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
    $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());

    // $checkUser = $authorManager->checkCredential($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

    // if (!$checkUser) {
    //   $this->HTTPResponse->setCacheHeader(300);
    //   return new ErrorController('User not connected', 'GET ');
    // }

    $commentId = !empty($this->params['commentId']) ? $this->params['commentId'] : false;
    $postId = !empty($this->params['postId']) ? $this->params['postId'] : false;

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
        $post = $commentManager->getCommentById($commentId);
        if (!$post) return new ErrorController('No post', 'GET');
        $this->HTTPResponse->setCacheHeader(300);
        return $this->renderJSON($post);
    }
  }

  public function postComments()
  {
    $postManager = new PostManager(PDOFactory::getMysqlConnection());
    $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
    $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());

    // $checkUser = $authorManager->checkCredential($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

    // if (!$checkUser) {
    //   $this->HTTPResponse->setCacheHeader(300);
    //   return new ErrorController('User not connected', 'GET ');
    // }

    $authorId = !empty($this->params['authorId']) ? $this->params['authorId'] : false;
    $postId = !empty($this->params['postId']) ? $this->params['postId'] : false;
    $content = file_get_contents('php://input');

    isset($this->params['number']) ? $number = abs(intval($this->params['number'])) : $number = null;
    $this->renderJSON($commentManager->createComment($content, $authorId, $postId));
  }

  public function putComment()
  {
    //TODO Fonction pour updater un commentaire par API
  }

  public function deleteComment()
  {
    //TODO Fonction pour delete un commentaire par API
  }

  public function renderJSON($content)
  {
    $this->HTTPResponse->addHeader('Content-Type: application/json');
    echo json_encode($content, JSON_PRETTY_PRINT);
  }
}