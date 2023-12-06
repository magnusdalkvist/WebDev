<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';


if (isset($_GET['id']) && _is_admin()) {
  $user_id = $_GET['id'];
  $db = _db();
  $q = $db->prepare(' SELECT * 
                          FROM users WHERE user_id = :user_id');
  $q->bindValue(':user_id', $user_id);
  $q->execute();
  $user = $q->fetch();
} else {
  header('Location: /login');
  exit();
}

?>

<section class=" p-4 container mx-auto ">
  <div class="grid grid-cols-2 gap-4">
    <div class="flex gap-2 flex-col mt-16 p-8 bg-white rounded-md text-slate-500">
      <h2 class="font-extrabold ">Profile</h2>

      <div class="hidden"><?= $user['user_id'] ?></div>
      <div class="grid grid-cols-2 ">
        <div>First name: </div>
        <div><?php out($user['user_name']) ?></div>
      </div>
      <div class="grid grid-cols-2 ">
        <div>Last name: </div>
        <div><?php out($user['user_last_name']) ?></div>
      </div>
      <div class="grid grid-cols-2 ">
        <div>Email: </div>
        <div><?php out($user['user_email']) ?></div>
      </div>
      <div class="grid grid-cols-2 ">
        <div>Address: </div>
        <div><?php out($user['user_address']) ?></div>
      </div>
      <div class="grid grid-cols-2 ">
        <div>User ID: </div>
        <div><?php out($user['user_id']) ?></div>
      </div>
      <div class="grid grid-cols-2 ">
        <div>Account created: </div>
        <div><?php echo date("d/m/Y H.i", $user['user_created_at']) ?></div>
      </div>
      <div class="grid grid-cols-2 ">
        <div>Account updated: </div>
        <div><?php echo date("d/m/Y H.i", $user['user_updated_at']) ?></div>
      </div>
      <div class="grid grid-cols-2 ">
        <div>Account deleted: </div>
        <div>
          <?php
          if ($user['user_deleted_at'] != 0) {
            echo date("d/m/Y H.i", $user['user_deleted_at']);
          } else {
            echo "User not deleted";
          }
          ?>
        </div>
      </div>
    </div>

    <div id="update_account" class="flex flex-col mt-16 p-8  bg-white rounded-md text-slate-500">
      <div class="pb-4">
        <h2 class="font-extrabold ">Update profile</h2>
      </div>
      <form class="flex flex-col gap-2" onsubmit="validate(update_user); return false">
        <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
        <label class="flex flex-col" for="user_name">Name:
          <input class="pl-2" type="text" id="user_name" name="user_name" value="<?= $user['user_name'] ?>" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>">
        </label>
        <label class="flex flex-col" for="user_last_name">Last Name:
          <input class="pl-2" type="text" id="user_last_name" name="user_last_name" value="<?= $user['user_last_name'] ?>" data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>">
        </label>
        <label class="flex flex-col" for="user_email">Email:
          <input class="pl-2" type="text" id="user_email" name="user_email" value="<?= $user['user_email'] ?>" data-validate="email">
        </label>

        <label class="flex flex-col" for="user_address">Address:
          <input class="pl-2" type="text" id="user_address" name="user_address" value="<?= $user['user_address'] ?>" data-validate="str" data-max="255">
        </label>

        <label class="flex flex-col" for="user_tag_colo">Profile color:
          <input type="color" id="user_tag_colo" name="user_tag_color" value="<?= $user['user_tag_color'] ?>">
        </label>
        <input type="submit" value="Update profile">
      </form>
    </div>


  </div>
  <div class="grid grid-cols-2 gap-4">
    <div id="block" class="flex flex-col mt-4 p-8  bg-white rounded-md text-slate-500">
      <div class="pb-4">
        <h2 class="font-extrabold ">Block <?= $user['user_name'] ?> <?= $user['user_last_name'] ?></h2>
        <p>
          This action will block <?php out($user['user_name']) ?> from accessing our system.
          Please proceed with caution.</p>
      </div>
      <div class="flex flex-row items-center">
        <span class="material-symbols-outlined mr-2">
          BLOCK
        </span>
        <button class="font-bold flex items-center" onclick="toggle_blocked('<?= $user['user_id']; ?>', '<?= $user['user_is_blocked']; ?>')">
          <?= $user['user_is_blocked'] == 0 ? "UNBLOCKED" : "BLOCKED"; ?>
        </button>
      </div>
    </div>

    <div id="delete" class="flex flex-col mt-4 p-8  bg-white rounded-md text-slate-500">
      <div class="text-red-500">
        <h2 class=" font-extrabold ">Delete <?php out($user['user_name']) ?>'s account. </h2>
        <p>
          This action is irreversible and will permanently remove <?php out($user['user_name']) ?>'s account from our system.
          Please proceed with caution.</p>
      </div>
      <form onsubmit=" if(confirm('You are about to permanently remove the account from our system. Do you want to continue?')) { admin_delete_user(); setTimeout(function(){ location.reload(); }, 1000); } return false;">
        <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
        <button class="text-red-500 mt-6 font-bold flex items-center">
          <span class="material-symbols-outlined mr-2">
            delete
          </span>
          DELETE ACCOUNT
        </button>
      </form>
    </div>

  </div>
</section>

<?php
require_once __DIR__ . '/_footer.php';
?>