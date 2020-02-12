<?php
include_once 'conf.php';
session_start();

$username = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];
$erros=[
    ["username"=>"",
    "email"=>"",
    "password"=>"",]
];
if (empty($username) and trim($username) == '') {
    $erros[0]["username"]="Пустое поле";
} else {

    $query="SELECT * FROM `users`   WHERE username ='$username'";
    $result=mysqli_query($link,$query);
    $row = mysqli_fetch_row($result);
    if($row[0] > 0){
        $erros[0]["username"]="Такой пользователь есть";
    }
}

if (empty($email) and trim($email) == '') {
    $erros[0]["email"]="Пустое поле";
} else {
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)){
        $query="SELECT * FROM `users` WHERE email ='$email'";
        $result=mysqli_query($link,$query);
        $row = mysqli_fetch_row($result);
        if($row[0] > 0){
            $erros[0]["email"]="Такой email есть";
        }
    }else{
        $erros[0]["email"]="Неправельный email";
    }

}

if (empty($pass) and trim($pass) == '') {
    $erros[0]["password"]="Пустое поле";
} else if (strlen($pass)<6 or strlen($pass)>30){
        $erros[0]["password"]="Пароль должен быть больше 6 символови меньше 30";
}

if ( $erros[0]['username']==='' and $erros[0]['email']==='' and $erros[0]['password']===''){
    $pass=password_hash($pass,PASSWORD_DEFAULT);
    $query="INSERT INTO users (username, email, password)VALUES ('$username', '$email', '$pass')";
    mysqli_query($link,$query);
    $_SESSION['user']=$username;
    $_SESSION['email']=$email;
}
echo json_encode($erros);
?>
