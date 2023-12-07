<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>


<section class="flex flex-col items-center ">
  <div class="py-8 px-8 md:mt-10 md:w-1/3 bg-50-shades text-soft-white rounded-md">
    <div class=" pb-4">
      <h1>Signup as a partner today!</h1>
    </div>
    <form onsubmit="validate(partner_signup); return false" class="flex flex-col gap-4 text-slate-500">
      <div class="grid">
        <h2 class="text-sm ">Owner information</h2>
        <span class="font-bold hidden text-sexyred">name</span>
        <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_NAME_MIN ?> to <?= USER_NAME_MAX ?> characters</span>
        <label for="user_name" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " id="user_name" placeholder="First name" name="user_name" type="text" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>">
        </label>
      </div>

      <div class="grid">
        <span class="font-bold hidden text-sexyred">last name</span>
        <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_LAST_NAME_MIN ?> to <?= USER_LAST_NAME_MAX ?> characters</span>
        <label for="user_last_name" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " id="user_last_name" name="user_last_name" placeholder="Last name" type="text" data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>">
        </label>
      </div>

      <div class="grid mt-4">
        <h2 class="text-sm ">Restaurant information</h2>
        <span class="font-bold hidden text-sexyred">Restaurant name</span>
        <span class="ml-auto pb-0.5 mr-2 text-xs">2 to 60 characters</span>
        <label for="partner_name" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " id="partner_name" placeholder="Restaurant name" name="partner_name" type="text" data-validate="str" data-min="2" data-max="60">
        </label>
      </div>

      <div class="grid">
        <span class="ml-auto mr-2 text-xs opacity-0">x</span>
        <label for="user_email" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " name="user_email" type="text" placeholder="Email" onblur="is_email_available()" onfocus='document.querySelector("#msg_email_not_available").classList.add("opacity-0")' data-validate="email">
        </label>
        <div id="msg_email_not_available" class="opacity-0 text-xs ml-2 pt-0.5">
          Email is not available
        </div>
      </div>

      <div class="grid">
        <h2 class="text-sm ">Restaurant password</h2>
        <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_PASSWORD_MIN ?> to <?= USER_PASSWORD_MAX ?> characters</span>
        <label for="user_password" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " name="user_password" type="text" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
        </label>
      </div>

      <div class="grid">
        <span class="ml-auto text-xs opacity-0">x</span>
        <label for="user_confirm_password" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " name="user_confirm_password" type="text" placeholder="Confirm password" data-validate="match" data-match-name="user_password">
        </label>
      </div>

      <div class="grid gap-6">
        <span class="text-xs pt-2 text-grey-100">By clicking 'Create partner account', you consent to our Terms of Service. Discover how we handle your information in our Privacy Policy and our use of cookies in our Cookie Policy.
        </span>
        <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Create partner account</button>
      </div>

    </form>
  </div>

  <div class="text-sexyred mt-8 font-bold flex justify-center "><a href="/login">Or login</a></div>
</section>



<?php require_once __DIR__ . '/_footer.php'  ?>