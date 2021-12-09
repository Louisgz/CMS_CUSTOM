<div class="wrapper">
  <div id="formContent">

    <h3 class="formTitle">Edit the post</h3>
    <form action="edit-post/?id=<?=$_GET['id']?>" method='post'>
      <input type="text" id="title" name="title" placeholder="title" value="deja écrit">
      <textarea type="text" id="content" name="content" placeholder="content" value="deja écrit" ></textarea>
      <input type="submit" value="Create post">
    </form>

  </div>
  <!-- </div> -->