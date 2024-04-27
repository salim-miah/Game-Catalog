<?php
    
    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/view_details.php");
    include("follow.php");

    $name="";
    //profile's info
    $user_id="";
    $firstname="";
    $lastname="";
    $dob="";
    $email="";
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

    //To check if view details button is clicked
    if($_SERVER['REQUEST_METHOD']=="GET")
    {
        foreach ($_GET as $key=>$value)
        {
            $user_id=$key;
        }

        $user= new User();
        $profile=$user->user_data($user_id);
        $firstname=$profile['firstname'];
        $lastname=$profile['lastname'];
        $dob=$profile['dob'];
        $email=$profile['email'];
    }

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        if (isset($_POST['gamelist']))
        {
            $_SESSION['gamelist_otheruserid']=$_POST['gamelist'];
            header("Location: friend_gamelist_main.php");
            die;
        }
        $operation="";
        foreach ($_POST as $key=>$value)
        {
            $user_id=$key;
            $operation=$value;
        }
        if ($operation=="Follow")
        {
            $ob = new Follow();
            $ob->follow($id,$user_id);
            header("location:javascript://history.go(-1)");
        }
        else
        {
            $ob = new Follow();
            $ob->unfollow($id,$user_id);
            header("location:javascript://history.go(-1)");
        }
        
    }
?>



<!DOCTYPE html>
<html>
<head>
    <title>Friend Profile | GameList</title>
</head>

<style type="text/css">

    body {
        font-family: georgia;
        background-image: url('profile.jpg'); 
        background-size: cover; 
        background-repeat: no-repeat; 
    }

    #top_bar{
        height: 50px;
        background: linear-gradient(to right, #000000, #52525200); 
        color: #ffffff;
    }


    #homepage {
        float: right;
        font-size: 15px;
        margin-top: 15px;
        margin-right: 10px;
    }

    #homepage a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #7da0ca7d;
    }

    #homepage a:hover {
        background-color: #7da0cab2;  
    }

    #logout a{
        float: right; 
        margin: 12px; 
        text-decoration: none; 
        color: #fff; 
        padding: 3px 10px; 
        border-radius: 5px; 
        background-color: #7da0ca7d;

    }

    #logout a:hover {
        background-color: #7da0cab2; 

    }

    #button{
        float: right; 
        border: none;
        font-size: 25px;
        margin: 12px; 
        text-decoration: none; 
        color: #fff; 
        padding: 3px 10px; 
        border-radius: 5px; 
        background-color: #7da0ca7d;

    }

    #button:hover {
        background-color: #7da0cab2; 

    }


    #second_bar{
        height: 50px;
        background: linear-gradient(to right, #0527595e, #367fa960); 
        color: #ffffff;
        font-size: 30px;
        margin-top: 10px; 
    }

    #user_info{
        width: 900px;
        min-height: 265px; 
        background: linear-gradient(to right, #0527595e, #367fa960); 
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 5px;
        padding-left: 5px;
    }

    #playlist_bar{
        height: 50px;
        width: 900px;
        background: linear-gradient(to right, #0527595e, #367fa960); 
        font-size: 30px;
        margin: auto;
        margin-top: 10px; 
    }
</style>


<body>
    <div id="top_bar">
            <div style="float: left;font-size: 30px; margin: 8px;">
                GameList
            </div>
            <div style="float: right;font-size: 20px;margin: 10px;">
                <?php
                    echo '<div>Logged in as, ';
                    echo $name;
                    echo '</div>';
                ?>
            </div>
            <div id="homepage"><a href="homepage.php">Go to homepage</a></div>
            <div id="logout"><a href="logout.php">Logout</a></div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        <?php echo $profile['firstname'].'\'s'.' '.'Profile' ?>
    </div>
    <div id="user_info">
        <div>
            ID: <?php echo $user_id; ?><br><br>
            Name: <?php echo $firstname.' '.$lastname; ?><br><br>
            Birthday: <?php echo $dob; ?><br><br>
            Email:  <?php echo $email; ?><br>
            <?php
                $bool=$user->check_follow($id,$user_id);
                if (!$bool)
                {
                    echo '<form method="post">';
                    echo '<div><input type="submit"'; 
                    echo 'name="';
                    echo $profile['user_id'];
                    echo '" id="button" value="Follow"></div>';  
                    echo '</form>';
                }
                else
                {
                    echo '<form method="post">';
                    echo '<div><input type="submit"'; 
                    echo 'name="';
                    echo $profile['user_id'];
                    echo '" id="button" value="Unfollow"></div>';  
                    echo '</form>'; 
                }
            ?>
        </div>
    </div>

    <div id="playlist_bar">
        <div style="margin-bottom: 10px;">
            <form method="post">
                <?php
                    echo '<button name="gamelist" id="button" value="';
                    echo $profile['user_id'];
                    echo '" style="float: left;">';
                    echo $profile['firstname'].'\'s ';
                    echo 'Game List</button>';
                ?>
            </form>
        </div>
    </div>
</body>
</html> 