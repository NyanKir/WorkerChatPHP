<?php
include_once '../scripts/conf.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../registration.php');
    exit();
}
$query = "SELECT * FROM `users` WHERE email = '" . $_SESSION['email'] . "'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="menu.css">
    <title>Document</title>
</head>
<body>
<main>
    <div class="menu_user">
        <ul>
            <li><a href=<?php echo "profile.php?id=" . $row[0]; ?>>
                    <div class="window_user" <?php if (is_null($row[4])): ?>
                        style="background-image: url('https://images.wallpaperscraft.ru/image/lico_usy_volosy_66202_1920x1080.jpg');"
                    <?php else: ?>
                        style="background-image: url(<?php echo $row[4]; ?>);"
                    <?php endif; ?>
                    ></div>
                    <?php echo $row[1] ?>
                </a>

            </li>
            <li><a href="../chat.php"><i class="fas fa-comments"></i>Chats</a></li>
            <li><a href="scripts/logout.php"><i class="fas fa-sign-out-alt"></i><span>Log out</span></a></li>
        </ul>
    </div>
</main>
<section></section>
<script src="scripts/jquery-3.4.1.min.js"></script>
<script src="chat/scripts/newfile.js"></script>
</body>
</html>