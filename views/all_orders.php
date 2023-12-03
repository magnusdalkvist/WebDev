<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';

if (!_is_admin()) {
  header('Location: /login');
  exit();
};
?>
<main>
  <div class="mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
    <div class="flex py-4 text-xl">
      <h1 class="text-black">
        All Orders
      </h1>
      <?php
      $frm_search_url = 'api-search-all-orders.php';
      include_once __DIR__ . '/_form_search.php'
      ?>
    </div>
    <div class="grid grid-cols-5 items-center gap-4 border-b border-b-slate-200 py-2">
      <div>Order created: <span id="direction"></span></div>
      <div>Order ID: <span id="direction"></span></div>
      <div>Order created by: <span id="direction"></span></div>
      <div>Order status: </div>
      <div>Delivered by: <span id="direction"></span></div>
    </div>
    <div id="results"></div>
</main>
<?php
require_once __DIR__ . '/_footer.php';
?>
<script src="../js/orders.js"></script>