<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "../../componets/head.php"; ?>

<body>
    <section class="container-comments">
        <div class="form-signin">
            <form class="form-signin__form" id="signupForm" action="signin-signup/reg-signup.php" method="post">
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Login" name="login">
                </label>
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Pasword" name="password">
                </label>
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Repeat pasword" name="repeat-password">
                </label>
                <label class="form-label" for="">
                    <input class="form-input" type="text" placeholder="Email" name="email">
                </label>
                <button class="signin-button" type="submit">Sign Up</button>

                <p class="form-signin__account">I already have an <a href="index.php?page=signin">account</a></p>
            </form>
        </div>
    </section>
</body>

</html>