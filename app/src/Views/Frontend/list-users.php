<div class="container" style="margin-top:2rem">

  <table class="table table-striped">
    <thead class="thead-dark" style="background: #313131; color: white;">
      <tr>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Username</th>
        <th scope="col">isAdmin</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($users as $user) {
      ?>

      <tr>
        <th scope="row">
          <?= $user['firstname'] ?>
        </th>
        <td>
          <?= $user['lastname'] ?>
        </td>
        <td>
          <?= $user['username'] ?>
        </td>
        <td>
          <input type="checkbox" aria-label="Checkbox for following text input" value='1'
            <?= $user['isAdmin'] ? 'checked' : '' ?> name='isAdmin' disabled>
        </td>
        <td>
          <?php
            if ($user['id'] !== $_SESSION['user']['id']) {
            ?>
          <form action="delete-author?id=<?= $user['id'] ?>" method='post'>
            <button type="submit" class="btn btn-danger">
              delete
            </button>
          </form>
          <?php
            }
            ?>
        </td>
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>