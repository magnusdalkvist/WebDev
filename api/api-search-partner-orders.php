<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {
  // TODO: validate $_POST['query']
  $partner_id = $_SESSION['user_id'];
  $search = $_POST['query'] ?? '';
  $db = _db();
  $q = $db->prepare('
    SELECT *
    FROM orders
    WHERE order_placed_at_partner_fk = :partner_id
    AND order_id LIKE :order_id
  ');
  $q->bindValue(':partner_id', $partner_id);
  $q->bindValue(':order_id', '%' . $search . '%');
  $q->execute();
  $orders = $q->fetchAll();
  echo json_encode($orders);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
