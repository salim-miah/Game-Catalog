<?php
    
    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/view_details.php");
    include("classes/gamelist.php");
    include("classes/games.php");
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

    if ($_SERVER['REQUEST_METHOD']=="POST")
    {
        if (isset($_POST['drop']))
        {
            $game_id=$_POST['drop'];
            session_start();
            $_SESSION['game_id']=$game_id;
            header("Location: add_to_list_dropped.php");
            die;
        } 
        elseif (isset($_POST['delete']))
        {

        }
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
    }
    .game-serial {
        flex: 0 0 50px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-right: 10px;
        color: #fff;
    }
    .game-info {
        flex: 1;
        display: flex;
        align-items: center;
        color: #fff;
    }
    .game-img {
        width: 100px;
        margin-right: 20px;
    }
    .game-details {
        flex: 1;
    }
    .game-title {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 5px;
    }
    .game-genre {
        font-style: italic;
        color: #fff;
    }
    .game-rating {
        margin-top: 5px;
        color: #fff;
    }
    .game-review {
        font-style: italic;
        color: #fff;
    }

        .icon-trash {
        width: 40px;
        height: 40px;
        position: relative;
        overflow: hidden;
        margin-left: 25px;
        margin-bottom: 25px;
        }
        
        .icon-trash .trash-lid {
        width: 62%;
        height: 10%;
        position: absolute;
        left: 50%;
        margin-left: -31%;
        top: 10.5%;
        background-color: #000;
        border-top-left-radius: 80%;
        border-top-right-radius: 80%;
        -webkit-transform: rotate(-5deg);
        -moz-transform: rotate(-5deg);
        -ms-transform: rotate(-5deg);
        transform: rotate(-5deg); 
        }

        .icon-trash .trash-lid:after {
        content: "";
        width: 26%;
        height: 100%;
        position: absolute;
        left: 50%;
        margin-left: -13%;
        margin-top: -10%;
        background-color: inherit;
        border-top-left-radius: 30%;
        border-top-right-radius: 30%;
        -webkit-transform: rotate(-1deg);
        -moz-transform: rotate(-1deg);
        -ms-transform: rotate(-1deg);
        transform: rotate(-1deg); 
        }

        .icon-trash .trash-container {
        width: 56%;
        height: 65%;
        position: absolute;
        left: 50%;
        margin-left: -28%;
        bottom: 10%;
        background-color: #000;
        border-bottom-left-radius: 15%;
        border-bottom-right-radius: 15%;
        }

        .icon-trash .trash-container:after {
        content: "";
        width: 110%;
        height: 12%;
        position: absolute;
        left: 50%;
        margin-left: -55%;
        top: 0;
        background-color: inherit;
        border-bottom-left-radius: 45%;
        border-bottom-right-radius: 45%;
        }



        .icon-trash .trash-line-1 {
        width: 4%;
        height: 50%;
        position: absolute;
        left: 38%;
        margin-left: -2%;
        bottom: 17%;
        background-color: #252527;
        }

        .icon-trash .trash-line-2 {
        width: 4%;
        height: 50%;
        position: absolute;
        left: 50%;
        margin-left: -2%;
        bottom: 17%;
        background-color: #252527;
        }

        .icon-trash .trash-line-3 {
        width: 4%;
        height: 50%;
        position: absolute;
        left: 62%;
        margin-left: -2%;
        bottom: 17%;
        background-color: #252527;
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
                <a href="game_list_plan_to_play.php">Plan to Play</a>   
                <a href="game_list_my_reviews.php" class="active">My Reviews</a>
            </nav>
        </div>
        <div id="list_title">
            My Reviews
        </div>
        <br>
            <?php

                $gl = new GameList();
                $games = new Games();
                $list_id = $gl->check_userlist($id);
                $result=$gl->extract_reviews($list_id);
                if ($result==true)
                {
                    $serial_number=1;
                    foreach ($result as $key=>$value)
                    {
                        $gameid = $value["game_id"];   #For getting ratings
                        $result = $games->get_rating($gameid);
                        $rating = '-';
                        if ($result != false)
                        {
                            $row = $result[0];
                            $rating = $row['ratings'];
                            $rating = round($rating,2);
                        }
                        echo '<div class="game-bar">';
                        echo '<div class="game-serial">';
                        echo $serial_number;
                        echo '</div>';
                        echo '<div class="game-info">';
                        echo '<img src="';
                        echo $value['images'];
                        echo '" class="game-img">';
                        echo '<div class="game-details">';
                        echo '<div class="game-title">';
                        echo $value['name'];
                        echo '</div>';
                        echo '<div class="game-genre">';
                        echo "Genre: ";
                        echo $value['genre'];
                        echo '</div>';
                        echo '<div class="game-rating">Rating: ';
                        echo $rating;
                        echo '</div>';
                        echo '<div class="game-review">';
                        echo "My Review: ";
                        echo $value['review'];
                        echo '</div>';
                        echo '<div style="float: right">';
                        echo '<form method="post">';
                        echo '<button name="delete" value="delete" style="float: right; background-color: transparent; border: none">';
                        echo '<div class="icon-trash" style="float: left">';
                        echo '<div class="trash-lid" style="background-color: #cf142b"></div>';
                        echo '<div class="trash-container" style="background-color: #cf142b"></div>';
                        echo '<div class="trash-line-1"></div>';
                        echo '<div class="trash-line-2"></div>';
                        echo '<div class="trash-line-3"></div>';
                        echo '</div>';
                        echo '</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $serial_number++;
                    }
                }
                
            ?>
    </div>
   
</body>
</html>
