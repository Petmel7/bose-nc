<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "../../componets/head.php"; ?>

<body>

    <section class="container">
        <div class="form-signin" data-id="signin">
            <form class="form-signin__form" id="signinForm" action="signin.php" method="post">
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Login" name="login">
                </label>
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Password" name="password">
                </label>
                <button class="signin-button form-button" type="submit">Sign In</button>

                <p class="form-signin__account">I don't have an <a href="index.php?page=signup">account</a> yet</p>
            </form>
        </div>
    </section>

</body>

</html>