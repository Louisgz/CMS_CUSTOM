<div class="flex-post-column">
  <h1 style='margin: 3rem 0'>Home page </h1>
  <?php
  foreach ($posts as $post) {
  ?>
  <div class="post-container">
    <div class="post-infos">
      <a href="/post?id=<?= $post['id'] ?>">
        <h3><?= $post['title'] ?></h3>
      </a>
      <p><?= $post['content'] ?></p>
      <a class="read-more-button" href="/post?id=<?= $post['id'] ?>">
        <button type="button" class="btn btn-primary">
          Lire la suite
        </button>
      </a>
    </div>
    <div class="post-image">
      <img src="<?= $post['image'] ?>" alt="">
    </div>
  </div>
  <?php
  }

  ?>

</div>