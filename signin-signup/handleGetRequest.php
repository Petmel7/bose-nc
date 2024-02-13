<?php
require_once __DIR__ . "../../actions/helpers.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    handleGetRequest();
}

function handleGetRequest()
{
    require_once('../db.php');

    $sql = "SELECT * FROM `comments`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $comments = array();
        while ($row = $result->fetch_assoc()) {
            $authorized = $_SESSION['user']['id'] == $row['user_id'];

            $comment = array(
                'comment_id' => $row['comment_id'],
                'name' => $row['name'],
                'comment' => $row['comment'],
                'created_at' => $row['created_at'],
                'authorized' => $authorized
            );
            $comments[] = $comment;
        }
        echo json_encode($comments);
    } else {
        echo json_encode(['message' => 'Немає коментарів']);
    }
}
