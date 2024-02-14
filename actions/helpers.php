<?php

session_start();

function getUserIdFromSession(): int|null
{
    return $_SESSION['user']['id'] ?? null;
}

// var_dump($_SESSION['user']['id']);
