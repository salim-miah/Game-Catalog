<?php
    
    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");

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
    <meta charset="UTF-8">
    <title>Game Detail | GameList</title>
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

    #game_info{
        width: 850px;
        background: linear-gradient(to right, #052659, #367fa9);
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 5px;
        padding-left: 50px; /* Adjust the left padding to accommodate the picture */
        display: flex;
        align-items: center; /* Align the content vertically */
    }

    #game_image {
        width: 200px;
        height: 200px;
        margin-right: 50px; /* Add margin to separate the picture from text */
    }

    #details{
        width: 900px;
        background: linear-gradient(to right, #052659, #367fa9);
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 5px;  
    }

    #review{
        width: 900px;
        height: 150px;
        background: linear-gradient(to right, #052659, #367fa9);
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 5px;
    }

    #review_input{
        width: 880px;
        height: 100px;
        font-family: georgia;
        background-color: #7DA0CA;
        color: #ffffff;
        font-size: 18px;
        margin: auto;
        margin-top: 5px;
        margin-left: 6px;
    }

    #rating{
        width: 900px;
        height: 100px;
        font-family: georgia;
        font-size: 25px;
        background: linear-gradient(to right, #052659, #367fa9);
        color: #ffffff;
        margin: auto;
        margin-top: 5px;
    }

    #Add_to_list{
        width: 900px;
        font-family: georgia;
        font-size: 25px;
        background: linear-gradient(to right, #052659, #367fa9);
        color: #ffffff;
        margin: auto;
        margin-top: 5px;       
    }

    *{
    margin: 0;
    padding: 0;
    }

    #Submit {
        margin: 5px;
        margin-right: 80px;
        text-decoration: none;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        background-color: #7da0ca7d;
    }

    nav {
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            margin-bottom: 20px;
    }

    nav a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #7da0ca7d;
    }

    nav a:hover {
        background-color: #7da0cab2;  
    }
</style>


<body style="font-family: georgia;  background: linear-gradient(to right, #052659, #367fa9);">
    <div id="top_bar">
        <div style="width: 900px; margin: auto;font-size: 30px;">
            <div style="float: left;">GameList</div> 
            <?php echo "<div style='float: right'>Logged in as: $name</div>"; ?>
        </div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        Game Detail
    </div>
    <br>
    <div id="game_info">
            <?php
                include("classes/games.php");
                $details = new Games();
                $game_id=$_SESSION['game_id'];
                $result=$details->view_game_details($game_id);
                $game_details=$result[0];
                echo '<img id="game_image" src="';
                echo $game_details['images']; 
                echo '"alt="Game Picture">';
            ?>     
        <div>
            <?php
                echo "Game ID: ";
                echo $game_details['game_id'];
                echo " <br>";
                echo "Game Name: ";
                echo $game_details['name'];
                echo " <br>";
                echo "Release_date: ";
                echo $game_details['release_date'];
                echo " <br>";
                echo "Developer: ";
                echo $game_details['developer'];
                echo " <br>";
            ?>
        </div>
    </div>
    <br>
    <div id="details">
        <div>
            <span style="text-decoration: underline; padding-bottom: 5px;">Sypnosis</span><br>
            Cyberpunk 2077 is an open-world, action-adventure RPG set in Night City, a megalopolis obsessed with power, glamour, and body modification. Play as V, a cyberpunk mercenary, and take on the most powerful forces of the city in a fight for glory and survival.
        </div>
    </div>
    <br>
    <div id="review">
        <div>
            <span style="text-decoration: underline; padding-bottom: 5px;">Upload your review</span><br>
            <textarea id="review_input" rows="4" cols="50" maxlength="500"></textarea> 
        </div>
    </div>
    <br>
    <div id="Add_to_list">
        <div>
            <span style="text-decoration: underline; padding-bottom: 5px;">Add to your list</span><br>
            <nav>
                <a href="add_to_list_plan_to_play.php">Plan to Play</a>
                <a href="add_to_list_currently_playing.php">Currently Playing</a>
                <a href="add_to_list_completed.php">Completed</a>
                <a href="add_to_list_dropped.php">Dropped</a>
            </nav>
        </div>
    </div>
</body>
</html>

