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



<main class="mt-16 pb-20 mr-4 px-4 bg-white rounded-md text-slate-500">
  <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
    <div class="hidden"><?= $user['user_id'] ?></div>
    <div class="w-1/4"><?php out($user['user_name']) ?></div>
    <div class="w-1/4"><?php out($user['user_last_name']) ?></div>
    <div class="w-2/5"><?php out($user['user_email']) ?></div>
  </div>
</main>

<?php
require_once __DIR__ . '/_footer.php';
?>
