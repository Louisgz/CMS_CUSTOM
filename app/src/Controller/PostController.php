<?php

namespace App\Controller;

// use App\Entity\Author;
use App\Fram\Factories\PDOFactory;
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
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());

        $this->render(
            'editPost.php',
            [
                'posts' => $postManager->getPostById($_GET['id']),
                'comments' => $commentManager->getAllComments()
            ],
            'edit a post'
        );
    }
}