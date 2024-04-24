<?php

    session_start();
    $_SESSION["gamelist_adminid"]="";
    header("Location: admin_login.php");
    die;

?>