<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';


if (!isset($_SESSION['user']) || !$_SESSION['user']) {
  header('Location: /login');
  exit();
}

$user = $_SESSION['user'];
$_SESSION['user_id'] = $user['user_id'];


$db = _db();
$q = $db->prepare(' SELECT * 
                    FROM orders WHERE order_created_by_user_fk = :user_id ');
$q->bindValue(':user_id',  $user['user_id']);
$q->execute();
$orders = $q->fetchAll();

?>



<main>
  <section class="flex flex-col mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
    <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
      <div class="hidden"><?= $user['user_id'] ?></div>
      <div class="w-1/4"><?php out($user['user_name']) ?></div>
      <div class="w-1/4"><?php out($user['user_last_name']) ?></div>
      <div class="w-2/5"><?php out($user['user_email']) ?></div>
    </div>
  </section>
  <section class="flex flex-col mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
    <h3 class="py-4">Orders:</h3>
    <div id="account_orders">
      <div class="">
        <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
          <div class="w-1/4">Order created:</div>
          <div class="w-1/4">Order ID:</div>
          <div class="w-1/4">Items:</div>
          <div class="w-1/4">Total price:</div>
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
            <div class="w-1/4"><?php echo date("d/m/Y H.i", $order['order_created_at']) ?></div>
            <div class="w-1/4"><?php out($order['order_id']) ?></div>
            <div class="w-1/4">
              <?php foreach ($items as $item) : ?>
                <div><?php out($item['orders_items_item_quantity'] . 'x ' . $item['item_name'] . '(' . $item['item_price'] . ')') ?></div>
              <?php endforeach ?>
            </div>
            <div class="w-1/4">
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
  </section>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>