<?php

require_once("../actions/helpers.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest();
}

function handlePostRequest()
{
    require_once('../db.php');

    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $user_id = $_SESSION['user']['id'];

        // var_dump("post-user_id", $user_id);

        if (!empty($name) && !empty($comment) && !empty($user_id)) {
            $sql = "INSERT INTO `comments` (name, comment, user_id) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $name, $comment, $user_id);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Коментар додано успішно']);
            } else {
                echo json_encode(['error' => 'Помилка: ' . $conn->error]);
            }
        } else {
            echo json_encode(['error' => 'Помилка: Заповніть усі поля або увійдіть у свій акаунт']);
        }
    } else {
        echo json_encode(['error' => 'Помилка: Не вдалося отримати дані з форми']);
    }
}
