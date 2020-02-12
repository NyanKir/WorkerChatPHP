<?php
include_once '../../scripts/conf.php';
session_start();


$name=$_POST['name_chat'];
$usercheck=$_POST['usersadd'];
$erros=[
    ["namechat"=>"",
        "usercheck"=>""]
];
if(empty($name))
{
    $erros[0]['username']= "Пустое поле";
}
if(empty($usercheck))
{
    $erros[0]['usercheck']="Вы не выбрали ни одного участника.";
}
else{
    $usercheck=json_encode($usercheck);
    $query=" INSERT INTO chats (`nametable`, `num-users`,`createuser`) VALUES ('{$name}','{$usercheck}','{$_SESSION['user']}')";
    if(!mysqli_query($link,$query)) {
        echo 'Error';
    }
}
echo $name;


