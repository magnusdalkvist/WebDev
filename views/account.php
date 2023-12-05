<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';


if (!isset($_SESSION['user']) || !$_SESSION['user']) {
  header('Location: /login');
  exit();
}

$user = $_SESSION['user'];
$_SESSION['user_id'] = $user['user_id'];


?>


<section class="grid grid-cols-2">
  <div class="flex flex-col">
    <div class="flex  gap-2 flex-col mt-16 p-8 mr-4 bg-white rounded-md text-slate-500">
      <h2 class="font-extrabold ">Profile</h2>

      <div class="hidden"><?= $user['user_id'] ?></div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">First name: </div>
        <div class="w-2/5"><?php out($user['user_name']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Last name: </div>
        <div class="w-2/5"><?php out($user['user_last_name']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Email: </div>
        <div class="w-2/5"><?php out($user['user_email']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Address: </div>
        <div class="w-2/5"><?php out($user['user_address']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">User ID: </div>
        <div class="w-2/5"><?php out($user['user_id']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Account created: </div>
        <div class="w-2/5"><?php echo date("d/m/Y H.i", $user['user_created_at']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Account updated: </div>
        <div class="w-2/5"><?php echo date("d/m/Y H.i", $user['user_updated_at']) ?></div>
      </div>
    </div>


    <div id="temporarily" class="flex  flex-col mt-4 p-8 mr-4  bg-white rounded-md text-slate-500">
      <div class="">
        <h2 class="font-extrabold ">Temporarily deactivate your account. </h2>
        <p>
          If you temporarily deactivate your account, your profile and information will be hidden until you reactivate it by logging back in. </p>
      </div>
      <form onsubmit="if(confirm('You are about to temporarily deactivate your account from our system. Do you want to continue?')) {window.location.href = '/logout';} return false;">
        <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
        <button class=" mt-6 font-bold flex items-center">
          <span class="material-symbols-outlined mr-2">
            hourglass_top
          </span>
          TEMPORARILY DEACTIVATE ACCOUNT
        </button>
      </form>
    </div>

    <div id="delete" class="flex  flex-col mt-4 p-8 mr-4  bg-white rounded-md text-slate-500">
      <div class="text-red-500">
        <h2 class=" font-extrabold ">Delete your account. </h2>
        <p>
          This action is irreversible and will permanently remove your account from our system.
          Please proceed with caution.</p>
      </div>
      <form onsubmit=" if(confirm('You are about to permanently remove your account from our system. Do you want to continue?')) { delete_user(); setTimeout(function(){ location.reload(); }, 1000); } return false;">
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
  <div class="flex flex-col ">
    <div id="update_account" class="flex flex-col mt-16 p-8 mr-4  bg-white rounded-md text-slate-500">
      <div class="pb-4">
        <h2 class="font-extrabold ">Update profile</h2>
      </div>
      <form class="flex flex-col gap-2" onsubmit="validate(update_user); return false">
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
          <input class="pl-2" type="text" id="user_address" name="user_address" value="<?= $user['user_address'] ?>">
        </label>

        <label class="flex flex-col" for="user_tag_colo">Profile color:
          <input type="color" id="user_tag_colo" name="user_tag_color" value="<?= $user['user_tag_color'] ?>">
        </label>
        <input type="submit" value="Update profile">
      </form>
    </div>

    <div id="update_account" class="flex flex-col mt-4 p-8 mr-4  bg-white rounded-md text-slate-500">
      <div class="pb-4">
        <h2 class="font-extrabold ">Update password</h2>
      </div>
      <form class="flex flex-col gap-2" onsubmit="validate(update_user_password); return false">
        <label class="flex flex-col" for="user_old_password">Old password:
          <input class="pl-2" type="password" id="user_old_password" name="user_old_password" placeholder="Old password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
        </label>

        <label class="flex flex-col" for="user_password">Password:
          <input class="pl-2" type="password" id="user_password" name="user_password" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
        </label>

        <label class="flex flex-col" for="user_confirm_password">Confirm password:
          <input class="pl-2" type="password" id="user_confirm_password" name="user_confirm_password" placeholder="Confirm password" data-validate="match" data-match-name="user_password">
        </label>
        <div id="password_error" class="text-red-500"></div>
        <input type="submit" value="Update password">
      </form>
    </div>
  </div>
</section>

<?php
require_once __DIR__ . '/_footer.php';
?>