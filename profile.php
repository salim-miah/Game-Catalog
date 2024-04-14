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
    <title>Profile | GameList</title>
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
        margin-top: 10px; /* Add margin-top to create space between the bars */
    }

    #user_info{
        width: 900px;
        background: linear-gradient(to right, #052659, #367fa9); 
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 5px;
        padding-left: 5px;
    }

    #playlist_bar{
        height: 50px;
        width: 900px;
        background: linear-gradient(to right, #052659, #367fa9); 
        font-size: 30px;
        margin: auto;
        margin-top: 10px; 
    }
</style>


<body style="font-family: georgia; background: linear-gradient(to right, #052659, #367fa9); ">
    <div id="top_bar">
            <div style="float: left;font-size: 30px; margin: 8px;">
                GameList
            </div>
            <div style="float: right;font-size: 20px;margin: 10px;">
                <div>Logged in as, <?php echo $name; ?></div>
            </div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        My Profile
    </div>
    <div id="user_info">
        <div>
            User ID: <?php echo $user_id; ?> <br><br>
            Player Name: <?php echo $name; ?> <br><br>
            Player Birthday: <?php echo $bd; ?> <br><br>
            Player Email: <?php echo $email; ?> <br><br>
            
        </div>
    </div>

    <div id="playlist_bar">
        <div>
            <a href="game_list_main.php" style="color: #ffffff;"><?php echo $firstname; ?>'s Game List</a>
        </div>
    </div>
</body>
</html>
