<?php
$myid = $_COOKIE['id'];
$mylogin=$_COOKIE['login'];
$data = array();
$bet = array();
$resultt = array();
$mysql = new mysqli('127.0.0.1:8889', 'root', 'root', 'history-bd');
$result=$mysql->query("SELECT * FROM history WHERE id= '$myid' AND login= '$mylogin'");
while($row = $result->fetch_array())
{
  
    $data[] = $row['data'];
    $bet[] = $row['bet'];
    $resultt[] = $row['result'];
}




$response[0]=$data;
    $response[1]=$bet;
    $response[2]=$resultt;
    echo json_encode($response);
?>