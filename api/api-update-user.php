<?php
require_once __DIR__.'/../_.php';

try{
 session_start(); 

 if(!isset($_SESSION['user_id'])) {
 throw new Exception('User not logged in', 401);
 }

 $user = $_SESSION['user']; // Fetch the user object from the session

 $db = _db();
 $q = $db->prepare('UPDATE users SET user_name = :user_name, user_last_name = :user_last_name, user_email = :user_email, user_password = :user_password WHERE user_id = :user_id');

 $q->bindValue(':user_id', $user['user_id']);
 $q->bindValue(':user_name', $_POST['user_name'] ?? $user['user_name']);
 $q->bindValue(':user_last_name', $_POST['user_last_name'] ?? $user['user_last_name']);
 $q->bindValue(':user_email', $_POST['user_email'] ?? $user['user_email']);
 $q->bindValue(':user_password', $_POST['user_password'] ? password_hash($_POST['user_password'], PASSWORD_DEFAULT) : $user['user_password']);

 $q->execute();

 echo json_encode(['message' => 'User updated successfully']);
}catch(Exception $e){
 try{
 if( ! $e->getCode() || ! $e->getMessage()){ throw new Exception(); }
 http_response_code($e->getCode());
 echo json_encode(['info'=>$e->getMessage()]);
 }catch(Exception $ex){
 http_response_code(500);
 echo json_encode($ex); 
 }
}
