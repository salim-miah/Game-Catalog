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

    //To Delete user
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        print_r($_POST);
        $ag= new AdminFeatures();
        $admin_id=$_SESSION['gamelist_adminid'];
        $user_id = $_POST['user_id'];
        $check1 = $ag->check_user($user_id);
            if ($check1!=false) // Check if User exists
            {
                $ag->delete_user($user_id);
                echo "<div style='background-color: grey;font-size: 12px;color: white; text-align:center'>"; 
                echo "User Deleted!";
                echo "</div>";
            }
            else
            {
                echo "<div style='background-color: grey;font-size: 12px;color: white; text-align:center'>"; 
                echo "The following errors occured<br><br>";
                echo "User Does not exist";
                echo "</div>";
            }
    }

?>


<!DOCTYPE html>
<html>
<head>
    <title> Delete User | GameList</title>
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
        margin-top: 25px; 
    }

    #admin_info{
        width: 900px;
        background: linear-gradient(to right, #000000, #52525200);
        color: #ffffff;
        font-size: 25px;
        margin: auto;
        margin-top: 25px;
        padding-left: 5px;
    }

    #action_bar{
        height: 150px;
        width: 900px;
        background: linear-gradient(to right, #000000, #52525200);
        font-size: 25px;
        color: #ffffff;
        margin: auto;
        margin-top: 25px; 
    }

    #sure{
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

    #sure:hover {
        background-color: #662626d2;  

    }

    .input-box {
        width: 300px;
        height: 30px;
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
                <div>Logged in as, (name) </div> 
            </div>
            <div id="homepage"><a href="admin_homepage.php">Go to homepage</a></div>
            <div id="logout"><a href="admin_logout.php">Logout</a></div>
    </div>
    <div id="second_bar" style="width: 900px; margin: auto;">
        Delete User
    </div>
    <form method="post">
    <div id="admin_info">
        <div>
            User ID:  <input type="int" name="user_id" class="input-box"><br>
        </div>
    </div>

    <div id="action_bar">
        <div>
            Are you sure about deleting this User's profile?<br><br>
            <div>
                <input type="submit" value="Sure" id="sure">
            </div>
        </div>
    </div>
    </form>
</body>
</html>
