<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bose</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles/comments.css">
</head>

<body>
    <section class="container">
        <div class="form-sign" data-id="signin">
            <form id="signinForm" action="signin.php" method="post">
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Login" name="login">
                </label>
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Password" name="password">
                </label>
                <button class="sign-button form-button" type="submit">Sign In</button>
            </form>
        </div>
    </section>
</body>

</html>