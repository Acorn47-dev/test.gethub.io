<?php 
session_start();

if(!isset($_COOKIE['id'])){
    Header("Location: /index.php");
    exit();
}
$id = array();
$type = array();
$bet = array();
$limitation = array();
$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'room-bd');
$result=$mysql->query("SELECT * FROM room");
while($row = $result->fetch_array())
{
    
    $id[] = $row['id'];
    $type[] = $row['type'];
    $bet[] = $row['bet'];
    $limitation[] = $row['limitation'];
    $users[] = $row['users'];
    $win[] = $row['win'];
    


}




    $response[0]=$id;
    $response[1]=$type;
    $response[2]=$bet;
    $response[3]=$limitation;
    $response[4]=$users;
    $response[5]=$win;
    echo json_encode($response);

    //     $_SESSION['id']=$id;
    // $_SESSION['type']=$type;
    // $_SESSION['bet']= $bet;
    // $_SESSION['limitation']=$limitation;
    // $_SESSION['users']=$users;

    // Header("Location: /php/home.php");
    $mysql->close();
?>