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
//PROSTO
$query = "SELECT * FROM `users`";
$result = mysqli_query($link, $query);
//CHATS
$query = "SELECT * FROM `chats`";
$letters = mysqli_query($link, $query);
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
    <title>Chat</title>
</head>
<body>
<div class="add_form">
    <form action="chat/scripts/addchat.php" method="post" id="addChat">
        <label for="realnamechat"> Имя группы</label>
        <input type="text" name="name_chat" id="realnamechat">
        <?php while ($all = mysqli_fetch_row($result)) {
            if ($all[1] != $_SESSION['user']) {
                echo "              
              <div>
                <input type=\"checkbox\" name=\"usersadd[]\" value=\"$all[1]\" id=\"$all[0]\"/>
                <label for=\"$all[0]\">$all[1]</label></div>";
            }

        } ?>
        <button type="submit">Создать</button>
    </form>
</div>
<main>
    <div class="menu_user">
        <ul>
            <li><a href="">
                    <div class="window_user" <?php if (is_null($row[4])): ?>
                        style="background-image: url('https://images.wallpaperscraft.ru/image/lico_usy_volosy_66202_1920x1080.jpg');"
                    <?php else: ?>
                        style="background-image: url(<?php echo $row[4]; ?>);"
                    <?php endif; ?>

                    ></div>
                    <?php echo "<div value=\"$row[0]\">$row[1]</div>" ?>
                </a>
            </li>
            <!--            <li><i class="fas fa-comments"></i>Chats</li>-->
            <li><a id="add_chat"><i class="fas fa-plus"></i> Add Chat</a></li>
            <li><a href="chat/scripts/logout.php"><i class="fas fa-sign-out-alt"></i><span>Log out</span></a></li>
        </ul>
    </div>
</main>
<section>
    <div class="num_chats">
        <ul id="chats">
            <?php
            $a = 0;
            while ($lett = mysqli_fetch_assoc($letters)) {
                $arr = json_decode($lett['num-users']);
                if ($lett['createuser'] === $_SESSION['user'] or in_array($_SESSION['user'], $arr)) {
                    $a += 1;
                    echo "
        <li><a href='reallychat.php?id={$lett['id']}'><p>{$lett['nametable']}</p></a></li>
        ";
                }
            }
            if ($a === 0) {
                echo 'У вас не чатов хочешь создать?';
            }
            ?>
        </ul>
    </div>
</section>


<script src="scripts/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="chat/scripts/addchat.js"></script>
<script src="chat/scripts/newfile.js"></script>
</body>
</html>