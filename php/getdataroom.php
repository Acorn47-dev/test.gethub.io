
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
$mysqluser = new mysqli('127.0.0.1:8889', 'root', 'root', 'register-bd');


$result=$mysql->query("SELECT * FROM room WHERE id= '$id'");
$check = $result->fetch_assoc();
$users =$check['users'];
$limitation =$check['limitation'];

$result=$mysqluser->query("SELECT * FROM users WHERE id= '$myid'");
$check = $result->fetch_assoc();
$balance =$check['balance'];
// $limitationcopy =$limitation-1;
// if($result>=$limitationcopy){
// $result=$mysql->query("SELECT * FROM `inroom` WHERE `idroom` = '$id' ORDER BY RAND() LIMIT 1 ");
// $check = $result->fetch_assoc();
// $idroom=$check['idroom'];
// $iduser=$check['iduser'];
// $login=$check['login'];
// $mysql->query("INSERT INTO `winners` (`idroom`, `iduser`, `loginuser`)
// VALUES('$idroom','$iduser', '$login')");
// }

$result=$mysql->query("SELECT * FROM inroom WHERE idroom= '$id'");
while($check = $result->fetch_assoc())
{
    $userid[] = $check['iduser'];
    $userlogin[] = $check['login'];
}





$response[0]=$userid;
$response[1]=$userlogin;
$response[2]=$id;
$response[3]=$limitation;
$response[4]=$balance;
echo json_encode($response);
$mysql->close();
?>