<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<div class="mt-16 pb-12 mr-4 px-4 bg-white rounded-md text-slate-500">
  <form onsubmit="validate(login); return false" class="flex flex-col gap-4 w-1/3 h-full m-auto pt-8">
    <input name="user_email" type="text" placeholder="email" value="admin@company.com">
    <input name="user_password" type="text" placeholder="password" value="password">
    <button>Login</button>
  </form>
</div>

<?php
require_once __DIR__ . '/_footer.php';
?>