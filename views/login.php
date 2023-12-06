<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<section class="flex flex-col items-center">
  <div class="flex flex-col mt-20 py-8 px-8 bg-white rounded-md text-slate-500" style="width: 33%;">
    <h1>Welcome back</h1>
    <p>Login with email</p>
    <form onsubmit="validate(login); return false" class="flex flex-col gap-6 w-full h-full m-auto pt-8">

      <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="user_email">
        <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" name="user_email" type="email" id="user_email" placeholder="Email" data-validate="email">
      </label>
      <label class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey" for="user_password">
        <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none" name="user_password" type="password" id="password" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
      </label>
      <div class="text-sexyred" id="login_error"></div>
      <button class="w-full h-10 my-1 bg-sexyred text-white font-bold rounded-md">Login</button>
    </form>
  </div>
  <div class="text-sexyred mt-8 font-bold flex justify-center "><a href="/signup">Or signup</a></div>
</section>

<?php
require_once __DIR__ . '/_footer.php';
?>