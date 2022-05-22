<?php

if(!isset($_COOKIE['id'])){
    Header("Location: /index.php");
    exit();
}

$typeroom=$_POST['oneMostCheck'];
if($typeroom==1){
    $limitation=$_POST['limitation'];
}else{
    $limitation=2;
}
$bet=$_POST['bet'];
$win = $bet*$limitation;
echo $typeroom, $bet, $limitation;
$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'room-bd');
$mysql->query("INSERT INTO `room` (`type`, `bet`, `limitation`, `win`)
VALUES('$typeroom', '$bet', '$limitation', '$win')");
$mysql->close();
header('Location: /php/home.php')
?>