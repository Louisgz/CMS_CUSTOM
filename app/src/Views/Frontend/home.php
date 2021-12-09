<?php

/**
 * @var $user \App\Entity\Author
 * @var $posts \App\Entity\Post[]
 */
?>

<div class="flex-post-column">
  <h1>Derniers posts</h1>
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
  </div>
  <?php
    }

    ?>

</div>