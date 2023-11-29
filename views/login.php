<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<main class="w-full min-h-screen mt-16">
  <section class="flex flex-col items-center">
    <div class="flex flex-col mt-20 py-8 px-8 bg-white rounded-md text-slate-500" style="width: 33%;">
      <h1>Welcome back</h1>
      <p>Login with email</p>
      <form onsubmit="validate(login); return false" class="flex flex-col gap-6 w-full h-full m-auto pt-8">
        <input class="pl-2" name="user_email" type="email" id="username" placeholder="email">
        <input class="pl-2" name="user_password" type="password" id="password" placeholder="password">
        <button class="w-full h-10 my-1 bg-sexyred text-white font-bold rounded-md">Login</button>
      </form>
    </div>
    <div class="text-sexyred mt-8 font-bold flex justify-center "><a href="/signup">Or signup</a></div>
  </section>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>