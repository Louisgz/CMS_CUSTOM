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
    <div class="single-post-container">
      <h2><?php echo $post['title'] ?></h2>
      <?php
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        if ($user && ($user['isAdmin'] == 1 || $user['id'] === $post['authorId'])) {
        ?>
      <div class="button-flex" style="margin: 1rem 0 3rem">
        <form action="delete-post?id=<?= $_GET['id'] ?>" method="post" style='margin-right: 1.5rem'>
          <button type="submit" class="btn btn-danger">Delete post</button>
        </form>
        </form>
        <div>
          <a href="/edit-post?id=<?= $_GET['id'] ?>">
            <button type="button" class="btn btn-warning">Edit post</button>
          </a>
        </div>
      </div>
      <?php
        }
        ?>
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
    <div class="single-post-container">
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
        <div class="button-flex">
          <?php
                $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
                if ($user && ($user['isAdmin'] === 1 || $user['id'] === $comment['authorId'])) {
                ?>
          <form action="delete-comment?id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>" method='post'
            style="margin-right: 1rem">
            <button type="submit" class="btn btn-danger">Delete comment</button>
          </form>
          <a href="/edit-comment?id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>">
            <button type="submit" class="btn btn-warning">edit comment</button>
          </a>
          <?php

                }
                ?>
        </div>
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