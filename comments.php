<?php

// session_start();
// require_once('db.php');
// header('Content-Type: application/json');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     handlePostRequest();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     handleGetRequest();
// }

// function handlePostRequest()
// {
//     if (isset($_POST['name']) && isset($_POST['comment'])) {
//         $name = $_POST['name'];
//         $comment = $_POST['comment'];

//         if (!empty($name) && !empty($comment)) {
//             $sql = "INSERT INTO `comments` (name, comment) VALUES ('$name', '$comment')";

//             global $conn;
//             if ($conn->query($sql) === TRUE) {
//                 echo json_encode(['message' => 'Коментар додано успішно']);
//             } else {
//                 echo json_encode(['error' => 'Помилка: ' . $conn->error]);
//             }
//         } else {
//             echo json_encode(['error' => 'Помилка: Заповніть усі поля']);
//         }
//     } else {
//         echo json_encode(['error' => 'Помилка: Не вдалося отримати дані з форми']);
//     }
// }

// function handleGetRequest()
// {
//     global $conn;
//     $sql = "SELECT * FROM `comments`";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         $comments = array();
//         while ($row = $result->fetch_assoc()) {
//             $comment = array(
//                 'name' => $row['name'],
//                 'comment' => $row['comment'],
//                 'created_at' => $row['created_at']
//             );
//             $comments[] = $comment;
//         }
//         echo json_encode($comments);
//     } else {
//         echo json_encode(['message' => 'Немає коментарів']);
//     }
// }




// session_start();
// require_once('db.php');
// header('Content-Type: application/json');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     handlePostRequest();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     handleGetRequest();
// }

// function handlePostRequest()
// {
//     global $conn; // Оголошення $conn як глобальної
//     if (isset($_POST['name']) && isset($_POST['comment'])) {
//         $name = $_POST['name'];
//         $comment = $_POST['comment'];
//         $user = $_SESSION['user']; // Отримуємо залогіненого користувача

//         if (!empty($name) && !empty($comment) && !empty($user)) {
//             $sql = "INSERT INTO `comments` (name, comment, user_id) VALUES (?, ?, ?)";
//             $stmt = $conn->prepare($sql);
//             $stmt->bind_param("ssi", $name, $comment, $user);

//             if ($stmt->execute()) {
//                 echo json_encode(['message' => 'Коментар додано успішно']);
//             } else {
//                 echo json_encode(['error' => 'Помилка: ' . $conn->error]);
//             }
//         } else {
//             echo json_encode(['error' => 'Помилка: Заповніть усі поля або увійдіть у свій акаунт']);
//         }
//     } else {
//         echo json_encode(['error' => 'Помилка: Не вдалося отримати дані з форми']);
//     }
// }

// function handleGetRequest()
// {
//     global $conn;
//     $sql = "SELECT * FROM `comments`";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         $comments = array();
//         while ($row = $result->fetch_assoc()) {
//             $comment = array(
//                 'name' => $row['name'],
//                 'comment' => $row['comment'],
//                 'created_at' => $row['created_at']
//             );
//             $comments[] = $comment;
//         }
//         echo json_encode($comments);
//     } else {
//         echo json_encode(['message' => 'Немає коментарів']);
//     }
// }





session_start();
require_once('db.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    handleGetRequest();
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    handleDeleteRequest();
}


function handlePostRequest()
{
    global $conn;

    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $user_id = $_SESSION['user']['id']; // Отримання ID залогіненого користувача

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


function handleGetRequest()
{
    global $conn;
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

function handleDeleteRequest()
{
    global $conn;

    // Отримання ідентифікатора коментаря для видалення
    parse_str(file_get_contents("php://input"), $_DELETE);
    $commentIdToDelete = $_DELETE['comment_id']; // Припустимо, це приходить з фронтенду

    if (!empty($commentIdToDelete)) {
        $user_id = $_SESSION['user']['id']; // Отримання ID залогіненого користувача

        $sql = "DELETE FROM `comments` WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $commentIdToDelete, $user_id);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Коментар успішно видалено']);
        } else {
            echo json_encode(['error' => 'Помилка: ' . $conn->error]);
        }
    } else {
        echo json_encode(['error' => 'Помилка: Неправильний ідентифікатор коментаря']);
    }
}
