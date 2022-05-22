<?php 
$login = $_POST['login'];
$password = $_POST['password'];

$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'register-bd');
$result=$mysql->query("SELECT * FROM users WHERE login= '$login' AND password = '$password'");
$check = $result->fetch_assoc();
$autherror=false;
if($check==0){
    $autherror=false;
    exit();
}

if($autherror==false){
    setcookie("login",$check['login'], time()+3600,"/");
    setcookie("id",$check['id'], time()+3600,"/");
    $autherror=true;
}

$mysql->close();
echo $autherror;
?>