<?php
require_once __DIR__ . '/../_.php';


if (!_is_partner()) {
  header('Location: /login');
  exit();
};

require_once __DIR__ . '/_header.php';
?>
<section class=" p-4 container mx-auto bg-50-shades rounded-md text-soft-white">
  <div class="flex py-4 text-xl">
    <h1 class="">
      All your orders
    </h1>
    <?php
    $frm_search_url = 'api-search-partner-orders.php';
    include_once __DIR__ . '/_form_search.php'
    ?>
  </div>
  <div class="grid grid-cols-[2fr_1fr_2fr] md:grid-cols-5 items-center gap-4 border-b border-b-soft-white py-2">
    <div>Order created: <span id="direction"></span></div>
    <div>Order ID: <span id="direction"></span></div>
    <div class="hidden md:block">Order created by: <span id="direction"></span></div>
    <div>Order status: </div>
    <div class="hidden md:block">Delivered by: <span id="direction"></span></div>
  </div>
  <div id="results"></div>
</section>
<?php
require_once __DIR__ . '/_footer.php';
?>
<script src="../js/orders.js"></script>