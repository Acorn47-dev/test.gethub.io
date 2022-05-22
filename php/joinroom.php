<?php
$id = $_POST['yesjoin'];
$myid = $_COOKIE['id'];
$mylogin=$_COOKIE['login'];
$userid = array();
$userlogin = array();

if(!isset($_COOKIE['id'])){
    Header("Location: /index.php");
    exit();
}

$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'room-bd');
$mysqlusers = new mysqli('127.0.0.1:8889', 'root', 'root', 'register-bd');

$result=$mysql->query("SELECT * FROM room WHERE id= '$id'");
$check = $result->fetch_assoc();
$users =$check['users'];
$bet =$check['bet'];
$limitation =$check['limitation'];

$result=$mysqlusers->query("SELECT * FROM users WHERE id= '$myid'");
$check = $result->fetch_assoc();
$balance=$check['balance'];

if($users>=$limitation){
    $roomkick=true;
      header('Location: /php/home.php');
      exit();
  }else{
      $users=$users+1;
      $mysql->query("UPDATE room SET users = $users WHERE `id` = '$id'");
  }
if($balance<$bet){
    $roomkick=true;
    header('Location: /php/home.php');
    exit();
}else{
    $balance=$balance-$bet;
    $mysql->query("UPDATE users SET balance = $balance WHERE `id` = '$myid'");
}


$mysql->query("INSERT INTO `inroom` (`idroom`, `login`, `iduser`)
VALUES('$id','$mylogin', '$myid')");


// $limitationcopy =$limitation-1;
// if($users>=$limitationcopy){
// $result=$mysql->query("SELECT * FROM `inroom` WHERE `idroom` = '$id' ORDER BY RAND() LIMIT 1 ");
// $check = $result->fetch_assoc();
// $idroom=$check['idroom'];
// $iduser=$check['iduser'];
// $login=$check['login'];
// $mysql->query("INSERT INTO `winners` (`idroom`, `iduser`, `loginuser`)
// VALUES('$idroom','$iduser', '$login')");
// }





Header("Location: /php/room.php?id=$id&you=player");
$mysql->close();
?>