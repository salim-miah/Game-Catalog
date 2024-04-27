<?php

    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/view_details.php");
    include("follow.php");
    include("classes/gamelist.php");
    include("classes/games.php");
    $name="";
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
    if ($_SERVER['REQUEST_METHOD']=="POST")
    {
            $game_id="";
            foreach ($_POST as $key=>$value)
            {
                $game_id=$key;
            }

            $viewdetails= new ViewDetails();
            $viewdetails->create_session($game_id);
    } 
    $otheruserid=$_SESSION['gamelist_otheruserid'];


?>



<!DOCTYPE html>
<html>
<head>
    <title>Friend GameList | GameList</title>
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



    </style>


<body style="font-family: georgia; background: linear-gradient(to right, #052659, #367fa9);">
    <div id="top_bar">
            <div style="float: left;font-size: 30px; margin: 8px;">
                GameList
            </div>
            <div style="float: right;font-size: 20px;margin: 10px;">
                <div>Logged in as, <?php echo $name ?></div>
            </div>
            <div id="homepage"><a href="homepage.php">Go to homepage</a></div>
            <div id="logout"><a href="logout.php">Logout</a></div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        <?php
            $query="select firstname from user where user_id='$otheruserid'";
            $DB = new Database();
            $result = $DB->read($query);
            $row = $result[0];
            $othername = $row['firstname']; 
            echo $othername."'s ";
        ?> 
        Game List
    </div>

    <div id="list_image">
        <img src="gamelist_image.jpeg" style="width:830px; height: 380px; padding-left: 35px; padding-top: 30px;">
    </div>
    <br>
    <div id="list_box">
        <div>
            <nav>
                <a href="friend_gamelist_main.php">All Games</a>
                <a href="friend_gamelist_currently_playing.php">Currently Playing</a> 
                <a href="friend_gamelist_completed.php">Completed</a>
                <a href="friend_gamelist_dropped.php">Dropped</a>  
                <a href="friend_gamelist_plan_to_play.php">Plan to Play</a>   
                <a href="friend_gamelist_reviews.php" class="active">Reviews</a>
            </nav>
            <div id="list_title">
                Reviews
            </div>
            <br>
            <?php

                $gl = new GameList();
                $list_id = $gl->check_userlist($otheruserid);
                $result=$gl->extract_reviews($list_id);
                if ($result==true)
                {
                    $serial_number=1;
                    foreach ($result as $key=>$value)
                    {
                        $gameid = $value["game_id"];   #For getting ratings
                        $entryid = $gl->check_addinggames($gameid,$list_id);
                        $result = $gl->get_individual_rating($list_id,$entryid);
                        $rating = '-';
                        if ($result != false)
                        {
                            $rating = round($result,2);
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
                        echo '</div>';
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