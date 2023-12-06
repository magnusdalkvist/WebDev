



<?php
require_once __DIR__ . '/../_.php';
try {

  $db = _db();
  $q = $db->prepare('
  UPDATE items
  SET item_name = :item_name, 
  item_price = :item_price, 
  item_updated_at = :item_updated_at 
  WHERE item_id = :item_id
  AND item_created_by_user_fk = :item_created_by_user_fk
 ');

  $q->bindValue(':item_name', $_POST['item_name']);
  $q->bindValue(':item_price', $_POST['item_price']);
  $q->bindValue(':item_updated_at', time());
  $q->bindValue(':item_id', $_POST['item_id']);
  $q->bindValue(':item_created_by_user_fk', $_SESSION['user_id']);
  $q->execute();


  echo json_encode(['info' => 'it worked :)']);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
