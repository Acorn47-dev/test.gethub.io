<?php
$id=$_POST['id'];
$myid = $_COOKIE['id'];
$mylogin=$_COOKIE['login'];
$userid = array();
$userlogin = array();

if(!isset($_COOKIE['id'])){
    Header("Location: /index.php");
    exit();
}

$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'room-bd');


$result=$mysql->query("SELECT * FROM room WHERE id= '$id'");
$check = $result->fetch_assoc();
$limitation =$check['limitation'];
$win =$check['win'];
$limitationcopy =$limitation-1;
$result=$mysql->query("SELECT * FROM inroom WHERE idroom= '$id' ORDER BY RAND() LIMIT 1");
$check = $result->fetch_assoc();
$idwin=$check['iduser'];
$loginwin=$check['login'];
$mysql->query("INSERT INTO `winners` (`idroom`, `id`,`login`,`win`)
VALUES('$id','$idwin','$loginwin' ,'$win')");
$result=$mysql->query("SELECT * FROM winners WHERE idroom= '$id'");
$check = $result->fetch_assoc();

$response[0]=$check['id'];
$response[1]=$check['login'];
echo json_encode($response);


$mysql->close();
?>