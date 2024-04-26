<?php

    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/view_details.php");

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

    if ($_SERVER['REQUEST_METHOD']=="GET")
    {
        $username=addslashes($_GET['search']);
        if ($username!="")
        {
            $user= new User();
            $searchedresults=$user->search_user($username,$_SESSION['gamelist_userid']);
        }
        else
        {
            echo "<div style='background-color: grey;font-size: 12px;color: white; text-align:center'>"; 
            echo "No username has been entered";
            echo "</div>";
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


<body style="font-family: georgia;  background: linear-gradient(to right, #052659, #367fa9);">
    <div id="top_bar">
        <div style="font-size: 25px;">
            <div style="margin: 5px; float: left;">GameList</div> 
            <?php echo "<div style='margin: 5px; float: right'>Logged in as: $name</div>"; ?>
            <div id="homepage"><a href="homepage.php">Go to homepage</a></div>
        </div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        Searched Results
        <br>
        <br>
        <?php
                $serial_number=1;
                if ($username!="")
                {
                    if ($searchedresults)
                    {
                        foreach ($searchedresults as $key=>$value)
                        {
                            echo '<div class="game-bar">';
                            echo '<div class="serial-number">';
                            echo $serial_number;
                            echo '</div>';
                            echo '<div class="game-info">';
                            echo '<div class="game-name">First name: ';
                            echo $value['firstname'];
                            echo '<br>';
                            echo 'Last name: ';
                            echo $value['lastname'];
                            echo '<br>';
                            echo 'User ID: ';
                            echo $value['user_id'];
                            echo '</div>';    
                            echo '<form method="get" action="friend_profile.php">';
                            echo '<input type="submit" value="View Profile" style="background-color: #7da0ca7d; color: #fff; padding: 5px 10px; border-radius: 5px; border: none;" name=';
                            echo $value['user_id'];
                            echo '>';
                            echo '</form>';
                            // echo '<div style="float: right; color: #fff;margin-right: 50px;">';
                            // echo 'Genre: ';
                            // echo $value['genre'];
                            // echo '<br>';
                            // echo 'Rating: ';
                            // echo $rating;
                            // echo '<br>';
                            // echo 'Active Players: ';
                            // echo $active_players;
                            // echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $serial_number++;
                        }
                    }
                }
                
            ?>
    </div>
</body>
</html>