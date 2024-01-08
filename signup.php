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
        $sql = "INSERT INTO `users` (login, password, email) VALUES ('$login', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            // Під час авторизації, після успішного входу користувача
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo 'Вітаємо, ви успішно зареєструвались: ' . $row['login'];

                    session_start();
                    $_SESSION['user'] = [
                        'id' => $row['id'],
                        'login' => $row['login']
                    ];
                    header("Location: form-comm.php");
                    exit();
                }
            }
        } else {
            echo 'Помилка' . $conn->error;
        }
    }
}
