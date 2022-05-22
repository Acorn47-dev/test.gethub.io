<?php
    setcookie("login",$check['login'], time()-3600,"/");
    setcookie("id",$check['id'], time()-3600,"/");
    header('Location: /index.php')
?>