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
    public function getPostById(string $id)
    {
        $getPost = 'SELECT * FROM posts WHERE id = :id';
        $request = $this->bdd->prepare($getPost);
        $request->execute([
            'id' => $id
        ]);
        $post = $request->fetchAll();
        if ($post) return $post;
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function createPost($title, $content, $authorId)
    {
        $newId = uniqid();
        $insert = 'INSERT INTO posts (`id`, `title`, `content`, `authorId`) VALUES (:id, :title, :content, :authorId)';
        $request = $this->bdd->prepare($insert);
        $request->execute(array(
            'id' => $newId,
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
        $updatePost = 'UPDATE posts SET date = :date, title = :title, content = :content, authorId = :authorId WHERE id = :id';
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
    public function deletePostById(string $id)
    {
        // TODO - Delete post
        $deletePost = 'DELETE FROM posts WHERE id = :id';
        $request = $this->bdd->prepare($deletePost);
        $request->bindValue(':id', $id, PDO::PARAM_STR);
        $request->execute();
        return true;
    }

    public function getAllCommentFormId(string $id)
    {
        $getComment = 'SELECT * FROM comments WHERE postId = :id';
        $request = $this->bdd->prepare($getComment);
        $request->bindValue(':id', $id, PDO::PARAM_STR);
        $request->execute();
        $comments = $request->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function createComment($postId, $authorId, $content)
    {
        $newId = uniqid();
        $insert = 'INSERT INTO comments (`id`, `postId`, `authorId`, `content`) VALUES (:id, :postId, :authorId, :content)';
        $request = $this->bdd->prepare($insert);
        $request->bindValue(':postId', $postId, PDO::PARAM_INT);
        $request->bindValue(':authorId', $authorId, PDO::PARAM_INT);
        $request->bindValue(':content', $content, PDO::PARAM_INT);
        $request->execute(array(
            'id' => $newId,
            'postId' => $postId,
            'authorId' => $authorId,
            'content' => $content
        ));
        return true;
    }
}