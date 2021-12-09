<div class="wrapper">
  <div id="formContent">

    <h3 class="formTitle">Page d'inscription</h3>
    <!-- Login Form -->
    <form action="signup" method='post'>
      <input type="text" id="firstname" name="firstname" placeholder="firstname" value='<?= $firstname ?>'>
      <input type="text" id="lastname" name="lastname" placeholder="lastname" value='<?= $lastname ?>'>
      <input type="text" id="username" name="username" placeholder="username" value='<?= $username ?>'>
      <input type="password" id="password" name="password" placeholder="password">
      <input type="submit" value="Log In">
    </form>

  </div>
</div>