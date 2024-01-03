<?php
require_once('comm-db.php');

$name = $_POST['name'];
$comments = $_POST['comments'];

if (empty($name) || empty($comment)) {
    echo 'Введіть своє імя та напишіть коментарій';
} else {
    $sql = "INSERT INTO `users` (name, comment) VALUES ('$name', '$comments')";

    if ($conn->query($sql) === TRUE) {
        echo 'Коментар додано';
    } else {
        echo 'Помилка' . $conn->error;
    }
}
