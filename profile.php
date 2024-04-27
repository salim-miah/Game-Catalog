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
    


    #main_bar{
        height: 350px;
        color: #ffffff;
        font-size: 30px;
        margin-top: 10px; 
        margin-left: 10px;
        display: flex;
    }

    
    #following_top{
        width: 300px;
        height: 50px;
        float: left;
        color: #fff; 
        border-radius: 5px; 
        background: linear-gradient(to right, #0527595e, #367fa960); 
    }
    
    #following_list{
        width: 300px;
        min-height: 225px;
        float: left;
        color: #fff; 
        border-radius: 5px; 
        margin-top: 5px;
        background: linear-gradient(to right, #0527595e, #367fa960); 
    }

    #follower_page{
        width: 200px;
        height: 50px;
        float: left;
        color: #fff; 
        border-radius: 5px; 
        margin-top: 5px;
        background: linear-gradient(to right, #0527595e, #367fa960); 
        font-size: 20px;
        
    }

    #profile_container{
        display: flex 0.5;
        margin-right: 200px;
    }

    #second_bar{
        height: 50px;
        background: linear-gradient(to right, #0527595e, #367fa960); 
        color: #ffffff;
        font-size: 30px;
        margin-left: 30px;
        width: 900px; 
        
    }

    #user_info{
        width: 900px;
        background: linear-gradient(to right, #0527595e, #367fa960); 
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 5px;
        padding-left: 5px;
        margin-left: 30px;
    }

    #playlist_bar{
        height: 50px;
        width: 900px;
        background: linear-gradient(to right, #0527595e, #367fa960); 
        font-size: 30px;
        margin: auto;
        margin-top: 10px; 
        margin-left: 30px;
    }
    .game-bar {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #7da0ca7d;
            margin-bottom: 10px;
        }

        .serial-number {
            font-size: 18px;
            font-weight: bold;
            margin-right: 10px;
            color: #fff;
        }

        .game-image {
            width: 80px;
            height: 80px;
            margin-right: 10px;
        }

        .game-info {
            flex-grow: 1;
        }

        .game-name {
            font-size: 18px;
            margin-bottom: 5px;
            color: #fff;
        }

        .game-details {
            color: blue;
            text-decoration: none;
        }

        .game-details:hover {
            text-decoration: underline;
        }
    
</style>


<body>
    <div id="top_bar">
            <div style="float: left;font-size: 30px; margin: 8px;">
                GameList
            </div>
            <div style="float: right;font-size: 20px;margin: 10px;">
                <div>Logged in as, <?php echo $name; ?></div>
            </div>
            <div id="homepage"><a href="homepage.php">Go to homepage</a></div>
            <div id="logout"><a href="logout.php">Logout</a></div>
    </div>

    <div id = main_bar>

        <div>
            <div id="following_top">
                Following
            </div>
            <div id="following_list">
                <?php
                            $serial_number=1;
                            $u=new User();
                            $result=$u->retrieve_limited_following($_SESSION['gamelist_userid']);
                            foreach ($result as $key=>$value)
                            {
                                echo '<div class="game-bar">';
                                echo '<div class="serial-number">';
                                echo $serial_number;
                                echo '</div>';
                                echo '<div class="game-info">';
                                echo '<div class="game-name">Name: ';
                                echo $value['firstname']." ".$value['lastname'];
                                echo '<br>';
                                echo 'User ID: ';
                                echo $value['user_id'];
                                echo '</div>';    
                                echo '<form method="get" action="friend_profile.php">';
                                echo '<input type="submit" value="View Profile" style="background-color: #7da0ca7d; color: #fff; padding: 5px 10px; border-radius: 5px; border: none;" name=';
                                echo $value['user_id'];
                                echo '>';
                                echo '</form>';
                                echo '</div>';
                                echo '</div>';
                                $serial_number++;
                            }
                ?>

            </div>
            <div id="follower_page">

                <a href="following_list.php" style="color: #ffffff;">See More Following</a>

            </div>
        </div>

        <div id="profile_container">

            <div id="second_bar">
                My Profile
            </div>
            <div id="user_info">
                    User ID: <?php echo $user_id; ?> <br><br>
                    Player Name: <?php echo $name; ?> <br><br>
                    Player Birthday: <?php echo $bd; ?> <br><br>
                    Player Email: <?php echo $email; ?> <br><br>

            </div>

            <div id="playlist_bar">
                    <a href="game_list_main.php" style="color: #ffffff;"><?php echo $firstname; ?>'s Game List</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
