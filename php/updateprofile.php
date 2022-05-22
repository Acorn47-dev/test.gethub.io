<?php 
$login = $_COOKIE['login'];
$id = $_COOKIE['id'];

if(!isset($_COOKIE['id'])){
    Header("Location: /index.php");
    exit();
}

$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'register-bd');
$mysqlroom = new mysqli('127.0.0.1:8889', 'root', 'root', 'room-bd');
$resultt=$mysql->query("SELECT * FROM users WHERE id= '$id' AND login = '$login'");
$checkk = $resultt->fetch_assoc();

$result=$mysqlroom->query("SELECT * FROM inroom WHERE iduser= '$id' AND login = '$login'");
$check = $result->fetch_assoc();
$idroom=null;
if($check==0){
    $idroom=$check['idroom'];
}

$response[0]=$checkk['balance'];
$response[1]=$checkk['lastgame'];
$response[2]=$checkk['lastbet'];
$response[3]=$check['idroom'];
echo json_encode($response);
$mysql->close();
?>