<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {
  // TODO: validate $_POST['query']
  $db = _db();
  $q = $db->prepare('
    SELECT *
    FROM users
    WHERE user_name LIKE :user_name
    OR user_last_name LIKE :user_last_name
  ');
  $q->bindValue(':user_name', '%' . $_POST['query'] . '%');
  $q->bindValue(':user_last_name', '%' . $_POST['query'] . '%');
  $q->execute();
  $customers = $q->fetchAll();
  echo json_encode($customers);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
