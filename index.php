<?php

// Перевірка, чи є параметр page в запиті
if (isset($_GET['page'])) {
    // Якщо page === 'signin', підключити сторінку входу
    if ($_GET['page'] === 'signin') {
        require 'php/signin-page.php';
    }
    // Якщо page === 'signup', підключити сторінку реєстрації
    elseif ($_GET['page'] === 'signup') {
        require 'php/signup-page.php';
    }
    // Якщо page не дорівнює ні 'signin', ні 'signup', підключити головну сторінку
    else {
        require './php/Hero-header.php';
        require './php/Design.php';
        require './php/Cpable.php';
        require './php/Luxury.php';
        require './php/Bose-ar.php';
        require './php/Guarantees.php';
        require './php/Brand.php';
        require './php/Reviews.php';
        require './php/FAQ.php';
        require './php/bose-nc.php';
        require './php/Bose-modal.php';
        require './php/Footer.php';
    }
}
// Якщо параметр page не встановлено, підключити головну сторінку
else {
    require './php/Hero-header.php';
    require './php/Design.php';
    require './php/Cpable.php';
    require './php/Luxury.php';
    require './php/Bose-ar.php';
    require './php/Guarantees.php';
    require './php/Brand.php';
    require './php/Reviews.php';
    require './php/FAQ.php';
    require './php/bose-nc.php';
    require './php/Bose-modal.php';
    require './php/Footer.php';
}
