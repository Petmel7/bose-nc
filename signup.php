<?php
require_once('db.php');

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
        $sql = "INSERT INTO `users` (login, password, email) VALUES ('$login', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {

            session_start();
            $_SESSION['user'] = $login;
            header("Location: form-comm.php");
            exit();
        } else {
            echo 'Помилка' . $conn->error;
        }
    }
}
