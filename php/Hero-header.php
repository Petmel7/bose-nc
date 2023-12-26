<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width">
    <title>bose</title>

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/Hero-header.css">
    <link rel="stylesheet" href="styles/Design.css">
    <link rel="stylesheet" href="styles/Capable.css">
    <link rel="stylesheet" href="styles/Luxury.css">
    <link rel="stylesheet" href="styles/Bose-ar.css">
    <link rel="stylesheet" href="styles/Guarantees.css">
    <link rel="stylesheet" href="styles/Brand.css">
    <link rel="stylesheet" href="styles/Reviews.css">
    <link rel="stylesheet" href="styles/FAQ.css">
    <link rel="stylesheet" href="styles/Bose-nc.css">
    <link rel="stylesheet" href="styles/Footer.css">
    <link rel="stylesheet" href="styles/bose-modal.css">
</head>

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

    </header>

    <section class="container">
        <div class="hero-block">
            <div>
                <p class="hero-header--text">Noise cancellation headphones that are capable for a lot of things</p>
                <p class="hero-width hero-header--text">Up to 20 hours of playback</p>
                <h1 class="hero-header--title">HEADPHONES BOSE NC 700</h1>

                <div class="general">
                    <button class="general-button" onclick="openModal()">ORDER</button>
                </div>
            </div>
            <div class="hero-header--img"></div>
        </div>
    </section>