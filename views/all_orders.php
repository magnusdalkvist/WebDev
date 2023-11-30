<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';

if (!_is_admin()) {
  header('Location: /login');
  exit();
};

$db = _db();
$q = $db->prepare(' SELECT * 
                    FROM orders');
$q->execute();
$orders = $q->fetchAll();

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
      <div>Items: </div>
      <div>Total price: <span id="direction"></span></div>
    </div>
    <div id="results"></div>
    <div id="account_orders">
      <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
      </div>
      <?php foreach ($orders as $order) :
        $db = _db();
        $q = $db->prepare('SELECT `item_name`, `item_price`, `orders_items_item_quantity`, `orders_items_total_price` FROM `orders_items`
        INNER JOIN `items` ON `orders_items`.`orders_items_item_fk` = `items`.`item_id` WHERE `orders_items_order_fk` = :order_id');
        $q->bindValue(':order_id', $order['order_id']);
        $q->execute();
        $items = $q->fetchAll();
      ?>
        <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
          <div class="w-1/5"><?php echo date("d/m/Y H.i", $order['order_created_at']) ?></div>
          <div class="w-1/5"><?php out($order['order_id']) ?></div>
          <div class="w-1/5"><?php out($order['order_created_by_user_fk']) ?></div>
          <div class="w-1/5">
            <?php foreach ($items as $item) : ?>
              <div><?php out($item['orders_items_item_quantity'] . 'x ' . $item['item_name'] . '(' . $item['item_price'] . ')') ?></div>
            <?php endforeach ?>
          </div>
          <div class="w-1/5">
            <?php
            $totalPrice = 0;
            foreach ($items as $item) {
              $totalPrice += $item['orders_items_total_price'];
            }
            ?>
            <div><?php echo $totalPrice; ?></div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>
<script src="../js/orders.js"></script>