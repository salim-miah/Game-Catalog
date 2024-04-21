<?php
    
    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
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

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $gl= new GameList();
        $user_id=$_SESSION['gamelist_userid'];
        $game_id=$_SESSION['game_id'];
        $review=$_POST['review'];
        $status='review';
        $list_id=$gl->check_userlist($user_id);
        $entry_id="";
        if ($list_id==NULL)
        {
            $id=$gl->create_new_game_list($user_id,$game_id,$status);
            $list_id=$id[0];
            $entry_id=$id[1];
            $gl->post_review($review,$list_id,$entry_id);
        }
        else
        {
            $result=$gl->check_addinggames($game_id);
            if ($result!=false)
            {
                $entry_id=$result;
                $query="update game_list set flag_review=1 where list_id='$list_id' and entry_id='$entry_id'";
                $DB = new Database();
                $DB->save($query);
                $gl->post_review($review,$list_id,$entry_id);
            }
            else //if the game is not added before
            {
                $entry_id=$gl->create_existing_game_list($list_id,$game_id,$status);
                $gl->post_review($review,$list_id,$entry_id);
            }
        }
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

    #homepage {
        float: right;
        font-size: 15px;
        margin-top: 12px;
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
        height: 180px;
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

    #submit {
        float: right; 
        text-decoration: none; 
        color: #fff; 
        padding: 5px 10px; 
        border-radius: 5px; 
        border: none; 
        background-color: #7da0ca7d; 
        font-size: 18px
    }

    #submit:hover{
        background-color: #7da0cab2; 
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
        <div style="font-size: 25px;">
            <div style="margin: 5px; float: left;">GameList</div> 
            <?php echo "<div style='margin: 5px; float: right'>Logged in as: $name</div>"; ?>
            <div id="homepage"><a href="homepage.php">Go to homepage</a></div>
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
                $result1 = $details->view_game_platforms($game_id);
                $platforms = $result1;   
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
                echo "Platforms: ";
                $y = count($platforms)-2;
                for ($x = 0; $x <= $y; $x++) {
                echo $platforms[$x]['platform'];
                echo ' , ';
                }
                echo $platforms[$y+1]['platform'];
                echo " <br>";
            ?>
        </div>
    </div>
    <br>
    <div id="details">
        <div>
            <span style="text-decoration: underline; padding-bottom: 5px;">Sypnosis</span><br>
            <?php echo $game_details["synopsis"];
            ?>
        </div>
    </div>
    <br>
    <div id="review">
        <div>
            <span style="text-decoration: underline; padding-bottom: 5px;">Upload your review</span><br>
            <form method="post">
                <textarea id="review_input" rows="4" cols="50" maxlength="500" name="review"></textarea>
                <br>
                <input type="submit" value="Submit" name="Submit" id="submit">
            </form>
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
            </nav>
        </div>
    </div>
</body>
</html>

