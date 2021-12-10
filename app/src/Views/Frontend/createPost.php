<div class="wrapper">
  <div id="formContent">

    <h3 class="formTitle">Create a post</h3>
    <!-- Login Form -->
    <form enctype="multipart/form-data" action="create-post" method='post'>
      <input type="text" id="title" name="title" placeholder="title">
      <textarea type="text" id="content" name="content" placeholder="content"></textarea>
      <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
      <input name="postFile" type="file" />
      <input type="submit" value="Create post">
    </form>

  </div>
  <!-- </div> -->