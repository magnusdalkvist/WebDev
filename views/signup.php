<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<main class="w-full min-h-screen mt-16">
  <section class="flex flex-col items-center">
    <div class="mt-20 py-8 px-8 md:w-1/3 bg-white rounded-md">
      <div class="py-4">
        <h1>Welcome</h1>
        <p>Signup with email</p>
      </div>
      <form onsubmit="validate(signup); return false" class="flex flex-col gap-4   text-slate-500">
        <div class="grid">
          <label for="user_name" class="flex">
            <span class="font-bold hidden text-sexyred">name</span>
            <span class="ml-auto text-xs"><?= USER_NAME_MIN ?> to <?= USER_NAME_MAX ?> characters</span>
          </label>
          <input class="pl-2" id="user_name" placeholder="First name" name="user_name" type="text" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>" class="">
        </div>

        <div class="grid">
          <label for="user_last_name" class="flex">
            <span class="font-bold hidden text-sexyred">last name</span>
            <span class="ml-auto text-xs"><?= USER_LAST_NAME_MIN ?> to <?= USER_LAST_NAME_MAX ?> characters</span>

          </label>
          <input class="pl-2" id="user_last_name" name="user_last_name" placeholder="Last name" type="text" data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>" class="">
        </div>

        <div class="grid">
          <label for="user_email" class="flex">
            <span class="ml-auto text-xs opacity-0">x</span>
          </label>
          <input class="pl-2" name="user_email" type="text" placeholder="Email" onblur="is_email_available()" onfocus='document.querySelector("#msg_email_not_available").classList.add("hidden")' data-validate="email">
          <div id="msg_email_not_available" class="hidden">
            Email is not available
          </div>
        </div>

        <div class="grid" class="flex">
          <label for="user_name" class="flex">
            <span class="ml-auto text-xs"><?= USER_PASSWORD_MIN ?> to <?= USER_PASSWORD_MAX ?> characters</span>
          </label>
          <input class="pl-2" name="user_password" type="text" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>" class="">
        </div>

        <div class="grid">
          <span class="ml-auto text-xs opacity-0">x</span>
          <input class="pl-2" name="user_confirm_password" type="text" placeholder="Confirm password" data-validate="match" data-match-name="user_password" class="">
        </div>

        <div class="grid">
          <span class="text-xs pt-2 text-grey-100">By clicking 'Create Account', you consent to our Terms of Service. Discover how we handle your information in our Privacy Policy and our use of cookies in our Cookie Policy.
          </span>
          <button class="w-full h-10 my-5 bg-sexyred text-white font-bold rounded-md">Signup</button>
        </div>
      </form>
    </div>


    <div class="text-sexyred mt-8 font-bold flex justify-center "><a href="/login">Or login</a></div>
  </section>



</main>

<?php require_once __DIR__ . '/_footer.php'  ?>