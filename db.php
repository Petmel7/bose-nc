<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'signupuser';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Cnnection Fialed" . mysqli_connect_error());
} else {
    'Успіх';
}
