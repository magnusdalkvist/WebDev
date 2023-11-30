<?php
require_once __DIR__ . '/../_.php';

try {

    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User not logged in', 401);
    }

    $user = $_SESSION['user'];

    if (!password_verify($_POST['user_old_password'], $user['user_password'])) {
        throw new Exception('Invalid old password', 400);
    }


    $db = _db();
    $q = $db->prepare('UPDATE users SET  user_password = :user_password, user_updated_at = :user_updated_at WHERE user_id = :user_id');

    $q->bindValue(':user_updated_at', time());
    $q->bindValue(':user_password', $_POST['user_password'] ? password_hash($_POST['user_password'], PASSWORD_DEFAULT) : $user['user_password']);

    $q->execute();

    if ($q->rowCount() == 0) {
        throw new Exception('No rows were updated');
    }


    // Update the $_SESSION['user'] variable with the latest user information
    $_SESSION['user'] = $user;

    echo json_encode(['message' => 'User updated successfully']);
} catch (Exception $e) {
    try {
        if (!$e->getCode() || !$e->getMessage()) {
            throw new Exception();
        }
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage()]);
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode($ex);
    }
}
