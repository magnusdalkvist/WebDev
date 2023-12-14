<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {
  $search = $_POST['query'] ?? '';
  $db = _db();
  $q = $db->prepare('
  SELECT items.*, partners.partner_name, partners.user_partner_id
  FROM items 
  INNER JOIN users ON items.item_created_by_user_fk = users.user_id 
  INNER JOIN partners ON users.user_id = partners.user_partner_id 
  WHERE (items.item_name LIKE :item_name OR partners.partner_name LIKE :partner_name)
  ORDER BY partners.partner_name, partners.user_partner_id
  ');
  $q->bindValue(':item_name', '%' . $search . '%');
  $q->bindValue(':partner_name', '%' . $search . '%');
  $q->execute();
  $items = $q->fetchAll();
  echo json_encode($items);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
