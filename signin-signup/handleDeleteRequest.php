<?php
require_once("../actions/helpers.php");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    handleDeleteRequest();
}

function handleDeleteRequest()
{
    require_once('../db.php');

    $data = json_decode(file_get_contents("php://input"), true);

    $commentId = $data['comment_id'] ?? null;
    $user_id = $_SESSION['user']['id'] ?? null;

    var_dump("user_id", $user_id);

    if (!empty($commentId) || (!empty($user_id))) {
        $sql = "DELETE FROM `comments` WHERE comment_id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $commentId, $user_id);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Коментар успішно видалено']);
        } else {
            echo json_encode(['error' => 'Помилка: ' . $conn->error]);
        }
    } else {
        echo json_encode(['error' => 'Помилка: Неправильний ідентифікатор коментаря']);
    }
}
