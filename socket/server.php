<?php
require_once  '../vendor/autoload.php';
use Workerman\Worker;
$db = new Workerman\MySQL\Connection('localhost', '3306', 'root', '', 'messenger');

// Create a Websocket server
$ws_worker = new Worker("websocket://localhost:8008");

// 4 processes
$ws_worker->count = 4;
// Emitted when new connection come
$ws_worker->onConnect = function($connection)
{
    $connection->onWebSocketConnect = function($connection) use (&$ws_worker)
    {
//        $users[$_GET['id']]=$connection;

        $connection->some_var = $_GET['id'];
        var_dump($connection->some_var);
        echo "New connection\n";
    };

};

// Emitted when data received
$ws_worker->onMessage = function($connection, $data) use ($ws_worker,$db)
{
    var_dump($connection->some_var);
    $data=json_decode($data,true);
    var_dump($data);
    $insert_id = $db->query("INSERT INTO `letters` ( `username`,`word`,`table-id`) VALUES ( '{$data['from']}', '{$data['text']}', '{$data['tableid']}')");
    foreach ($ws_worker->connections as $con){
        if($con->some_var===$data['tableid']) {
            $con->send(json_encode($data));
        }
    }

//    $connection->send($data);
};

$ws_worker->onClose = function($connection)
{
    echo "Connection closed\n";
};

// Run worker
Worker::runAll();