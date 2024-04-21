<?php
    
    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/view_details.php");
    include("classes/gamelist.php");
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
        height: 450px;
        margin-top: 5px;
        font-size: 20px;
        
    }

    nav {
            background: linear-gradient(to right, #000000, #52525200);
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-around;
    }

    nav a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
    }

    nav a:hover {
            background-color: #7da0ca7d;
    }

    .active {
            background-color: #7da0ca7d;
    }

    #list_box{
        width: 900px; 
        margin: auto; 
        background: linear-gradient(to right, #052659, #367fa9); 
        min-height: 480px;
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
        .button-24 {
            background: #cf142b;
            border: 1px solid #FF4742;
            border-radius: 6px;
            box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
            font-size: 16px;
            font-weight: 800;
            line-height: 16px;
            min-height: 40px;
            outline: 0;
            padding: 12px 14px;
            text-align: center;
            text-rendering: geometricprecision;
            text-transform: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            float: right;
        }

        .button-24:hover,
        .button-24:active {
            background-color: initial;
            background-position: 0 0;
            color: #FF4742;
        }

        .button-24:active {
            opacity: .5;
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
            <div id="homepage"><a href="homepage.php">Go to homepage</a></div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        My Game List
    </div>

    <div id="list_image">
        <img src="gamelist_image.jpeg" style="width:830px; height: 380px; padding-left: 35px; padding-top: 30px;">
    </div>
    <br>
    <div id="list_box">
        <div>
            <nav>
                <a href="game_list_main.php">All Games</a>
                <a href="game_list_currently_playing.php">Currently Playing</a> 
                <a href="game_list_completed.php">Completed</a>
                <a href="game_list_dropped.php">Dropped</a>  
                <a href="game_list_plan_to_play.php" class="active">Plan to Play</a>   
                <a href="game_list_my_reviews.php">My Reviews</a>
            </nav>
            <div id="list_title">
                Plan to play
            </div>
            <br>
            <?php

                $gl = new GameList();
                $list_id = $gl->check_userlist($id);
                $result=$gl->extract_plantoplay($list_id);
                if ($result==true)
                {
                    $serial_number=1;
                    foreach ($result as $key=>$value)
                    {
                        echo '<div class="game-bar">';
                        echo '<div class="serial-number">';
                        echo $serial_number;
                        echo '</div>';
                        echo '<img class="game-image" src="';
                        echo $value['images']; 
                        echo '"alt="Game 1">';
                        echo '<div class="game-info">';
                        echo '<div class="game-name">';
                        echo $value['name'];
                        echo '</div>';
                        echo '<form method="post">';
                        echo '<input type="submit" value="View Details" style="background-color: #7da0ca7d; color: #fff; padding: 5px 10px; border-radius: 5px; border: none;" name=';
                        echo $value['game_id'];
                        echo '>';
                        echo '<button class="button-24" name="drop" value="';
                        echo $value['game_id'];
                        echo '">Drop</button>';
                        echo '</form>';
                        echo '<div style="float: right; color: #fff;margin-right: 50px;">';
                        echo 'Genre: ';
                        echo $value['genre'];
                        echo '<br>';
                        echo 'Rating: ';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $serial_number++;
                    }
                }
                
            ?>
        </div>
    </div>
   
</body>
</html>
