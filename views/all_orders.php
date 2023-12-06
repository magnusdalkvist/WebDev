<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';

if (!_is_admin()) {
  header('Location: /login');
  exit();
};
?>
<div class="flex justify-center">
  <?php
  $frm_search_url = 'api-search-all-orders.php';
  $frm_search_placeholder = 'Search for orders';
  include_once __DIR__ . '/_form_search.php'
  ?>
</div>
<div class="p-4 container mx-auto  bg-50-shades rounded-md text-soft-white">
  <div class="flex pb-4 text-xl">
    <h1 class="text-soft-white">
      All Orders
    </h1>

  </div>
  <div class="grid grid-cols-[2fr_1fr_2fr] md:grid-cols-5 items-center gap-4 border-b border-b-slate-200 py-2">
    <div>Order created: <span id="direction"></span></div>
    <div>Order ID: <span id="direction"></span></div>
    <div class="hidden md:block">Order created by: <span id="direction"></span></div>
    <div>Order status: </div>
    <div class="hidden md:block">Delivered by: <span id="direction"></span></div>
  </div>
  <div id="results"></div>
  <?php
  require_once __DIR__ . '/_footer.php';
  ?>
  <script src="../js/orders.js"></script>