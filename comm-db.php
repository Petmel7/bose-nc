<?php
$servername = 'localhost';
$dbname = 'comments';

$conn = mysqli_connect($servername, $dbname);

if (!$conn) {
    die("Cnnection Fialed" . mysqli_connect_error());
} else {
    echo 'Успіх';
}
?>;