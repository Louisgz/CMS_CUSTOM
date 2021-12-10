<div class="wrapper">
  <div id="formContent">

    <h3 class="formTitle">Edit the post</h3>

    <form action="edit-post?id=<?= $_GET['id'] ?>" method='post'>
      <input type="text" id="title" name="title" placeholder="title" value="<?=$posts[0]["title"]?>">
      <textarea type="text" id="content" name="content" placeholder="content"> <?=$posts[0]["content"]?></textarea>
      <input type="submit" value="Edit post">
    </form>

  </div>
</div>