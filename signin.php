
<?php
require_once('db.php');

$login = $_POST['login'];
$password = $_POST['password'];

if (empty($login) || empty($password)) {
    echo 'Заповніть всі поля';
} else {
    $sql = "SELECT * FROM `users` WHERE login = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $login, $password);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo 'Вітаємо, ви успішно увійшли в свій акаунт: ' . $row['login'];
        }
    } else {
        echo 'Немає такого користувача';
    }
}
?>