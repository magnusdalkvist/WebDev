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
  <section class="flex">
    <div class="flex w-1/2 gap-2 flex-col mt-16 p-8 mr-4 bg-white rounded-md text-slate-500">
      <h2>Profile</h2>
      <div class="hidden"><?= $user['user_id'] ?></div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">First name: </div>
        <div class="w-2/5"><?php out($user['user_name']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Last name: </div>
        <div class="w-2/5"><?php out($user['user_last_name']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Email: </div>
        <div class="w-2/5"><?php out($user['user_email']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Address: </div>
        <div class="w-2/5"><?php out($user['user_address']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">User ID: </div>
        <div class="w-2/5"><?php out($user['user_id']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Account created: </div>
        <div class="w-2/5"><?php echo date("d/m/Y H.i", $user['user_created_at']) ?></div>
      </div>
      <div class="flex  gap-4 ">
        <div class="w-1/5">Account updated: </div>
        <div class="w-2/5"><?php echo date("d/m/Y H.i", $user['user_updated_at']) ?></div>
      </div>
    </div>

    <!-- <section class="flex flex-col mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
    <h3 class="py-4">Orders:</h3>
    <div id="account_orders">
      <div class="">
        <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
          <div class="w-1/5">Order created:</div>
          <div class="w-2/5">Order ID:</div>
          <div class="w-1/5">Items:</div>
          <div class="w-1/5">Total price:</div>
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
            <div class="w-2/5"><?php out($order['order_id']) ?></div>
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
  </section> -->

    <div class="flex w-1/2 flex-col mt-16 p-8 mr-4  bg-white rounded-md text-slate-500">
      <h2>Settings</h2>
      <form class="flex flex-col " onsubmit="validate(update_user);">
        <label for="user_name">User Name:</label>
        <input type="text" id="user_name" name="user_name" value="<?= $user['user_name'] ?>">

        <label for="user_last_name">User Last Name:</label>
        <input type="text" id="user_last_name" name="user_last_name" value="<?= $user['user_last_name'] ?>">

        <label for="user_email">User Email:</label>
        <input type="email" id="user_email" name="user_email" value="<?= $user['user_email'] ?>">

        <label for="user_tag_colo">User color:</label>
        <input type="color" id="user_tag_colo" name="user_tag_color" value="<?= $user['user_tag_color'] ?>">

        <label for="user_password">Confirm Password:</label>
        <input type="password" id="user_password" name="user_password">

        <input type="submit" value="Update">
      </form>


    </div>
  </section>
  <section class="flex items-center">
    <div id="delete" class="flex w-1/2 flex-col mt-4 p-8 mr-4  bg-white rounded-md text-slate-500">
      <div class="font-medium  flex items-center">
        <h3 class="">Temporarily deactivate your account. <br>
          If you temporarily deactivate your account, your profile and information will be hidden until you reactivate it by logging back in. </h3>
      </div>
      <form onsubmit="temporarily_deactivate_user(); return false">
        <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
        <button class=" mt-6 font-bold flex items-center">
          <span class="material-symbols-outlined mr-2">
            hourglass_top
          </span>
          TEMPORARILY DEACTIVATE ACCOUNT
        </button>
      </form>
    </div>
    <div id="delete" class="flex w-1/2 flex-col mt-4 p-8 mr-4  bg-white rounded-md text-slate-500">
      <div class="font-medium  flex items-center">
        <h3 class="text-red-500">Delete your account. <br>
          This action is irreversible and will permanently remove your account from our system.
          Please proceed with caution.</h3>
      </div>
      <form onsubmit="delete_user(); return false">
        <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
        <button class="text-red-500 mt-6 font-bold flex items-center">
          <span class="material-symbols-outlined mr-2">
            delete
          </span>
          DELETE ACCOUNT
        </button>
      </form>
    </div>
  </section>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>