<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "../../componets/head.php"; ?>

<body>
    <header class="container">

        <div class="header-block">
            <div class="svg-block">
                <div class="logo">
                    <a href="#" class="logo-icon">
                        <svg class="logo-icon--svg">
                            <use href="images.svg/symbol-defs.svg#icon-bose-logo"></use>
                        </svg>
                    </a>
                </div>

                <div class="burger" onclick="toggleMenu()">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>

            </div>

            <nav class="menu">
                <div class="close-icon"></div>
                <ul class="menu-list">
                    <li class="menu-list--children">
                        <a href="#">Characteristics</a>
                    </li>
                    <li class="menu-list--children">
                        <a href="#">History</a>
                    </li>
                    <li class="menu-list--children">
                        <a href="#">Reviews</a>
                    </li>
                    <li class="menu-list--children">
                        <a href="#">Payment and delivery</a>
                    </li>
                </ul>

            </nav>

        </div>

        <section class="hero-block">
            <div>
                <p class="hero-header--text">Noise cancellation headphones that are capable for a lot of things</p>
                <p class="hero-width hero-header--text">Up to 20 hours of playback</p>
                <h1 class="hero-header--title">HEADPHONES BOSE NC 700</h1>

                <div class="general">
                    <button class="general-button" onclick="openModal()">ORDER</button>
                </div>
            </div>
            <div class="hero-header--img"></div>
        </section>
    </header>