<?php

namespace App\Manager;

use App\Entity\Comment;
use PDO;

class CommentManager extends BaseManager
{
    /**
     * @return array
     */
    public function getAllComments()
    {
        $request = $this->bdd->query('SELECT * FROM comments');
        $request->setFetchMode(PDO::FETCH_CLASS, 'Comment');
        $comments = $request->fetchAll();

        return $comments;
    }
     /**
     * @return Comment
     */
    public function getCommentById(string $id)
    {
        $getComment = 'SELECT * FROM comments WHERE id = :id';
        $request = $this->bdd->prepare($getComment);
        $request->execute(array($id));
        $comment = $request->fetch(PDO::FETCH_ASSOC);
        return new Comment($comment);
    }
    public function createComment($content, $authorId, $postId)
    {
        $setNewId = uniqid();
        $createComment = 'INSERT INTO comments (id, content, authorId, postId) VALUES (:id, :content, :authorId, :postId)';
        $request = $this->bdd->prepare($createComment);
        $request->bindParam(':content', $content);
        $request->bindParam(':author_id', $authorId);
        $request->execute(array(
            'id' => $setNewId,
            'date' => time(),
            'content' => $content,
            'authorId' => $authorId,
            'postId' => $postId()
        ));
    }

    public function deleteComment(string $id){
        $deleteComment = 'DELETE FROM comments WHERE id = :id';
        $request = $this->bdd->prepare($deleteComment);
        $request->bindParam(':id', $id);
        $request->execute();
        return true;
    }

    public function editComment(string $id, string $content, string $authorId,  string $postId){
        $editComment = 'UPDATE comments SET content = :content, author = :author, postId = :postId WHERE id = :id';
        $request = $this->bdd->prepare($editComment);
        $request->bindParam(':id', $id);
        $request->bindParam(':content', $content);
        $request->bindParam(':author', $authorId);
        $request->bindParam(':postId', $postId);
        $request->execute();
        return true;
    }

}