<?php
require_once __DIR__ . '/../_.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']) {
  header('Location: /login');
  exit();
}

$user = $_SESSION['user'];



$db = _db();
$q = $db->prepare(' SELECT * 
                    FROM orders WHERE order_created_by_user_fk = :user_id ');
$q->bindValue(':user_id',  $user['user_id']);
$q->execute();
$orders = $q->fetchAll();



require_once __DIR__ . '/_header.php';
?>



<main class="mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
  <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
    <div class="hidden"><?= $user['user_id'] ?></div>
    <div class="w-1/4"><?php out($user['user_name']) ?></div>
    <div class="w-1/4"><?php out($user['user_last_name']) ?></div>
    <div class="w-2/5"><?php out($user['user_email']) ?></div>
  </div>

  <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
    <?php if (!$orders) : ?>
      <h1>No customers in the system</h1>
    <?php endif ?>

    <?php foreach ($orders as $order) :
      $q = $db->prepare(' SELECT * 
      FROM orders_items WHERE orders_items_order_fk = :order_id ');
      $q->bindValue(':order_id',  $order['order_id']);
      $q->execute();
      $items = $q->fetchAll();
      echo json_encode($items);
      // Join orders_items med orders, så vi kan vise useres gennemførte orders og købte produkter 
    ?>
      <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
        <div class="w-1/4"><?php out($order['order_id']) ?></div>
        <div class="w-1/4"><?php out($order['order_id']) ?></div>
      </div>
    <?php endforeach ?>
  </div>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>