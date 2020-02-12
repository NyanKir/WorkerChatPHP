<?php

session_start();
if (isset($_SESSION['user'])) {
    header('Location: chat/menuchat.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
<div class="wrap_form">
    <div class="door">
        <div class="dor-top">
            <div class="door_content" style="display: none">
                <h2>Welcome Back</h2>
                <p>We missed you, how good that you came!</p>
            </div>
            <div class="door_content">
                <h2>How are you friend?</h2>
                <p>We are always happy to make new friends, come in!</p>
            </div>

            <button id="changedoor"><span>Sign Up</span></button>
        </div>
    </div>
<!--Регистрация-->
    <div class="wrap_content_form">
        <div class="wrap_all_form">
            <form action="scripts/singup.php" method="post" class="left_form" id="signup">
                <h1>Create Account</h1>
                <div class="inputs">
                    <input type="text" name="username" placeholder="&#xf007; Username" id="username2">
                    <label for="username2" id="username"></label>
                </div>
                <div class="inputs">
                    <input type="email" name="email" placeholder="&#xf0e0; Email" id="email2">
                    <label for="email2" id="email"></label>
                </div>
                <div class="inputs">
                   <input type="password" name="password" placeholder="&#xf084; Password" id="password2">
                    <label for="password2" id="password"></label>
                </div>

                <button type="submit" name="signupbtn">Sign Up</button>
            </form>
        </div>
<!--Вход-->
        <div class="wrap_all_form">
            <form action="scripts/signin.php" method="post" class="right_form" id="signin">
                <h1>Sign in to Kir</h1>
                <div class="inputs">
                    <input type="email" name="email" placeholder="&#xf0e0; Email" id="email1">
                    <label for="email1" id="emailsig"></label>
                </div>

                <div class="inputs">
                    <input type="password" name="password" placeholder="&#xf084; Password" id="password1">
                    <label for="password1" id="passwordsing"></label>
                </div>
                <button type="submit" name="signinbtn">Sign In</button>
            </form>
        </div>

    </div>

</div>

<script src="scripts/jquery-3.4.1.min.js"></script>
<script src="scripts/main.js"></script>
</body>
</html>
