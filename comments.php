<?php

require_once 'vendor/autoload.php'; // Підключення автозавантажувача Composer

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

// Create the logger
$logger = new Logger('comments_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/comments.log', Level::Debug));
$logger->pushHandler(new FirePHPHandler());


session_start();
require_once('db.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    handleGetRequest();
}

// if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
//     handleDeleteRequest($commentId);
// }

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    handleDeleteRequest();
}


function handlePostRequest()
{
    global $conn, $logger;

    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $user_id = $_SESSION['user']['id']; // Отримання ID залогіненого користувача

        // $logger->info('Received a DELETE request for comment with ID: ' . $user_id);

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
    global $conn, $logger;

    $data = json_decode(file_get_contents("php://input"), true);

    $commentId = $data['comment_id'] ?? null; // Припустимо, це приходить з фронтенду
    // $logger->info('Received a DELETE request for comment with ID: ' . $commentId);

    if (!empty($commentId)) {
        $user_id = $_SESSION['user']['id']; // Отримання ID залогіненого користувача

        $sql = "DELETE FROM `comments` WHERE id = ? AND user_id = ?";
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

// $logger->info('Received a DELETE request for comment with ID: ' . print_r($_DELETE, true));
// $logger->info('Received a DELETE request for comment with ID: ' . print_r($_REQUEST, true));






// function handleDeleteRequest($commentId)
// {
//     global $conn, $logger;

//     // Отримання ідентифікатора коментаря для видалення
//     parse_str(file_get_contents("php://input"), $_DELETE);
//     $commentId = $_DELETE['comment_id']; // Припустимо, це приходить з фронтенду

//     // $logger->info('Received a DELETE request for comment with ID: ' . $commentId);

//     if (!empty($commentId)) {
//         $user_id = $_SESSION['user']['id']; // Отримання ID залогіненого користувача

//         $sql = "DELETE FROM `comments` WHERE id = ? AND user_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("ii", $commentId, $user_id);

//         if ($stmt->execute()) {
//             echo json_encode(['message' => 'Коментар успішно видалено']);
//         } else {
//             echo json_encode(['error' => 'Помилка: ' . $conn->error]);
//         }
//     } else {
//         echo json_encode(['error' => 'Помилка: Неправильний ідентифікатор коментаря']);
//     }
// }



// function handleDeleteRequest()
// {
//     global $conn, $logger;

//     // Отримання ідентифікатора коментаря для видалення
//     parse_str(file_get_contents("php://input"), $_DELETE);
//     $commentIdToDelete = $_DELETE['comment_id']; // Припустимо, це приходить з фронтенду

//     if (!empty($commentIdToDelete)) {

//         $user_id = $_SESSION['user']['id']; // Отримання ID залогіненого користувача

//         $sql = "DELETE FROM `comments` WHERE id = ? AND user_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("ii", $commentIdToDelete, $user_id);

//         if ($stmt->execute()) {
//             echo json_encode(['message' => 'Коментар успішно видалено']);
//         } else {
//             echo json_encode(['error' => 'Помилка: ' . $conn->error]);
//         }
//     } else {
//         echo json_encode(['error' => 'Помилка: Неправильний ідентифікатор коментаря']);
//     }
// }









// function deleteComment($commentId)
// {
//     // Підключення до бази даних (замість db_connect використайте свою функцію підключення)
//     global $conn; // Приклад, якщо у вас є функція підключення db_connect()

//     // Підготовка запиту для видалення коментаря за його ID
//     $sql = "DELETE FROM comments WHERE comment_id = ?";

//     // Підготовка та виконання запиту
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("i", $commentId); // "i" - тип даних (ціле число)

//     if ($stmt->execute()) {
//         // Успішно видалено
//         echo "Коментар успішно видалено";
//     } else {
//         // Помилка під час видалення
//         echo "Помилка під час видалення коментаря: " . $conn->error;
//     }

//     // Закриття підготовленого запиту та з'єднання з базою даних
//     $stmt->close();
//     $conn->close();
// }

// // Виклик функції deleteComment з переданим ID коментаря для видалення
// $commentIdToDelete = $_POST['comment_id']; // Припустимо, що ID коментаря приходить через POST-запит
// deleteComment($commentIdToDelete);
