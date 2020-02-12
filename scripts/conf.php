<?php
    $link = mysqli_connect('localhost', 'root', '', 'messenger')
    or die("Ошибка " . mysqli_error($link));
    mysqli_set_charset($link, 'utf8');
?>