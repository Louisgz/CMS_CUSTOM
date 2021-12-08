<?php

namespace App\Manager;

use App\Entity\Post;
use PDO;


class PostManager extends BaseManager
{
    /**
     * @return array
     */
    public function getAllPosts()
    {
        $request = $this->bdd->query('SELECT * FROM posts');
        $request->setFetchMode(PDO::FETCH_CLASS, 'Post');
        $posts = $request->fetchAll();

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
        $insert = 'INSERT INTO Posts(id, date, title, content, authorId) VALUES(:id, :date, :title, :content, :authorId)';
        $request = $this->bdd->prepare($insert);
        $request->execute(array(
            'id' => $post->getId(),
            'date' => $post->getDate(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'author' => $post->getauthorId(),
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
        $updatePost = 'UPDATE Posts SET date = :date, title = :title, content = :content, authorId = :authorId WHERE id = :id';
        $request = $this->bdd->prepare($updatePost);
        $request->execute(array(
            'id' => $post->getId(),
            'date' => $post->getDate(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'author' => $post->getauthorId(),
        ));
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deletePostById(int $id)
    {
        // TODO - Delete post
        $deletePost = 'DELETE FROM Posts WHERE id = :id';
        $request = $this->bdd->prepare($deletePost);
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute();
        return true;
    }
}