<?php
session_start();
    include("classes/connect.php");
    include("classes/login.php");

    $email = "";
    $password = "";


    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $login = new Login();
        $result=$login->evaluate($_POST);
        print_r($result);
        // if ($result!="")
        // {   
        //     echo "<div style='background-color: grey;font-size: 12px;color: white; text-align:center'>"; 
        //     echo "The following errors occured<br><br>";
        //     echo $result;
        //     echo "</div>";
        // }
        // else
        // {
        //     //To redirect to profile page
        //     header("Location: profile.html"); 
        //     die;
        // }

        // $email = $_POST['email'];
        // $password = $_POST['password'];
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Vault | Login up Page</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    #webpage {
        background-image: url(9AC890F8-C6BB-436F-81B1-F713D2B11D14.png);
        background-repeat: no-repeat;
        background-size: cover;
    }
    #login_section {
        background-color: rgba(255, 255, 255, 0.579);
        margin: auto;
        float: right;
        width: 350px;
        min-height: 300px;
        box-shadow:  0px 5px 10px 0px rgba(0, 0, 0, 0.5);
        border-radius: 7px;
        margin-top: 130px;
        margin-right: 5vw;
        float: right;
    }
    #input1 {
        width: 250px;
        height:40px;
        margin-top: 30px;
        border-radius: 4px;
        margin-left: 40px;
        border: solid #e6e6e6 20px;
        border-width: thin;
        padding: 5px;
    }
    #input2 {
        width: 250px;
        height:40px;
        border-radius: 4px;
        margin-left: 40px;
        border: solid #e6e6e6 20px;
        border-width: thin;
        padding: 5px;
    }
    #Login {
        width: 260px;
        height:40px;
        border-radius: 4px;
        margin-left: 40px;
        border: 2px solid white;
        background-color: rgba(255, 255, 255, 0);
        padding: 5px;
        font-family: Klavika;
        text-align: center;
        color: #503C3C;
        font-weight: bold;
        font-size: 20px;
    }
    #Login:hover {
        background-color: rgba(255, 255, 255, 0.705);
    }

    .column {
        float: left;
        padding: 20px;
        margin-top: 150px;
    } 
    #forgotsignup {
        margin: auto;
        text-align: center;
    } 
</style>
<body id="webpage">
    <div>
        <div id="login_section" class="column">
            <form method="post">
                <div style="color: #481E14; font-family: Klavika; text-align: center;font-size: 30px; font-weight: bolder;">Login In Here</div>
                <div ><input type="text" placeholder="Email" id="input1" name = 'email'></div>
                <br>
                <div><input  type="password" placeholder="Password" id="input2" name = 'password'></div>
                <br>
                <div><input type="submit" value="Login" id="Login"></div>
                <br>
                <div id="forgotsignup">
                    <br>
                    Don't have an account? &nbsp<a href="signup.php" style="color: #481E14;">Create an account</a>
                </div>
            </form>
        </div>    
    </div>    
</body>
</html>