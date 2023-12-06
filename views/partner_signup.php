<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<main class="w-full min-h-screen mt-16">
  <section class="flex flex-col items-center">
    <div class="gap-4 p-4 container max-w-sm mx-auto bg-50-shades rounded-md text-soft-white">
      <div class="pb-2">
        <h1>Welcome</h1>
        <p>Signup as a partner today!</p>
      </div>
      <form onsubmit="validate(signup); return false" class="flex flex-col gap-4 text-slate-500">
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
          <span class="text-xs pt-2 text-grey-100">By clicking 'Create Account', you consent to our Terms of Service. Discover how we handle your information in our Privacy Policy and our use of cookies in our Cookie Policy.
          </span>
          <button class="w-full h-10 my-5 bg-sexyred text-white font-bold rounded-md">Create account</button>
        </div>
      </form>
    </div>


    <div class="text-sexyred mt-8 font-bold flex justify-center "><a href="/login">Or login</a></div>
  </section>



</main>

<?php require_once __DIR__ . '/_footer.php'  ?>