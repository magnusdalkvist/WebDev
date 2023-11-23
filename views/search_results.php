<?php
require_once __DIR__ . '/_header.php';

$db = _db();
$q = $db->prepare(' SELECT * FROM users 
                    WHERE user_name LIKE :word 
                    OR user_last_name LIKE :word');
$q->bindValue(':word', '%' . $_GET['query'] . '%');
$q->execute();
$users = $q->fetchAll();
?>



<main class="mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
  <?php foreach ($users as $user) : ?>
    <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
      <div class="hidden"><?= $user['user_id'] ?></div>
      <div class="w-1/4"><?php out($user['user_name']) ?></div>
      <div class="w-1/4"><?php out($user['user_last_name']) ?></div>
      <div class="w-2/5"><?php out($user['user_email']) ?></div>
      <button class="ml-auto">
        <span class="material-symbols-outlined mr-2 font-thin">
          visibility
        </span>
      </button>
      <button class="">
        <span class="material-symbols-outlined mr-2 font-thin">
          delete
        </span>
      </button>
    </div>
  <?php endforeach ?>


</main>

<?php
require_once __DIR__ . '/_footer.php';
?>