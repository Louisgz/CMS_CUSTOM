<div class="wrapper align-items-center justify-content-start flex-column p-5">
  <h2 class='mb-4'>Bonjour <?= $username ?></h2>
  <div class="container" style="max-width: 700px; margin: 0 auto">

    <form>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Username</span>
        </div>
        <input type="text" class="form-control" placeholder="username" aria-label="username"
          aria-describedby="basic-addon1" value="<?= $username ?>">
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Firstname</span>
        </div>
        <input type="text" class="form-control" placeholder="firstname" aria-label="Firstname"
          aria-describedby="basic-addon1" value="<?= $firstname ?>">
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Lastname</span>
        </div>
        <input type="text" class="form-control" placeholder="lastname" aria-label="Lastname"
          aria-describedby="basic-addon1" value="<?= $lastname ?>">
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Admin ?</span>
        </div>
        <div class="input-group-text" style='background: white; border-radius: 0.25rem'>
          <input type="checkbox" aria-label="Checkbox for following text input" <?= $isAdmin ? 'checked' : '' ?>>
        </div>
      </div>
      <div class="input-group mb-3">
        <button type="submit" class="btn btn-primary">Modifer</button>

      </div>
    </form>
  </div>
</div>