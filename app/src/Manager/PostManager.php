<?php

namespace App\Manager;

use App\Entity\Post;
use \PDO;
use \PDOManager;

class PostManager extends BaseManager
{
    /**
     * @return array
     */
    public function getAllPosts(): array
    {
        $getallPosts = 'SELECT * FROM Posts';
        $request = $this->bdd->prepare($getallPosts);
        $request->execute(array());
        $posts = $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');

        return $posts;
    }

    /**
     * @return Post
     */
    public function getPostById(int $id): Post
    {
        $getPost = 'SELECT * FROM Posts WHERE id = :id';
        $request = $this->bdd->prepare($getPost);
        $request->execute(array($id));
        $post = $request->fetch(PDO::FETCH_ASSOC);
        return new Post($post);
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function createPost(Post $post)
    {
        // TODO - create post
        return true;
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function updatePost(Post $post)
    {
        // TODO - getPostById($post->getId())
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deletePostById(int $id)
    {
        // TODO - Delete post
    }
}