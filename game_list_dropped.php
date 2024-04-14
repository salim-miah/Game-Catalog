<?php
    
    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/view_details.php");

    $name="";

    //Check if user is logged in
    if(isset($_SESSION['gamelist_userid']) & is_numeric( $_SESSION['gamelist_userid'] ))
    {
        $id = $_SESSION['gamelist_userid'];
        $login = new Login();
        $result = $login->check_login($id);

        if($result == true)
        {
            //Retrive user data
            $user= new User();
            $data=$user->user_data($id);
            $name.=$data['firstname']." ".$data['lastname'];
            $user_id = $data['user_id'];
            $bd = $data['dob'];
            $email = $data['email'];
            $firstname = $data['firstname'];
            
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
    <title>Game List | GameList</title>
</head>

<style type="text/css">

#top_bar{
        height: 50px;
        background: linear-gradient(to right, #000000, #52525200);
        color: #ffffff;
    }

    #second_bar{
        height: 50px;
        background: linear-gradient(to right, #052659, #367fa9); 
        color: #ffffff;
        font-size: 30px;
        margin-top: 10px; 
    }

    #list_image{
        width: 900px; 
        margin: auto; 
        background: linear-gradient(to right, #052659, #367fa9);
        height: 480px;
        margin-top: 5px;
        font-size: 20px;
        
    }

    #list_image a {
        text-decoration: none; 
        color: #ffffff; 
    }

    #list_image a[href="game_list_dropped.html"] {
    font-weight: bold; 
    text-decoration-line: underline; 
    }

    #list_box{
        width: 900px; 
        margin: auto; 
        background: linear-gradient(to right, #052659, #367fa9);  
        height: 480px;
        margin-top: 5px;
        font-size: 20px;
    }

    #list_title{
        width: 800px; 
        margin: auto; 
        background: linear-gradient(to right, #052659, #367fa9);
        height: 50px;
        color:  #ffffff;
        font-weight: bold; 
        font-size: 30px;
        display: flex;
        justify-content: center; 
        align-items: center;
    }

</style>


<body style="font-family: georgia; background: linear-gradient(to right, #052659, #367fa9);">
    <div id="top_bar">
            <div style="float: left;font-size: 30px; margin: 8px;">
                GameList
            </div>
            <div style="float: right;font-size: 20px;margin: 10px;">
                <div>Logged in as, <?php echo $name; ?></div>
            </div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        My Game List
    </div>

    <div id="list_image">
        <div>
            <img src="gamelist_image.jpeg" style="width:830px; height: 380px; padding-left: 35px; padding-top: 30px;">
            <br><br>
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <a href="game_list_main.php">All Games</a>
            &nbsp &nbsp &nbsp 
            <a href="game_list_currently_playing.php">Currently Playing</a> 
            &nbsp &nbsp &nbsp 
            <a href="game_list_completed.php">Completed</a>
            &nbsp &nbsp &nbsp 
            <a href="game_list_dropped.php">Dropped</a> 
            &nbsp &nbsp &nbsp 
            <a href="game_list_plan_to_play.php">Plan to Play</a>

        </div>
    </div>

    <div id="list_box">
        <div id="list_title">
            Dropped

        </div>
    </div>
   
</body>
</html>