<?php
session_start();
?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/global.css">
    <title><?= $title; ?></title>
  </head>

  <body>
    <header class="p-3 bg-dark text-white">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
              <use xlink:href="#bootstrap" />
            </svg>
          </a>

          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 text-secondary">Home</a></li>
            <?php
          if (isset($_SESSION['user'])) {
          ?>
            <li><a href="/create-post" class="nav-link px-2 text-white">Create post</a></li>
            <li><a href="/account" class="nav-link px-2 text-white">My account</a></li>
            <?php
          }
          if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
          ?>
            <li><a href="/list-users" class="nav-link px-2 text-white">List users</a></li>
            <?php
          }
          ?>
          </ul>

          <div class="text-end">

            <?php
          if (!isset($_SESSION['user'])) {
          ?>
            <a href="/login">
              <button type="button" class="btn btn-outline-light me-2">Login</button>
            </a>
            <a href="/signup">
              <button type="button" class="btn btn-warning">Sign-up</button>
            </a>

            <?php
          } else {
          ?>
            <form action="/logout" method="post">
              <button type="submit" class="btn btn-warning">Log out</button>
            </form>
            <?php
          }
          ?>

          </div>
        </div>
      </div>
    </header>
    <?php if (\App\Fram\Utils\Flash::hasFlash('success')) : ?>
    <div class="alert alert-success" role="alert">
      <?= \App\Fram\Utils\Flash::getFlash('success'); ?>
    </div>
    <?php endif; ?>

    <?php if (\App\Fram\Utils\Flash::hasFlash('alert')) : ?>
    <div class="alert alert-danger" role="alert">
      <?= \App\Fram\Utils\Flash::getFlash('alert'); ?>
    </div>
    <?php endif; ?>
    <div class="page-container d-flex">
      <?= $content; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
  </body>

</html>