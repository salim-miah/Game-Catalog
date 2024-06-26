<?php
    
    session_start();
    include("classes/connect.php");
    include("admin_classes/adminlogin.php");
    include("classes/user.php");
    include("classes/view_details.php");
    include("admin_classes/Adminstrator.php");
    include("admin_classes/adminfeatures.php");

    $name="";

    //Check if admin is logged in
    if(isset($_SESSION['gamelist_adminid']) & is_numeric( $_SESSION['gamelist_adminid'] ))
    {
        $id = $_SESSION['gamelist_adminid'];
        $login = new adminLogin();
        $result = $login->check_admin_login($id);

        if($result == true)
        {
            //Retrive user data
            $adminstrator= new Adminstrator();
            $data=$adminstrator->admin_data($id);
            $admin_name =$data['admin_firstname']." ".$data['admin_lastname'];
            $admin_id =  $data['admin_id'];
            $admin_email = $data['admin_email'];
            
        }
        else
        {
            header("Location: admin_login.php");
            die;
        }
    }
    else
    {
        header("Location: admin_login.php");
        die;
    }
    
    // To add games
    if($_SERVER['REQUEST_METHOD']=="POST")
    { 
            $ag= new AdminFeatures();
            $admin_id=$_SESSION['gamelist_adminid'];
            $game_name = $_POST['game_name'];
            $game_genre = $_POST['game_genre'];
            $game_date = $_POST['release_date'];
            $game_dev = $_POST['developer'];
            $dev_hq = $_POST['hq'];
            // $game_plat = $_POST['platforms'];
            //To store platforms into database
            $game_synop = $_POST['synopsis'];
            #$game_im = $_FILES['game_image'];
            $check1 = $ag->check_game($game_name); 
            $targetDir = "images/"; 
            $fileName = basename($_FILES["game_image"]["name"]); 
            $targetFilePath = $targetDir . $fileName; 
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                if ($check1!=false)
                {
                    echo "<div style='background-color: grey;font-size: 12px;color: white; text-align:center'>"; 
                    echo "The following errors occured<br><br>";
                    echo $check1;
                    echo "</div>";
                }
                else
                {
                    move_uploaded_file($_FILES["game_image"]["tmp_name"], $targetFilePath);
                    #echo $targetFilePath;
                    #echo $fileName;
                    $ag->add_game($game_name,$game_genre,$game_date,$game_dev,$dev_hq,$game_synop,$targetFilePath);
                    $game_id=$ag->retrieve_gameid($game_name,$game_date,$game_synop);
                    foreach($_POST['platform'] as $key => $value)
                    {
                        $ag->add_platform($game_id,$value);
                    }
                    echo "<div style='background-color: grey;font-size: 12px;color: white; text-align:center'>"; 
                    echo "The Game is added!";
                    echo "</div>"; 
                } 
    }




?>



<!DOCTYPE html>
<html>
<head>
    <title> Add Games | GameList</title>
</head>

<style type="text/css">

    body {
        font-family: georgia;
        background-image: url('admin_cover.jpg'); 
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
            background-color: #6626267d;
    }

    #homepage a:hover {
        background-color: #662626d2;  
    }

    #logout a{
        float: right; 
        margin: 12px; 
        text-decoration: none; 
        color: #fff; 
        padding: 3px 10px; 
        border-radius: 5px; 
        background-color: #6626267d;

    }

    #logout a:hover {
        background-color: #662626d2;  
    }

    #second_bar{
        height: 50px;
        background: linear-gradient(to right, #000000, #52525200);
        color: #ffffff;
        font-size: 30px;
        margin-top: 10px; 
    }

    #admin_info{
        width: 900px;
        background: linear-gradient(to right, #000000, #52525200);
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 5px;
        padding-left: 5px;
    }

    #action_bar{
        height: 50px;
        width: 900px;
        background: linear-gradient(to right, #000000, #52525200);
        font-size: 30px;
        color: #ffffff;
        margin: auto;
        margin-top: 10px; 
    }

    #done{
        float: left;
        font-size: 25px;
        color: #ffffff;
        margin-left: 350px;
        text-decoration: none;
        text-align: center;
        padding: 5px 10px;
        border-radius: 5px;

        background-color: #6626267d;
    }

    #done:hover {
        background-color: #662626d2;  

    }

    .input-box {
        width: 300px;
        height: 25px;
        margin-top: 5px;
        margin-bottom: 5px;
        background-color: #ffe3e3;
    }

</style>


<body>
    <div id="top_bar">
            <div style="float: left;font-size: 30px; margin: 8px;">
                GameList
            </div>
            <div style="float: right;font-size: 20px;margin: 10px;">
                <div>Logged in as, <?php echo $admin_name ?> </div> 
            </div>
            <div id="homepage"><a href="admin_homepage.php">Go to homepage</a></div>
            <div id="logout"><a href="admin_logout.php">Logout</a></div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        Add Games
    </div>
    <form method="post" enctype="multipart/form-data" id="game_info">
    <div id="admin_info">   
        <div>
            Game Name:  <input type="text" name="game_name" class="input-box"><br>
            Genre: <input type="text" name="game_genre" class="input-box"><br>
            Release Date:  <input type="date" name="release_date" class="input-box"><br>
            Developer: <input type="text" name="developer" class="input-box"><br>
            Developer's Headquarter: <input type="text" name="hq" class="input-box"><br>
            <div id="platform_field">
                Platforms: <input type="text" name="platform[]" class="input-box" placeholder="Add Platform">&nbsp;<button name="addplatform" class="add_platform_button">Add Platform</a></button><br>
            </div>
            Synopsis: <input type="text" name="synopsis" class="input-box"><br>
            Game Image: <input type="file" name="game_image" id="game_image" class="input-box"><br>
            <span style="font-size: 14px;">(Image size should be 80px x 80px)</span> 
        </div>
        <div id="action_bar">
            <input type="submit" value="Add" name="add_game" id="done">
            <!--ei button e ki korbo not sure yet. you guys decide. I want it to be like Enter button. Like, after clicking this, data will be recorded.-->
        </div>
    </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add_platform_button").click(function(e) {
                e.preventDefault();
                $("#platform_field").prepend('<div id="platform_field"> Platforms: <input type="text" name="platform[]" class="input-box" placeholder="Add Platform">&nbsp;<button name="addplatform" class="remove_platform_button">Remove</a></button><br></div>');
            });
            $(document).on('click','.remove_platform_button', function(e){
                e.preventDefault();
                let row_item = $(this).parent();
                $(row_item).remove();
            });
        });
    </script>
    <!-- <div id="action_bar">
        <div>
            <div id="done"><a style="color: #ffffff; text-decoration: none;">Done</a></div> -->
            <!--ei button e ki korbo not sure yet. you guys decide. I want it to be like Enter button. Like, after clicking this, data will be recorded.-->
        <!-- </div>
    </div> -->
</body>
</html>

