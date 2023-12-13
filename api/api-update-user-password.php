<?php
require_once __DIR__ . '/../_.php';

try {
    if (!isset($_SESSION['user'])) {
        throw new Exception('User not logged in', 401);
    }

    _validate_user_password(); // Validate the new password

    $user = $_SESSION['user'];

    $db = _db(); // Get database connection

    // Fetch current password
    $q = $db->prepare('SELECT user_password FROM users WHERE user_id = :user_id');
    $q->bindValue(':user_id', $_SESSION['user']['user_id']);
    $q->execute();
    $current_password = $q->fetchColumn();

    if (!password_verify($_POST['user_old_password'], $current_password)) {
        throw new Exception('Old password is incorrect', 400);
    }

    // Check if new password matches the confirm password
    if ($_POST['user_password'] !== $_POST['user_confirm_password']) {
        throw new Exception('New password and confirm password do not match', 400);
    }

    // Update password
    $new_password_hashed = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
    $q = $db->prepare('UPDATE users SET user_password = :new_password, user_updated_at = :user_updated_at WHERE user_id = :user_id');
    $q->bindValue(':new_password', $new_password_hashed);
    $q->bindValue(':user_updated_at', time());
    $q->bindValue(':user_id', $_SESSION['user']['user_id']);
    $q->execute();


    // Re-fetch the user information from the database
    $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $q->bindValue(':user_id', $user['user_id']);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);

    // Update the $_SESSION['user'] variable with the latest user information
    $_SESSION['user'] = $user;

    echo json_encode(['info' => 'Password updated successfully']);
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode(['info' => $e->getMessage()]);
}
