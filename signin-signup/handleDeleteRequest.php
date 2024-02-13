<?php
require_once __DIR__ . "../../actions/helpers.php";

require_once('../db.php');

$data = json_decode(file_get_contents("php://input"), true);

$commentId = $data['comment_id'] ?? null;
$userId = $data['user_id'] ?? null;

if (!empty($commentId) && !empty($userId)) {
    $sql = "DELETE FROM `comments` WHERE comment_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $commentId, $userId);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Коментар успішно видалено']);
    } else {
        echo json_encode(['error' => 'Помилка: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Помилка: Неправильний ідентифікатор коментаря або користувача']);
}
