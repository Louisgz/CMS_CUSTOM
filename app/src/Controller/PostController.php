<?php

namespace App\Controller;

// use App\Entity\Author;

use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
use App\Manager\AuthorManager;
// use App\Fram\Utils\Flash;
use App\Manager\PostManager;
use App\Manager\CommentManager;

class PostController extends BaseController
{
    /**
     * Show all Posts
     */
    public function getIndex()
    {
        $postManager = new PostManager(PDOFactory::getMysqlConnection());
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
        $posts = $postManager->getAllPosts();
        $comments = $commentManager->getAllComments();


        $this->render(
            'home.php',
            [
                'posts' => $posts,
                'comments' => $comments
            ],
            'Home page'
        );
    }


    public function getAuthor()
    {
        $this->render(
            'author.php',
            [],
            'Auteur'
        );
    }

    public function getCreatePost()
    {
        $this->render(
            'createPost.php',
            [],
            'Create a post'
        );
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

    public function getShowPost()
    {
        $postManager = new PostManager(PDOFactory::getMysqlConnection());
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());

        $this->render(
            'post.php',
            [
                'posts' => $postManager->getPostById($_GET['id']),
                'comments' => $commentManager->getAllComments()
            ],
            'Post'
        );
    }

    public function getEditPost()
    {
        $postManager = new PostManager(PDOFactory::getMysqlConnection());

        $this->render(
            'editPost.php',
            [
                'posts' => $postManager->getPostById($_GET['id']),
            ],
            'edit a post'
        );
    }
    public function postDeletePost()
    {
        $postManager = new PostManager(PDOFactory::getMysqlConnection());
        $postId = !empty($this->params['id']) ? $this->params['id'] : false;

        if ($postId) {
            $post = $postManager->deletePostById($postId);
        }
        header('Location: /');
        exit();
    }
    public function postCreateComment()
    {
        $authorManager = new AuthorManager(PDOFactory::getMysqlConnection());
        $content = $_POST['comment'];
        $postId = $_GET['id'];
        if (isset($_SESSION['user'])) $user = new Author($_SESSION['user']);

        $postManager = new PostManager(PDOFactory::getMysqlConnection());
        $postManager->createComment($postId, $user->getId(), $content);
        exit();
    }

    public function postDeleteComment()
    {
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
        $commentId = !empty($this->params['id']) ? $this->params['id'] : false;
        $postId = !empty($this->params['postId']) ? $this->params['postId'] : false;

        if ($commentId) {
            $post = $commentManager->deleteComment($commentId);
        }
        header('Location: /post?id=' . $postId);
        exit();
    }
}