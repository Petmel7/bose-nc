<?php
// session_start();
require_once __DIR__ . "../../actions/helpers.php";

// Перевіряємо, чи встановлена сесія користувача і чи містить вона ідентифікатор користувача
if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
    // Користувач авторизований
    $userId = $_SESSION['user']['id'];
    echo json_encode(['authenticated' => true, 'userId' => $userId]);
} else {
    // Користувач не авторизований
    echo json_encode(['authenticated' => false]);
}
// var_dump($userId);
