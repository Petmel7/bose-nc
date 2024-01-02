<?php
$servername = 'localhost';
$username = 'root';
$pass = '';
$dbname = 'signupuser';

$conn = mysqli_connect($servername, $username, $pass, $dbname);

if (!$conn) {
    die("Cnnection Fialed" . mysqli_connect_error());
} else {
    'Успіх';
}
?>;