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

    //To use session
    // if($_SERVER['REQUEST_METHOD']=="POST")
    // {
    //     $game_id="";
    //     foreach ($_POST as $key=>$value)
    //     {
    //         $game_id=$key;
    //     }

    //     $viewdetails= new ViewDetails();
    //     $viewdetails->create_session($game_id);
    // }
?>







<!DOCTYPE html>
<html>
<head>
    <title> Admin Profile | GameList</title>
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
        height: 150px;
        width: 900px;
        background: linear-gradient(to right, #000000, #52525200);
        font-size: 30px;
        color: #ffffff;
        margin: auto;
        margin-top: 10px; 
    }

    #add_games{
        float: left;
        font-size: 25px;
        margin-left: 225px;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: #6626267d;
    }
    #delete_user{
        float: right;
        font-size: 25px;
        margin-right: 225px;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: #6626267d;
    }

    #add_games:hover {
        background-color: #662626d2;  

    }
    #delete_user:hover {
        background-color: #662626d2;  
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
            <div id="logout">
            <a href="admin_logout.php">Logout</a>
            </div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        My Profile
    </div>
    <div id="admin_info">
        <div>
            Admin ID:    
            <?php echo $admin_id; ?> <br><br>
            Admin Name:  
            <?php echo $admin_name; ?><br><br>
            Admin Email:  
            <?php echo $admin_email; ?><br><br>
            
        </div>
    </div>

    <div id="action_bar">
        <div>
            Actions<br><br>
            <div id="add_games"><a href="add_games.php" style="color: #ffffff; text-decoration: none;">Add Games</a></div>
            <div id="delete_user"><a href="delete_user.php" style="color: #ffffff; text-decoration: none;">Delete User</a></div>
        </div>
    </div>
</body>
</html>

