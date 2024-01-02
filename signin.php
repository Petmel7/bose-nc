
<?php
require_once('db.php');

$login = $_POST['login'];
$password = $_POST['password'];

if (empty($login) || empty($password)) {
    echo 'Заповніть всі поля';
} else {
    // Використовуємо підготовлений запит для безпеки
    $sql = "SELECT * FROM `users` WHERE login = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Прив'язуємо параметри
    $stmt->bind_param("ss", $login, $password);

    // Виконуємо запит
    $stmt->execute();

    // Отримуємо результат
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