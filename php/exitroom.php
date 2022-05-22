<?php
session_start();

if(!isset($_COOKIE['id'])){
    Header("Location: /index.php");
    exit();
}
$id = $_POST['exitbuttonroom'];
$myid = $_COOKIE['id'];
$login = $_COOKIE['login'];


$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'room-bd');
$mysqlmoney = new mysqli('127.0.0.1:8889', 'root', 'root', 'register-bd');
$mysqlhistory = new mysqli('127.0.0.1:8889', 'root', 'root', 'history-bd');
$mysql->query("DELETE FROM inroom WHERE idroom= '$id' AND iduser= '$myid'");

$result=$mysql->query("SELECT * FROM room WHERE id= '$id'");
$check = $result->fetch_assoc();
$users =$check['users'];
$bet =$check['bet'];
$win =$check['win'];
if($users>0){
    $users=$users-1;
    $mysql->query("UPDATE room SET users = $users WHERE `id` = '$id'");
}
$result= $mysql->query("SELECT * FROM winners WHERE idroom= '$id'");
$check = $result->fetch_assoc();
$idwinner=$check['id'];
$mysqlmoney->query("UPDATE users SET lastbet = $bet WHERE `id` = '$myid'");
$resultgame=0;
if($myid!=$idwinner){
    $mysqlmoney->query("UPDATE users SET lastgame = 0 WHERE `id` = '$myid'");
    $resultgame=0;
}else{
    $mysqlmoney->query("UPDATE users SET lastgame = 1 WHERE `id` = '$myid'");
    $resultgame=1;
}

$date=strftime("%A %d %B %Y");
$mysqlhistory->query("INSERT INTO `history` (`id`, `login`, `data`, `bet`, `result`)
VALUES('$myid', '$login', '$date','$bet', '$resultgame')");
if($users<1){

    

    $result= $mysqlmoney->query("SELECT * FROM users WHERE id= '$idwinner'");

$check = $result->fetch_assoc();
$balance= $check['balance'];
$balance=$balance+$win;
$mysqlmoney->query("UPDATE users SET balance = $balance WHERE `id` = '$idwinner'");
$mysql->query("DELETE FROM inroom WHERE idroom= '$id'");
$mysql->query("DELETE FROM room WHERE id= '$id'");
$mysql->query("DELETE FROM winners WHERE idroom= '$id'");
}




 header('Location: /php/home.php');
$mysql->close();
?>