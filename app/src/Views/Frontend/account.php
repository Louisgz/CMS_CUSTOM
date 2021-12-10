<div class="wrapper align-items-center justify-content-start flex-column p-5">
  <h2 class='mb-4'>Bonjour <?= $firstname ?></h2>
  <div class="container" style="max-width: 700px; margin: 0 auto">
    <form action="update" method='post'>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Username</span>
        </div>
        <input type="text" class="form-control" placeholder="username" aria-label="username"
          aria-describedby="basic-addon1" value="<?= $username ?>" disabled>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Firstname</span>
        </div>
        <input type="text" class="form-control" placeholder="firstname" aria-label="Firstname"
          aria-describedby="basic-addon1" value="<?= $firstname ?>" name='firstname'>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Lastname</span>
        </div>
        <input type="text" class="form-control" placeholder="lastname" aria-label="Lastname"
          aria-describedby="basic-addon1" value="<?= $lastname ?>" name='lastname'>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Password</span>
        </div>
        <input type="password" class="form-control" placeholder="password" aria-label="Password"
          aria-describedby="basic-addon1" name='password'>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Admin ?</span>
        </div>
        <div class="input-group-text" style='background: white; border-radius: 0.25rem'>
          <input type="checkbox" aria-label="Checkbox for following text input" value='1'
            <?= $isAdmin == 1 ? 'checked' : '' ?> name='isAdmin'>
        </div>
      </div>
      <div class="input-group mb-3">
        <button type="submit" class="btn btn-primary">Enregistrer</button>

      </div>
    </form>
  </div>
</div>