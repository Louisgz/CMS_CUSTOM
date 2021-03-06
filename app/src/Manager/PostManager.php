<?php

namespace App\Manager;

use App\Entity\Post;
use App\Fram\Factories\PDOFactory;
use PDO;


class PostManager extends BaseManager
{
    /**
     * @return array
     */
    public function getAllPosts($number = null, bool $returnArray = false)
    {
        $request = $this->bdd->prepare('SELECT * FROM `posts`' . ($number ? 'LIMIT :limite' : ''));
        $request->bindParam(':limite', $number, PDO::PARAM_INT);
        $request->execute();
        if ($returnArray) {
            $request->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $request->setFetchMode(PDO::FETCH_CLASS, 'Post');
        }
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
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute(array(
            'id' => $id
        ));
        $post = $request->fetchAll();
        return $post ? $post : null;
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function createPost($title, $content, $authorId, $url)
    {
        $newId = uniqid();
        $insert = 'INSERT INTO `posts` (`id`, `title`, `content`, `authorId`, `image`) VALUES (:id, :title, :content, :authorId, :imagePath)';
        $request = $this->bdd->prepare($insert);
        $request->execute(array(
            'id' => $newId,
            'title' => $title,
            'content' => $content,
            'authorId' => $authorId,
            'imagePath' => $url,
        ));
        return true;
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function updatePost($id, $title, $content, $authorId = null)
    {
        $updatePost = 'UPDATE `posts` SET `title` = :title, `content` = :content, ' . ($authorId !== null  ? '`authorId` = :authorId ' : '') . 'WHERE `id` = :id';
        $request = $this->bdd->prepare($updatePost);
        $args = array(
            'id' => $id,
            'title' => $title,
            'content' => $content,
        );
        $authorId !== null && $args['authorId'] = $authorId;
        return $request->execute($args);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deletePostById(string $id)
    {
        $deletePost = 'DELETE FROM posts WHERE id = :id';
        $request = $this->bdd->prepare($deletePost);
        $request->execute(array(
            'id' => $id
        ));

        $commentManager = new CommentManager(PDOFactory::getMysqlConnection());
        $commentManager->deleteCommentByPostId($id);

        return true;
    }

    public function createComment(string $postId, string $authorId, string $content)
    {
        if (isset($_SESSION['user'])) {
            $newId = uniqid();
            $insert = 'INSERT INTO `comments` (`id`, `postId`, `authorId`, `content`) VALUES (:id, :postId, :authorId, :content)';
            $request = $this->bdd->prepare($insert);
            $request->execute(
                array(
                    'id' => $newId,
                    'postId' => $postId,
                    'authorId' => $authorId,
                    'content' => $content
                )
            );
            header("Location: /post?id=$postId");
        } else {
            header("Location: /");
        };
        return true;
    }

    public function getCommentById(string $id)
    {
        $getComment = 'SELECT * FROM `comments` WHERE id = :id';
        $request = $this->bdd->prepare($getComment);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute(array(
            'id' => $id
        ));
        $comment = $request->fetchAll();
        return $comment ? $comment : null;
    }

    public function postUpdateComment(string $postId, string $authorId, string $content, string $id)
    {
        $updateComment = 'UPDATE `comments` SET `postId` = :postId, `authorId` = :authorId, `content` = :content WHERE `id` = :id';
        $request = $this->bdd->prepare($updateComment);
        $request->execute(
            array(
                'id' => $id,
                'postId' => $postId,
                'authorId' => $authorId,
                'content' => $content
            )
        );
        header("Location: /post?id=$postId");
        return true;
    }

    public function postExists($postId)
    {
        $request = $this->bdd->prepare('SELECT * FROM `posts` where id = :id');
        $request->bindParam(':id', $postId, PDO::PARAM_STR);
        $request->execute();
        $posts = $request->fetchAll();

        return $posts;
    }

    public function getAuthorById($id)
    {
        $request = $this->bdd->prepare('SELECT * FROM `authors` where id = :id');
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute(array(
            'id' => $id
        ));
        $users = $request->fetch();
        return $users;
    }
    public function uploadFile($file)
    {
        $res = array(
            'message' => '',
            'type' => '',
            'target' => '',
        );

        if (!empty($file) && isset($file)) {
            switch ($file["error"]) {
                case UPLOAD_ERR_OK:
                    $target = "public/uploads/";
                    $imageName = str_replace(' ', '-', strtolower($file['name']));

                    $target = $target . $imageName;

                    $path = $file['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    if ($ext === 'png' || $ext === 'jpg' || $ext === 'jpeg' || $ext === 'svg') {
                        if (move_uploaded_file($file['tmp_name'], $target)) {
                            $res['type'] = 'success';
                            $res['message'] = "The file " . $imageName . " has been uploaded";
                            $res['path'] = $target;

                            $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
                            $check = getimagesize($target);
                        } else {
                            $res['type'] = 'error';
                            $res['message'] = 'Sorry, there was a problem uploading your file.';
                        }
                    } else {
                        $res['type'] = 'error';
                        $res['message'] = 'Your file extension should be of type .png, .jpg, .jpeg or .svgx';
                    }

                    break;
                default:
                    $res['type'] = 'error';
                    $res['message'] = 'Sorry, there was a problem uploading your file.';
            }
        } else {
            $res['type'] = 'error';
            $res['message'] = 'File missing.';
        }
        return $res;
    }
}