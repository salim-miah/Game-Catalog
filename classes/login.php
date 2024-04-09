<?php


class Login
{
    private $error = "";
    public function evaluate($data)
    {
        $encrypted_pass=addslashes($data['password']);
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
                session_start();
                $_SESSION['gamelist_userid'] = $row['user_id'];
            }else 
            {
                $this->error .= "Wrong Password!<br>";
            }

        }else 
        {
            $this->error .= "No such email was found<br>";
        }
        
        return $this->error;
        
    }

    public function check_login($id)
    {
        $query="select user_id from user where user_id = $id limit 1";
        $DB= new Database();
        $result = $DB->read($query);
        if($result)
        {
            return true;
        }

        return false;
    }
}


?>