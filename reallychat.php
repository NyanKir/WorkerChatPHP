<?php
include_once 'scripts/conf.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: registration.php');
    exit();
}
//Fignya
$query = "SELECT * FROM `users` WHERE email = '" . $_SESSION['email'] . "'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
//letter
$let = explode('=', $_SERVER['REQUEST_URI']);
$query = "SELECT * FROM `letters`WHERE `table-id`={$let[1]}";
$resultletter = mysqli_query($link, $query);
//name
$query = "SELECT * FROM `chats` WHERE `id`={$let[1]}";
$tablename = mysqli_query($link, $query);
$header = mysqli_fetch_assoc($tablename);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="chat/menu.css">
    <title><?php echo $header['nametable'] ?></title>
</head>
<body>
<div class="newf">
    <form action="chat/scripts/newfile.php" method="post" id="newfile">
        <input type="file" name="namefile">
        <button type="submit">yes!</button>
    </form>
</div>
<main>
    <div class="menu_user">
        <ul>
            <li>
                    <div class="window_user" <?php if (is_null($row[4])): ?>
                        style="background-image: url('https://images.wallpaperscraft.ru/image/lico_usy_volosy_66202_1920x1080.jpg');"
                    <?php else: ?>
                        style="background-image: url(<?php echo $row[4]; ?>);"
                    <?php endif; ?>
                    ></div>
                    <?php echo "<p id='chel'>{$row[1]}</p>" ?>
            </li>
            <li><a href="chat.php"><i class="fas fa-comments"></i>Chats</a></li>
            <li><a href="chat/scripts/logout.php"><i class="fas fa-sign-out-alt"></i><span>Log out</span></a></li>
        </ul>
    </div>
</main>
<section>
    <?php
    //    Name table


    ?>
    <div class="head_otvet">
        <?php echo $header['nametable']; ?>
    </div>
    <div id="otvet">
        <?php

        $tablename = mysqli_query($link, $query);
        while ($lett = mysqli_fetch_assoc($resultletter)) {
            if ($lett['username'] === $_SESSION['user']) {
                echo "<div class=\"messangme\">
                    
            <div>
            <p class='user_text'>{$lett['word']}</p>
            <p class='user_date'>{$lett['date']}</p>
            </div>
            <h4>{$lett['username']}</h4>
                </div>";
            } else {
                echo "        <div class=\"messang\">
            <h4>{$lett['username']}</h4>
            <div>
                        <p class='user_text'>{$lett['word']}</p>
            <p class='user_date'>{$lett['date']}</p>
</div>

        </div>";
            }
        }
        ?>


    </div>
    <div id="send_dich">
        <textarea name="comment" type="text" id="seend"></textarea>
        <button id="seendme">SEND</button>
    </div>

</section>

<script src="scripts/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="chat/scripts/chat.js"></script>
<script src="chat/scripts/newfile.js"></script>
</body>
</html>