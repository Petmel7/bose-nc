<?php
// require_once('db.php');

// $login = $_POST['login'];
// $password = $_POST['password'];
// $repeatpassword = $_POST['repeat-password'];
// $email = $_POST['email'];

// if (empty($login) || empty($password) || empty($repeatpassword) || empty($email)) {
//     echo 'Заповніть всі поля';
// } else {
//     if ($password != $repeatpassword) {
//         echo 'Паролі не співпадають';
//     } else {
//         $sql = "INSERT INTO `users` (login, password, email) VALUES ('$login', '$password', '$email')";

//         if ($conn->query($sql) === TRUE) {

//             session_start();
//             $_SESSION['user'] = $login;
//             header("Location: form-comm.php");
//             exit();
//         } else {
//             echo 'Помилка' . $conn->error;
//         }
//     }
// }



// require_once('db.php');

// $login = $_POST['login'];
// $password = $_POST['password'];
// $repeatpassword = $_POST['repeat-password'];
// $email = $_POST['email'];

// if (empty($login) || empty($password) || empty($repeatpassword) || empty($email)) {
//     echo 'Заповніть всі поля';
// } else {
//     if ($password != $repeatpassword) {
//         echo 'Паролі не співпадають';
//     } else {
//         $sql = "INSERT INTO `users` (login, password, email) VALUES ('$login', '$password', '$email')";

//         if ($conn->query($sql) === TRUE) {

//             if ($result->num_rows > 0) {
//                 while ($row = $result->fetch_assoc()) {
//                     echo 'Вітаємо, ви успішно зареєструвались: ' . $row['login'];

//                     session_start();
//                     $_SESSION['user'] = [
//                         'id' => $row['id'],
//                         'login' => $row['login']
//                     ];
//                     header("Location: form-comm.php");
//                     exit();
//                 }
//             }
//         } else {
//             echo 'Помилка' . $conn->error;
//         }
//     }
// }



require_once('db.php');

$login = $_POST['login'];
$password = $_POST['password'];
$repeatpassword = $_POST['repeat-password'];
$email = $_POST['email'];

if (empty($login) || empty($password) || empty($repeatpassword) || empty($email)) {
    echo 'Заповніть всі поля';
} else {
    if ($password != $repeatpassword) {
        echo 'Паролі не співпадають';
    } else {
        // Підготовка запиту з параметрами для безпеки
        $stmt = $conn->prepare("INSERT INTO `users` (login, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $login, $password, $email);

        if ($stmt->execute()) {
            echo 'Вітаємо, ви успішно зареєструвались: ' . $login;

            session_start();
            $_SESSION['user'] = [
                'id' => $conn->insert_id, // Отримання ID останньої вставленої записи
                'login' => $login
            ];
            header("Location: form-comm.php");
            exit();
        } else {
            echo 'Помилка' . $conn->error;
        }
    }
}
