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

<section class=" container mx-auto ">
    <div class="pb-5">
        <button class="text-left flex gap-2" onclick="goBack()">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D0D0D0" version="1.1" id="Capa_1" width="800px" height="800px" viewBox="0 0 299.021 299.021" xml:space="preserve">
                <g>
                    <path d="M292.866,254.432c-2.288,0-4.443-1.285-5.5-3.399c-0.354-0.684-28.541-52.949-146.169-54.727v51.977    c0,2.342-1.333,4.48-3.432,5.513c-2.096,1.033-4.594,0.793-6.461-0.63L2.417,154.392C0.898,153.227,0,151.425,0,149.516    c0-1.919,0.898-3.72,2.417-4.888l128.893-98.77c1.87-1.426,4.365-1.667,6.461-0.639c2.099,1.026,3.432,3.173,3.432,5.509v54.776    c3.111-0.198,7.164-0.37,11.947-0.37c43.861,0,145.871,13.952,145.871,143.136c0,2.858-1.964,5.344-4.75,5.993    C293.802,254.384,293.34,254.432,292.866,254.432z" />
                </g>
            </svg>
            Go Back
        </button>
    </div>
    <div class="flex flex-col gap-4 p-4  bg-50-shades rounded-md text-soft-white">
        <div class="flex flex-col items-start gap-4  border-b-slate-200">
            <h3 class="pt-2 text-soft-white font-bold">Order <?= $order_id ?></h3>
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