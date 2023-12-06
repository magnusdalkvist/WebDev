<?php

require_once __DIR__ . '/../_.php';

try {

  _validate_user_name();
  _validate_user_last_name();
  _validate_user_email();
  _validate_user_password();
  _validate_user_confirm_password();

  $db = _db();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
  $db->beginTransaction(); // Start transaction

  $q = $db->prepare('
  INSERT INTO users 
  (user_name, user_last_name, user_email, user_password, user_address, user_role_name, user_tag_color, user_created_at, user_updated_at, user_deleted_at, user_is_blocked)
  VALUES 
  (:user_name, :user_last_name, :user_email, :user_password, :user_address, :user_role_name, :user_tag_color, :user_created_at, :user_updated_at, :user_deleted_at, :user_is_blocked)
');
  $q->bindValue(':user_name', $_POST['user_name']);
  $q->bindValue(':user_last_name', $_POST['user_last_name']);
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->bindValue(':user_password', password_hash($_POST['user_password'], PASSWORD_DEFAULT));
  $q->bindValue(':user_address', "");
  $q->bindValue(':user_role_name',  'partner');
  $q->bindValue(':user_tag_color', '#0ea5e9');
  $q->bindValue(':user_created_at', time());
  $q->bindValue(':user_updated_at', time());
  $q->bindValue(':user_deleted_at', 0);
  $q->bindValue(':user_is_blocked', 0);

  $q->execute();

  if ($q->rowCount() != 1) {
    throw new Exception('User creation failed', 500);
  }

  $user_id = $db->lastInsertId();

  $q = $db->prepare(
    '
    INSERT INTO partners 
    VALUES (
      :user_partner_id, 
      :partner_geo,  
      :partner_name)'
  );
  $q->bindValue(':user_partner_id', $user_id);
  $q->bindValue(':partner_geo', null);
  $q->bindValue(':partner_name', $_POST['partner_name']);

  $q->execute();

  if ($q->rowCount() != 1) {
    throw new Exception('Partner creation failed', 500);
  }

  $db->commit(); // Commit the transaction

  echo json_encode(['user_id' => $db->lastInsertId()]);
} catch (PDOException $pdoe) {
  $db->rollBack(); // Roll back the transaction in case of error
  http_response_code(500);
  echo json_encode(['error' => $pdoe->getMessage()]);
} catch (Exception $e) {
  $db->rollBack(); // Roll back the transaction in case of error
  http_response_code($e->getCode() ?: 500);
  echo json_encode(['info' => $e->getMessage()]);
}
