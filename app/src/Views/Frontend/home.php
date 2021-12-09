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
  <div class="post-background">
    <div>
      <a href="/post?id=<?php echo $post['id'] ?>">
        <h3><?php echo $post['title'] ?></h3>
      </a>
      <p><?php echo $post['content'] ?></p>
    </div>
    <div>        
      <a class="read-more-button" href="/post?id=<?php echo $post['id'] ?>">
      <button type="button" class="btn btn-primary">
        Lire la suite</button></a>
    </div>
  </div>
  <?php
  }

  ?>

</div>