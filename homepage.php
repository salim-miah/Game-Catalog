<?php
    
    session_start();
    //print_r($_SESSION);
    include("classes/connect.php");
    include("classes/login.php");

    //Check if user is logged in
    if(isset($_SESSION['gamelist_userid']) & is_numeric( $_SESSION['gamelist_userid'] ))
    {
        $id = $_SESSION['gamelist_userid'];
        $login = new Login();
        $result = $login->check_login($id);

        if($result == true)
        {
            //Retrive user data
            echo "Everything is fine";
        }
        else
        {
            header("Location: login.php");
            die;
        }
    }
    else
    {
        header("Location: login.php");
        die;
    } 
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Homepage | GameChronicles</title>
    </head>

    <style type="text/css">

        #top_bar{
            height: 50px;
            background-color: #92695d;
            color: #ffffff;
        }
    </style>

    <body style="font-family: georgia; background-color: #FFE4D7;">
        <div id="top_bar">
            <div style="float: left;font-size: 30px; margin: 8px;">
                GameChronicles
            </div>
            <div style="float: right;font-size: 20px;margin: 10px;">
                <div>Logged in as, Pranto</div>
                <!-- <a href="profile.html" target="_blank" style="color: #ffffff">Logged in as, Pranto</a> -->
            </div>
        </div>
            
        <div style="width: 900px; margin: auto; background-color: black; height: 350px;">
            <img src="cover.jpg" style="width:900px; height: 350px;">
        </div>
        

    </body>
</html>
