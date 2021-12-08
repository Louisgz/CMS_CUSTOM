<?php

/**
 * @var $user \App\Entity\Author
 * @var $posts \App\Entity\Post[]
 */
?>

<div class="flex-post-column">
  <h1>Dernier post</h1>
  <?php
    foreach ($posts as $post) {
    ?>
  <div>
    <div>
        <a  href="/post?id=<?php echo $post['id'] ?>">
            <h3><?php echo $post['title'] ?></h3>
        </a>
      <p><?php echo $post['content'] ?></p>
    </div>
    <div>
    <a  href="/post?id=<?php echo $post['id'] ?>">
      <p>
        commentaires:
      </p>
      </a>
      <?php
        foreach ($comments as $comment) {
            if ($comment['postId'] == $post['id']) {
            ?>
                <div>
                    <p>
                    <?php echo $comment['content'] ?>
                    </p>
                </div>
            <?php
        }
    ?>

      <?php
        }
        ?>
      <input type="text" id="commentInput" name="addComment" placeholder="ajouter commentaire">
      <button id="addComment" class="btn btn-primary" onclick="addComment(<?php echo $post['id'] ?>)">Ajouter</button>
    </div>
  </div>
  <?php
    }

    ?>

</div>