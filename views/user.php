<?php
require_once __DIR__.'/../_.php';
$user_id = $_GET['user_id'];

// TODO: _validate_user_id() in the master file
$db = _db();
// $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
$q = $db->prepare('CALL get_user_by_id(:user_id)');
$q->bindValue(':user_id', $_GET['user_id']);
$q->execute();
$user = $q->fetch();
if( ! $user ){
  header('Location: /users');
  exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  ID: <?= $_GET['user_id'] ?>
  Name: <?= $user['user_name'] ?>
</body>
</html>
