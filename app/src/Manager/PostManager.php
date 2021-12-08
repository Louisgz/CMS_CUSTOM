<?php

namespace App\Manager;

use App\Entity\Post;
use \PDO;
use \PDOManager;

class PostManager extends BaseManager
{


    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        // TODO -  Get all posts
        $bdd = PDOManager::getBdd();
        $getAllPost = 'SELECT * FROM posts';
        $request = $this->bdd->query($getAllPost);
        $request -> setFetchMode(PDO::FETCH_CLASS, 'Post');
        return $request->fetchAll();
    }

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
    public function createPost(Post $id, $date, $title, $content, $authorId)
    {
        // TODO - create post
        $bdd = PDOManager::getBdd();
        $createPost = 'INSERT INTO posts (id, date, title, content, authorId) VALUES (:id, :date, :title, :content, :authorId)';
        $request = $this->$bdd->prepare($createPost);
        $request -> execute(array(
            'id' => $id,
            'date' => $date,
            'title' => $title,
            'content' => $content,
            'authorId' => $authorId,
        ));
        return true;
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function updatePost(Post $post)
    {
        // TODO - getPostById($post->getId())
        $getPostId = $post->getId();
        $bdd = PDOManager::getBdd();
        $request = $bdd->prepare('UPDATE posts SET date = :date, title = :title, content = :content, authorId = :authorId WHERE id = "'. $getPostId .'"');
        $request->execute(array(
            'date' => $post->getDate(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'authorId' => $post->getAuthorId(),
        ));
        return true;
        

    }

    /**
     * @param int $id
     * @return bool
     */
    public function deletePostById(int $id): bool
    {
        // TODO - Delete post
        $bdd = PDOManager::getBdd();
        $deletePost = 'DELETE FROM posts WHERE id = ?';
        $request = $this->$bdd->prepareToDestroy($deletePost);
        $request->execute(array($id));
        return true;
    }
}