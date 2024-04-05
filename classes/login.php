<?php

class Login
{
    private $error = "";
    public function evaluate($data)
    {
        $encrypted_pass=md5(addslashes($data['password']));
        $password=$encrypted_pass;
        $email=addslashes($data['email']);
        $query="select * from user where email = '$email' limit 1";
        $DB= new Database();
        $result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            if($password == $row['password'])
            {
                //create a session data
                $_SESSION['userid'] = $row['userid'];
            }else 
            {
                $error .= "Wrong Password!<br>";
            }

        }else 
        {
            $error .= "No such email was found<br>";
        }
        
        return False;
        
    }
}


?>