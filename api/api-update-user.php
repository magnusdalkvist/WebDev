<?php
require_once __DIR__ . '/../_.php';

try {

    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User not logged in', 401);
    }

    if (_is_admin()) {
        $db = _db();
        $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $q->bindValue(':user_id', $_POST['user_id']);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);
    } else {
        $user = $_SESSION['user'];
    }



    $db = _db();
    $q = $db->prepare('UPDATE users SET user_name = :user_name, user_last_name = :user_last_name, user_email = :user_email, user_address = :user_address, user_tag_color = :user_tag_color,  user_updated_at = :user_updated_at WHERE user_id = :user_id');

    $q->bindValue(':user_id', $_POST['user_id']);
    $q->bindValue(':user_name', $_POST['user_name'] ??  $user['user_name']);
    $q->bindValue(':user_last_name', $_POST['user_last_name'] ?? $user['user_last_name']);
    $q->bindValue(':user_email', $_POST['user_email'] ?? $user['user_email']);
    $q->bindValue(':user_address', $_POST['user_address'] ?? $user['user_address']);
    $q->bindValue(':user_tag_color', $_POST['user_tag_color'] ?? $user['user_tag_color'] ?? '#000000');
    $q->bindValue(':user_updated_at', time());
    $q->execute();

    if ($q->rowCount() == 0) {
        throw new Exception('No rows were updated');
    }

    // Re-fetch the user information from the database
    // Update the $_SESSION['user'] variable with the latest user information
    if (!_is_admin() || $_SESSION['user_id'] == $user['user_id']) {
        $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $q->bindValue(':user_id', $_SESSION['user_id']);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
    }



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
