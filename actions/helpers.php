<?php

session_start();

function signinUserId($row)
{
    $_SESSION['user'] = [
        'id' => $row['id'],
        'login' => $row['login']
    ];
}
