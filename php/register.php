<?php 
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];

//ВЕРНУТЬ!!!!!!!!!!!!!
// if(mb_strlen($login)<5 || mb_strlen($login) >15){
//     $autherror=true;
//     header('Location: /index.php?get=$get');
//     exit;
// }
// if(mb_strlen($password)<5 || mb_strlen($password) >20){
//     $autherror=true;
//     header('Location: /index.php?get=$get');
//     exit;
// }
// if(mb_strlen($email)<10 || mb_strlen($email) >30){
//     $autherror=true;
//     header('Location: /index.php?get=$get');
//     exit;
// }


$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'register-bd');
$mysql->query("INSERT INTO `users` (`login`, `password`, `email`)
VALUES('$login', '$password', '$email')");
$mysql->close();


?>