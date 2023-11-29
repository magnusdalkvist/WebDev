<?php
require_once __DIR__ . '/../_.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']) {
 header('Location: /login');
 exit();
}

$user = $_SESSION['user'];
$_SESSION['user_id'] = $user['user_id']; 

require_once __DIR__ . '/_header.php';
?>

<main class="mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
 <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
   <div class="hidden"><?= $user['user_id'] ?></div>
   <div class="w-1/4"><?php out($user['user_name']) ?></div>
   <div class="w-1/4"><?php out($user['user_last_name']) ?></div>
   <div class="w-2/5"><?php out($user['user_email']) ?></div>
 </div>

 
 <form onsubmit="validate(update_user);">
   <label for="user_name">User Name:</label>
   <input type="text" id="user_name" name="user_name" value="<?= $user['user_name'] ?>">

   <label for="user_last_name">User Last Name:</label>
   <input type="text" id="user_last_name" name="user_last_name" value="<?= $user['user_last_name'] ?>">

   <label for="user_email">User Email:</label>
   <input type="email" id="user_email" name="user_email" value="<?= $user['user_email'] ?>">

   <label for="user_password">User Password:</label>
   <input type="password" id="user_password" name="user_password">

   <input type="submit" value="Update">
 </form>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>
