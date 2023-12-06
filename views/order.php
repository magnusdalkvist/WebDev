<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';



if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $order_id = $_GET['id'];

    if ($_SESSION['user']['user_role_name'] == 'admin') {
        $db = _db();
        $q = $db->prepare(' SELECT * 
                            FROM orders WHERE order_id = :order_id');
        $q->bindValue(':order_id', $order_id);
        $q->execute();
        $order = $q->fetch();
    } elseif ($_SESSION['user']['user_role_name'] == 'partner') {
        $db = _db();
        $q = $db->prepare(' SELECT * 
                        FROM orders WHERE order_id = :order_id AND order_placed_at_partner_fk = :partner_id');
        $q->bindValue(':order_id', $order_id);
        $q->bindValue(':partner_id',  $_SESSION['user_id']);
        $q->execute();
        $order = $q->fetch();
    } else {
        $db = _db();
        $q = $db->prepare(' SELECT * 
                        FROM orders WHERE order_id = :order_id AND order_created_by_user_fk = :user_id');
        $q->bindValue(':order_id', $order_id);
        $q->bindValue(':user_id',  $_SESSION['user_id']);
        $q->execute();
        $order = $q->fetch();
    }
}

$db = _db();
$q = $db->prepare('SELECT `item_name`, `item_price`, `orders_items_item_quantity`, `orders_items_total_price` FROM `orders_items`
        INNER JOIN `items` ON `orders_items`.`orders_items_item_fk` = `items`.`item_id` WHERE `orders_items_order_fk` = :order_id');
$q->bindValue(':order_id', $order['order_id']);
$q->execute();
$items = $q->fetchAll();


?>

<section class="flex flex-col gap-4 p-4 container mx-auto bg-50-shades rounded-md text-soft-white">
    <h3 class="pt-2 text-soft-white font-bold">Order <?= $order_id ?></h3>

    <div class="flex flex-col items-start gap-4  border-b-slate-200">
        <h4>Order details:</h4>
        <div class="">Order created: <?php echo date("d/m/Y H.i", $order['order_created_at']) ?></div>
        <div class="">Order ID: <?php out($order['order_id']) ?></div>
        <div class="">Order delivered: <?php out($order['order_delivered_at']) ?></div>
        <div class="">Order delivered by: <?php out($order['order_delivered_by_user_fk']) ?></div>

        <?php
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item['orders_items_total_price'];
        }
        ?>
        <div>Total price: <?php echo $totalPrice; ?></div>
    </div>
    <hr>
    <div class=" flex flex-col items-start gap-2">
        <h4>Items:</h4>
        <?php foreach ($items as $item) : ?>
            <div><?php out($item['orders_items_item_quantity'] . 'x ' . $item['item_name'] . '(' . $item['item_price'] . ')') ?></div>
        <?php endforeach ?>
    </div>
    </div>
</section>

<?php
require_once __DIR__ . '/_footer.php';
?>