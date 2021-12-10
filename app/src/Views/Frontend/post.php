<?php

/**
 * @var $user \App\Entity\Author
 * @var $posts \App\Entity\Post[]
 */

use App\Entity\Author;
?>
<div class="flex-post-column">
  <?php
  foreach ($posts as $post) {
  ?>
  <div class="single-post-page">
    <div class="single-post-background">
      <h2><?php echo $post['title'] ?></h2>
      <div>
        <?php
          $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
          if ($user && ($user['isAdmin'] == 1 || $user['id'] === $post['authorId'])) {
          ?>
        <form action="delete-post?id=<?= $_GET['id'] ?>" method="post">
          <button type="submit" class="btn btn-danger">Delete post</button>
        </form>
        <button type="button" class="btn btn-warning">Edit post</button>
        <?php

          }
          ?>
      </div>
      <div>
        <p><?php echo $post['content'] ?></p>
      </div>
    </div>
    <div>
      <?php if (isset($_SESSION['user'])) { ?>
      <div>
        <h4>Ajouter un commentaire :</h4>
      </div>
      <form action="create-comment/?id=<?= $_GET['id'] ?>" method='post'>
        <input type="text" id="commentInput" name="comment" placeholder="ajouter commentaire">
        <input class="btn btn-success" type="submit" value="add comment">

      </form>

      <?php } ?>
    </div>
    <div class="single-post-background">
      <h4>
        All Comments:
      </h4>
      <?php
        foreach ($comments as $comment) {
          if ($comment['postId'] == $post['id']) {
        ?>
      <div>
        <div>
          <p>
            <?php echo $comment['content'] ?>
          </p>
        </div>
        <form action="delete-comment?id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>" method='post'>
          <button type="submit" class="btn btn-danger">Delete comment</button>
        </form>
      </div>
      <?php
          }
          ?>

      <?php
        }
        ?>
    </div>
  </div>
  <?php
  }

  ?>

</div>