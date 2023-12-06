<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';

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
  <section class="p-4 container mx-auto  bg-50-shades rounded-md text-soft-white">
    <h3 class="py-4 text-soft-white font-bold">My orders:</h3>
    <div id="account_orders">
      <div class="">
        <div class="grid grid-cols-[2fr_1fr_1fr] md:grid-cols-[1fr_1fr_2fr_1fr] items-center gap-4 border-b border-b-slate-200 py-2">
          <div class="">Order created:</div>
          <div class="">Order ID:</div>
          <div class="hidden md:block">Items:</div>
          <div class="">Total price:</div>
        </div>
        <?php foreach ($orders as $order) :
          $db = _db();
          $q = $db->prepare('SELECT `item_name`, `item_price`, `orders_items_item_quantity`, `orders_items_total_price` FROM `orders_items`
        INNER JOIN `items` ON `orders_items`.`orders_items_item_fk` = `items`.`item_id` WHERE `orders_items_order_fk` = :order_id');
          $q->bindValue(':order_id', $order['order_id']);
          $q->execute();
          $items = $q->fetchAll();
        ?>
          <a href="order/<?= $order['order_id'] ?>" class="grid grid-cols-[2fr_1fr_1fr] md:grid-cols-[1fr_1fr_2fr_1fr]  items-center gap-4 border-b border-b-slate-200 py-2">
            <div class=""><?php echo date("d/m/Y H.i", $order['order_created_at']) ?></div>
            <div class=""><?php out($order['order_id']) ?></div>
            <div class="hidden md:block">
              <?php foreach ($items as $item) : ?>
                <div><?php out($item['orders_items_item_quantity'] . 'x ' . $item['item_name'] . '(' . $item['item_price'] . ')') ?></div>
              <?php endforeach ?>
            </div>
            <div class="">
              <?php
              $totalPrice = 0;
              foreach ($items as $item) {
                $totalPrice += $item['orders_items_total_price'];
              }
              ?>
              <div><?php echo $totalPrice; ?></div>
            </div>
          </a>
        <?php endforeach ?>
      </div>
  </section>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>