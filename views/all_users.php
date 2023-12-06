<?php
require_once __DIR__ . '/_header.php';
if (!_is_admin()) {
  header('Location: /login');
  exit();
};
?>


<section class="p-4 container mx-auto  bg-white rounded-md text-slate-500">

  <div class="flex py-4 text-xl">
    <h1 class="text-black">
      All users
    </h1>
    <?php
    $frm_search_url = 'api-search-all-users.php';
    include_once __DIR__ . '/_form_search.php'
    ?>
  </div>
  <div class="grid grid-cols-[auto_1fr_1fr_1fr] md:grid-cols-[auto_1fr_1fr_1fr_2fr_1fr] items-center gap-4 border-b border-b-slate-200 py-2">
    <div class="w-8"></div>
    <div id="sort_name">Name <span id="direction"></span></div>
    <div id="sort_last_name">Last name <span id="direction"></span></div>
    <div id="sort_role">Role <span id="direction"></span></div>
    <div id="sort_email" class="hidden md:block">Email <span id="direction"></span></div>
    <div id="sort_status" class="hidden md:block text-right">Status <span id="direction"></span></div>
  </div>
  <div id="results"></div>
</section>
<?php
require_once __DIR__ . '/_footer.php';
?>
<script src="../js/users.js"></script>