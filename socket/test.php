<?php
$users=array();
$users[10]=[];
if (isset($users[10])){
    echo 'ok';
}
array_push($users[10],1);
array_push($users['10'],1);
array_push($users['10'],1);
array_push($users['10'],1);
array_push($users['10'],1);
var_dump($users);