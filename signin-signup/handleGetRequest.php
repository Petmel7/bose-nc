<?php
require_once("../actions/helpers.php");

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
            $comment = array(
                'name' => $row['name'],
                'comment' => $row['comment'],
                'created_at' => $row['created_at']
            );
            $comments[] = $comment;
        }
        echo json_encode($comments);
    } else {
        echo json_encode(['message' => 'Немає коментарів']);
    }
}
