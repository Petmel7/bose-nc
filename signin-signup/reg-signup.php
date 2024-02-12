<?php

require_once('../db.php');

$login = $_POST['login'];
$password = $_POST['password'];
$repeatpassword = $_POST['repeat-password'];
$email = $_POST['email'];

if (empty($login) || empty($password) || empty($repeatpassword) || empty($email)) {
    echo 'Заповніть всі поля';
} else {
    if ($password != $repeatpassword) {
        echo 'Паролі не співпадають';
    } else {
        // Підготовка запиту з параметрами для безпеки
        $stmt = $conn->prepare("INSERT INTO `users` (login, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $login, $password, $email);

        if ($stmt->execute()) {
            echo 'Вітаємо, ви успішно зареєструвались: ' . $login;

            session_start();
            $_SESSION['user'] = [
                'id' => $conn->insert_id, // Отримання ID останньої вставленої записи
                'login' => $login
            ];
            header("Location: /bose-nc/index.php?page=signin");
            exit();
        } else {
            echo 'Помилка' . $conn->error;
        }
    }
}
