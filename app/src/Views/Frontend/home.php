<div class="flex-post-column">
  <h1 style='margin: 3rem 0'>Home page </h1>
  <?php
  foreach ($posts as $post) {
  ?>
  <div class="post-container">
    <div>

      <a href="/post?id=<?php echo $post['post']['id'] ?>">
        <h3><?php echo $post['post']['title'] ?></h3>
      </a>
      <p style="font-size: 12px;"> écrit par : <?= $post['author']['username'] ?></p>
      <p style="font-size: 12px;"><?= $post['post']['date'] ?></p>
      <p><?php echo $post['post']['content'] ?></p>
      <a class="read-more-button" href="/post?id=<?php echo $post['post']['id'] ?>">
        <button type="button" class="btn btn-primary">
          Lire la suite
        </button>
      </a>
    </div>
    <div class="post-image">
      <img src="<?= $post['post']['image'] ?>" alt="">
    </div>
  </div>
  <?php
  }

  ?>

</div>