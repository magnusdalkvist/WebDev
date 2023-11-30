<?php
require_once __DIR__ . '/_header.php';
if (!_is_admin()) {
  header('Location: /login');
  exit();
};

$db = _db();
$q = $db->prepare(' SELECT *
                    FROM users ');
$q->execute();
$users = $q->fetchAll();
?>


<div class="mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">

  <div class="flex py-4 text-xl">
    <h1 class="text-black">
      All users
    </h1>

    <?php
    $frm_search_url = 'api-search-customers.php';
    include_once __DIR__ . '/_form_search.php'
    ?>

  </div>


  <?php if (!$users) : ?>
    <h1>No customers in the system</h1>
  <?php endif ?>
  <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
    <div class="w-8 opacity-0">x</div>
    <div class="w-2/12">Name</div>
    <div class="w-2/12">Last name</div>
    <div class="w-2/12">Role</div>
    <div class="w-2/12">Email</div>
    <div class="w-3/12">Actions</div>
  </div>
  <?php foreach ($users as $user) : ?>
    <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
      <div class="hidden"><?= $user['user_id'] ?></div>
      <div class="w-8 h-8 flex items-center justify-center text-white text-sm rounded-full" style="background-color: <?php out($user['user_tag_color']) ?>;">
        <?php out($user['user_name'][0]) ?>
      </div>
      <div class="w-2/12"><?php out($user['user_name']) ?></div>
      <div class="w-2/12"><?php out($user['user_last_name']) ?></div>
      <div class="w-2/12"><?php out($user['user_role_name']) ?></div>
      <div class="w-2/12"><?php out($user['user_email']) ?></div>
      <div class="w-3/12 flex flex-row justify-between  gap-4 items-center">
        <button class="ml-auto">
          <span class="material-symbols-outlined mr-2 font-thin">
            open_in_new
          </span>
        </button>
        <button class="">
          <span class="material-symbols-outlined mr-2 font-thin">
            edit_note
          </span>
        </button>
        <button class="" onclick="toggle_blocked(<?= $user['user_id'] ?>,<?= $user['user_is_blocked'] ?>)">
          <?= $user['user_is_blocked'] == 0 ? "unblocked" : "blocked" ?>
        </button>
        <form onsubmit="delete_user(); return false">
          <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
          <button class="">
            <span class="material-symbols-outlined mr-2 font-thin">
              delete
            </span>
          </button>
        </form>
      </div>
    </div>
  <?php endforeach ?>
</div>



<?php
require_once __DIR__ . '/_footer.php';
?>