
<?php
session_start();

require_once('db.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];

        if (!empty($name) && !empty($comment)) {
            $sql = "INSERT INTO `comments` (name, comment) VALUES ('$name', '$comment')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(['message' => 'Коментар додано успішно']);
            } else {
                echo json_encode(['error' => 'Помилка: ' . $conn->error]);
            }
        } else {
            echo json_encode(['error' => 'Помилка: Заповніть усі поля']);
        }
    } else {
        echo json_encode(['error' => 'Помилка: Не вдалося отримати дані з форми']);
    }
}
?>
