<?php
require_once __DIR__ . '/../_.php';


if (!isset($_SESSION['user']) || !$_SESSION['user']) {
  header('Location: /login');
  exit();
}

require_once __DIR__ . '/_header.php';

$user = $_SESSION['user'];
$_SESSION['user_id'] = $user['user_id'];


?>



<section class=" gap-4 p-6 container mx-auto ">
  <div class=" flex flex-col gap-4">
    <div class="flex  gap-2 flex-col p-4 bg-50-shades rounded-md text-soft-white">
      <h2 class="font-extrabold ">Profile</h2>
      <div class="hidden"><?= $user['user_id'] ?></div>
      <div class="grid grid-cols-2  ">
        <div>First name: </div>
        <div><?php out($user['user_name']) ?></div>
      </div>
      <div class="grid grid-cols-2  ">
        <div>Last name: </div>
        <div><?php out($user['user_last_name']) ?></div>
      </div>
      <div class="grid grid-cols-2  ">
        <div>Email: </div>
        <div><?php out($user['user_email']) ?></div>
      </div>
      <div class="grid grid-cols-2  ">
        <div>Address: </div>
        <div><?php out($user['user_address']) ?></div>
      </div>
      <div class="grid grid-cols-2  ">
        <div>Account created: </div>
        <div><?php echo date("d/m/Y H.i", $user['user_created_at']) ?></div>
      </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
      <div id="update_account" class="flex flex-col  p-4 bg-50-shades rounded-md text-soft-white">
        <div class="pb-4">
          <h2 class="font-extrabold ">Update profile</h2>
        </div>
        <form class="flex flex-col gap-2" onsubmit="validate(update_user); return false">
          <input name="user_id" value="<?= $user['user_id'] ?>" class="hidden"></input>
          <label class="flex flex-col" for="user_name">Name:
            <input class=" pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" type="text" id="user_name" name="user_name" value="<?= $user['user_name'] ?>" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>"> </label>
          <label class="flex flex-col" for="user_last_name">Last Name:
            <input class=" pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" type="text" id="user_last_name" name="user_last_name" value="<?= $user['user_last_name'] ?>" data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>">
          </label>
          <label class="flex flex-col" for="user_email">Email:
            <input class=" pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" type="text" id="user_email" name="user_email" value="<?= $user['user_email'] ?>" data-validate="email">
          </label>

          <label class="flex flex-col" for="user_address">Address:
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" type="text" id="user_address" name="user_address" value="<?= $user['user_address'] ?>">
          </label>

          <div id="user_error" class="text-red-500"></div>
          <input class=" text-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" type="submit" value="Update profile">
        </form>
      </div>
      <div id="update_account" class="flex flex-col p-4  bg-50-shades rounded-md text-soft-white">
        <div class="pb-4">
          <h2 class="font-extrabold ">Update password</h2>
        </div>
        <form class="flex flex-col gap-2" onsubmit="validate(update_user_password); return false">
          <label class="flex flex-col" for="user_old_password">Old password:
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" type="password" id="user_old_password" name="user_old_password" placeholder="Old password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
          </label>

          <label class="flex flex-col" for="user_password">Password:
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" type="password" id="user_password" name="user_password" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
          </label>

          <label class="flex flex-col" for="user_confirm_password">Confirm password:
            <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" type="password" id="user_confirm_password" name="user_confirm_password" placeholder="Confirm password" data-validate="match" data-match-name="user_password">
          </label>
          <div id="password_error" class="text-red-500"></div>
          <input class="text-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" type="submit" value="Update password">
        </form>
      </div>
    </div>


    <div class="grid md:grid-cols-2 gap-4">
      <div id="temporarily" class="flex  flex-col  p-4  bg-50-shades rounded-md text-soft-white">
        <div class="">
          <h2 class=" font-extrabold ">Temporarily deactivate your account. </h2>
          <p>
            If you temporarily deactivate your account, your profile and information will be hidden until you reactivate it by logging back in. </p>
        </div>
        <form onsubmit=" if(confirm('You are about to temporarily deactivate your account from our system. Do you want to continue?')) {window.location.href='/logout' ;} return false;">
          <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
          <button class=" mt-6 font-bold flex items-center">
            <span class="material-symbols-outlined mr-2">
              hourglass_top
            </span>
            TEMPORARILY DEACTIVATE ACCOUNT
          </button>
        </form>
      </div>

      <div id="delete" class="flex  flex-col  p-4  bg-50-shades rounded-md text-soft-white">
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
  </div>
  <div class="flex flex-col ">

  </div>
</section>

<?php
require_once __DIR__ . '/_footer.php';
?>