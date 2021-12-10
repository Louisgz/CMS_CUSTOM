<div class="wrapper">
  <div class="formContent">

    <h3 class="formTitle">Edit the comment</h3>
    <form action="edit-comment?id=<?= $_GET['id'] ?>&postId=<?= $_GET['postId'] ?>" method='post'>
      <textarea type="text" id="content" name="content" placeholder="content"> <?= $comment[0]["content"] ?></textarea>
      <input type="submit" value="Edit comment">
    </form>

  </div>
</div>