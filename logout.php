<?php

    session_start();
    $_SESSION["gamelist_userid"]="";
    header("Location: login.php");
    die;

?>