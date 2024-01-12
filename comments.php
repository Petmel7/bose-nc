<?php

require_once('db.php');

session_start();

require_once 'vendor/autoload.php';

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

// Create the logger
$logger = new Logger('comments_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/comments.log', Level::Debug));
$logger->pushHandler(new FirePHPHandler());


// require_once('db.php');

// session_start();

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
    global $conn, $logger;

    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $user_id = $_SESSION['user']['id']; // Отримання ID залогіненого користувача

        $logger->info('$user_id_post: ' . $user_id);

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

// function handleDeleteRequest()
// {
//     global $conn, $logger;

//     // Перевірка, чи користувач залогінений
//     if (!isset($_SESSION['user'])) {
//         echo json_encode(['error' => 'Користувач не авторизований']);
//         return;
//     }

//     $data = json_decode(file_get_contents("php://input"), true);

//     // Перевірка наявності ідентифікатора коментаря
//     if (!isset($data['comment_id'])) {
//         echo json_encode(['error' => 'Неправильний запит. Не вдалося отримати ідентифікатор коментаря']);
//         return;
//     }

//     $commentId = $data['comment_id'] ?? null; // Припустимо, це приходить з фронтенду
//     $user_id = $_SESSION['user']['id'] ?? null; // Отримання ID залогіненого користувача

//     $logger->info('$commentId: ' . $commentId);
//     $logger->info('$user_id: ' . $user_id);

//     if (!empty($commentId) && !empty($user_id)) {
//         $sql = "DELETE FROM `comments` WHERE comment_id = ? AND user_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("ii", $commentId, $user_id);

//         $logger->info('$commentId' . json_encode($commentId));
//         $logger->info('$user_id' . json_encode($user_id));

//         if ($stmt->execute()) {
//             echo json_encode(['message' => 'Коментар успішно видалено']);
//         } else {
//             echo json_encode(['error' => 'Помилка: ' . $conn->error]);
//         }
//     } else {
//         echo json_encode(['error' => 'Помилка: Неправильний ідентифікатор коментаря або користувач не авторизований']);
//     }
// }


// function handleDeleteRequest()
// {
//     global $conn, $logger;

//     // Перевірка, чи користувач залогінений
//     // if (!isset($_SESSION['user'])) {
//     //     echo json_encode(['error' => 'Користувач не авторизований']);
//     //     return;
//     // }

//     $data = json_decode(file_get_contents("php://input"), true);

//     // Перевірка наявності ідентифікатора коментаря
//     if (!isset($data['comment_id'])) {
//         echo json_encode(['error' => 'Неправильний запит. Не вдалося отримати ідентифікатор коментаря']);
//         return;
//     }

//     $commentId = $data['comment_id'] ?? null; // Припустимо, це приходить з фронтенду

//     $logger->info('$commentId: ' . $commentId);

//     if (!empty($commentId)) {
//         $sql = "DELETE FROM `comments` WHERE comment_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("i", $commentId);

//         $logger->info('$commentId' . json_encode($commentId));

//         if ($stmt->execute()) {
//             echo json_encode(['message' => 'Коментар успішно видалено']);
//         } else {
//             echo json_encode(['error' => 'Помилка: ' . $conn->error]);
//         }
//     } else {
//         echo json_encode(['error' => 'Помилка: Неправильний ідентифікатор коментаря']);
//     }
// }



function handleDeleteRequest()
{
    global $conn, $logger;

    // if (isset($_SESSION['user']['id'])) {
    //     $user_id = $_SESSION['user']['id'];
    //     echo json_encode(['error' => 'Ви авторизовані']);
    // } else if ((!isset($_SESSION['user']['id']))) {
    //     echo json_encode(['error' => 'Ви не авторизовані']);
    //     return;
    // }

    $data = json_decode(file_get_contents("php://input"), true);

    // Отримання ID користувача з сесії

    $commentId = $data['comment_id'] ?? null;
    $user_id = $_SESSION['user']['id'] ?? null;

    $logger->info('$commentId_delete: ' . $commentId);
    $logger->info('$user_id_delete: ' . $user_id);

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
