<?php
include_once 'conf.php';
session_start();

$email = $_POST['email'];
$pass = $_POST['password'];
$erros = [
    ["email" => "",
        "password" => "",]
];

if (empty($email) and trim($email) == '') {
    $erros[0]["email"] = "Пустое поле";
} else {
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
        $query = "SELECT * FROM `users`  WHERE  email ='$email'";
        $res=mysqli_query($link,$query);
        $row = mysqli_fetch_row($res);
        $erros[0]["email"] = '';
        if (!$row[0]>0) {
            $erros[0]["email"] = 'Такого пользователя не существует';
        }
    } else {
        $erros[0]["email"] = "Неправельный введеный email";
    }

}


if (empty($pass) and trim($pass) == '') {
    $erros[0]["password"]="Пустое поле";
} else if (!password_verify($pass,$row[3])) {
    $erros[0]["password"] = "Неправельный пароль";
}
if ($erros[0]["email"]=="" and $erros[0]["password"]==""){
    $_SESSION['user']=$row[1];
    $_SESSION['email']=$row[2];
}
echo json_encode($erros);
?>
