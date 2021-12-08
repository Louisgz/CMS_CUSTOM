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
    public function executeIndex()
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


    public function executeAuthor()
    {
        $this->render(
            'author.php',
            [],
            'Auteur'
        );
    }

    public function executeCreatePost()
    {
        $this->render(
            'createPost.php',
            [],
            'Create a post'
        );
    }
    public function executeShowPost()
    {
        $postManager = new PostManager(PDOFactory::getMysqlConnection());
        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
        $this->render(
            'post.php',
            [
                'post' => $postManager->getPostById($_GET['id']),
                'comments' => $commentManager->getAllComments()
            ],
            'Post'
        );
    }
}
