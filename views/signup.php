<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<section class="flex flex-col items-center">
  <div class="py-8 px-8 md:w-1/3 bg-50-shades text-soft-white rounded-md">
    <div class="py-4">
      <h1>Welcome</h1>
      <p>Signup with email</p>
    </div>
    <form onsubmit="validate(signup); return false" class="flex flex-col gap-4 [&_input]:bg-soft-white [&_input]:text-black [&_input]:px-4 [&_input]:py-3 [&_input]:rounded-2xl [&_input]:placeholder:text-transparent-50 [&_select]:bg-soft-white [&_select]:px-4 [&_select]:py-3 [&_select]:rounded-2xl [&_select]:text-transparent-50 [&_select]:h-full">
      <div class="grid">
        <label for="user_name" class="flex">
          <span class="font-bold hidden text-sexyred">name</span>
          <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_NAME_MIN ?> to <?= USER_NAME_MAX ?> characters</span>
        </label>
        <input class="pl-2" id="user_name" placeholder="First name" name="user_name" type="text" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>">
      </div>

      <div class="grid">
        <label for="user_last_name" class="flex">
          <span class="font-bold hidden text-sexyred">last name</span>
          <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_LAST_NAME_MIN ?> to <?= USER_LAST_NAME_MAX ?> characters</span>
        </label>
        <input class="pl-2" id="user_last_name" name="user_last_name" placeholder="Last name" type="text" data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>">
      </div>

      <div class="grid">
        <label for="user_email" class="flex">
          <span class="ml-auto mr-2 text-xs opacity-0">x</span>
        </label>
        <input class="pl-2" name="user_email" type="text" placeholder="Email" onblur="is_email_available()" onfocus='document.querySelector("#msg_email_not_available").classList.add("opacity-0")' data-validate="email">
        <div id="msg_email_not_available" class="opacity-0 text-xs ml-2 pt-0.5">
          Email is not available
        </div>
      </div>

      <div class="grid">
        <label for="user_role_name" class="flex">
          <span class="ml-auto mr-2 text-xs hidden">Chose user role</span>
        </label>
        <select class="pl-2 border-slate-300 border rounded h-8" name="user_role_name" id="user_role_name">
          <option hidden>Select role</option>
          <option value="customer">Customer</option>
          <option value="employee">Employee</option>
        </select>
      </div>

      <div class="grid" class="flex">
        <label for="user_name" class="flex">
          <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_PASSWORD_MIN ?> to <?= USER_PASSWORD_MAX ?> characters</span>
        </label>
        <input class="pl-2" name="user_password" type="text" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
      </div>

      <div class="grid">
        <span class="ml-auto text-xs opacity-0">x</span>
        <input class="pl-2" name="user_confirm_password" type="text" placeholder="Confirm password" data-validate="match" data-match-name="user_password">
      </div>

      <div class="grid">
        <span class="text-xs py-2 text-grey-100">By clicking 'Create Account', you consent to our Terms of Service. Discover how we handle your information in our Privacy Policy and our use of cookies in our Cookie Policy.
        </span>
        <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Create account</button>
      </div>
    </form>
  </div>


  <div class="text-sexyred mt-4 font-bold flex justify-center "><a href="/login">Or login</a></div>
</section>




<?php require_once __DIR__ . '/_footer.php'  ?>