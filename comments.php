<?php
// require_once('comm-db.php');

// $name = $_POST['name'];
// $comments = $_POST['comments'];

// if (empty($name) || empty($comment)) {
//     echo 'Введіть своє імя та напишіть коментарій';
// } else {
//     $sql = "INSERT INTO `users` (name, comment) VALUES ('$name', '$comments')";

//     if ($conn->query($sql) === TRUE) {
//         echo 'Коментар додано';
//     } else {
//         echo 'Помилка' . $conn->error;
//     }
// }


// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start(); // Почнемо сесію

require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];

        if (!empty($name) && !empty($comment)) {
            $sql = "INSERT INTO `comments` (name, comment) VALUES ('$name', '$comment')";

            if ($conn->query($sql) === TRUE) {
                echo 'Коментар додано успішно';

                // Відобразити всі коментарі
                $retrieveComments = "SELECT * FROM `comments`";
                $result = $conn->query($retrieveComments);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo 'Name: ' . $row['name'] . ' Comment: ' . $row['comment'] . '<br>';
                    }
                } else {
                    echo 'Немає жодного коментаря';
                }
            } else {
                echo 'Помилка: ' . $conn->error;
            }
        } else {
            echo 'Заповніть усі поля';
        }
    } else {
        echo 'Помилка: Не вдалося отримати дані з форми';
    }
}
