<?php

    include("classes/connect.php");
    include("classes/signup.php");

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $signup = new Signup();
        $result=$signup->evaluate($_POST);
        if ($result!="")
        {   
            echo "<div style='background-color: grey;font-size: 12px;color: white; text-align:center'>"; 
            echo "The following errors occured<br><br>";
            echo $result;
            echo "</div>";
        }
        else
        {
            //To redirect to login page
            header=("Location: login.html"); 
            die;
        }
    }   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Vault | Sign up Page</title>
</head>
<style>
    #webpage {
        background-image: url(9AC890F8-C6BB-436F-81B1-F713D2B11D14.png);
        background-repeat: no-repeat;
        background-size: cover;
    }
    #signup_section {
        background-color: rgba(255, 255, 255, 0.579);
        float: right;
        width: 350px;
        min-height: 250px;
        box-shadow:  0px 5px 10px 0px rgba(0, 0, 0, 0.505);
        border-radius: 7px;
        margin-top: 40px;
        margin-right: 500px;
    }
    #inputs {
        width: 250px;
        height:40px;
        border-radius: 4px;
        margin-left: 40px;
        border: solid #e6e6e6 20px;
        border-width: thin;
        padding: 5px;
    }
    #Create {
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
    #Create:hover {
        background-color: rgba(255, 255, 255, 0.705);
    }

    .column {
        float: left;
        padding: 20px;
        margin-top: 150px;
    } 
</style>
<body id="webpage">
    <div>
        <div id="signup_section" class="column">
            <div style="color: #481E14; font-family: Klavika; text-align: center;font-size: 30px; font-weight: bolder; margin-bottom: 30px;">Sign Up Here</div>
            <form method="post">

                <div><input type="text" placeholder="First Name" id="inputs" name="firstname"></div>
                <br>
                <div><input type="text" placeholder="Last Name" id="inputs" name="lastname"></div>
                <br>
                <span style="margin-left: 40px; font-size: 15px; color: #481E14;">Date of Birth</span>
                <div><input type="date" id="inputs" name="dob"></div>
                <br>
                <div ><input type="text" placeholder="Email" id="inputs" name="email"></div>
                <br>
                <div><input type="password" placeholder="Password" id="inputs" name="password1"></div>
                <br>
                <div><input type="password" placeholder="Retype Password" id="inputs" name="password2"></div>
                <br>
                <div><input type="submit" value="Create" id="Create"></div>
                <br>
                
            </form> 
        </div>    
    </div>    
</body>
</html>