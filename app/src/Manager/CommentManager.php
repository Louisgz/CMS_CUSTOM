<?php

namespace App\Manager;

use App\Entity\Comment;
use PDO;

class CommentManager extends BaseManager
{
    public function getAllComments($number = null, bool $returnArray = false)
    {
        $request = $this->bdd->prepare('SELECT * FROM `comments`' . ($number ? 'LIMIT :limite' : ''));
        $request->bindParam(':limite', $number, PDO::PARAM_INT);
        $request->execute();
        if ($returnArray) {
            $request->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $request->setFetchMode(PDO::FETCH_CLASS, 'Comment');
        }
        $posts = $request->fetchAll();

        return $posts;
    }

    public function getAllCommentFromPostId(string $id)
    {
        $getComment = 'SELECT * FROM comments WHERE postId = :id';
        $request = $this->bdd->prepare($getComment);
        $request->bindValue(':id', $id, PDO::PARAM_STR);
        $request->execute();
        $comments = $request->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function getCommentById(string $id)
    {
        $getComment = 'SELECT * FROM comments WHERE id = :id';
        $request = $this->bdd->prepare($getComment);
        $request->bindValue(':id', $id, PDO::PARAM_STR);
        $request->execute();
        $comments = $request->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function createComment(string $content, string $authorId, string $postId)
    {
        $setNewId = uniqid();
        $createComment = 'INSERT INTO comments (id, content, authorId, postId) VALUES (:id, :content, :authorId, :postId)';
        $request = $this->bdd->prepare($createComment);
        $request->bindParam(':content', $content);
        $request->bindParam(':author_id', $authorId);
        $request->execute(array(
            'id' => $setNewId,
            'content' => $content,
            'authorId' => $authorId,
            'postId' => $postId
        ));
    }

    public function deleteComment(string $id)
    {
        $deleteComment = 'DELETE FROM comments WHERE id = :id';
        $request = $this->bdd->prepare($deleteComment);
        $request->bindParam(':id', $id);
        $request->execute();
        return true;
    }

    public function deleteCommentByPostId(string $postId)
    {
        $deleteComment = 'DELETE FROM comments WHERE postId = :postId';
        $request = $this->bdd->prepare($deleteComment);
        $request->bindParam(':postId', $postId);
        $request->execute();
        return true;
    }

    public function editComment(string $id, string $content, string $authorId, string $postId)
    {
        $editComment = 'UPDATE comments SET content = :content, authorId = :authorId, postId = :postId WHERE id = :id';
        $request = $this->bdd->prepare($editComment);
        $comment = $request->execute(array(
            'content' => $content,
            'authorId' => $authorId,
            'postId' => $postId,
            'id' => $id,
        ));
        return $comment;
    }
}