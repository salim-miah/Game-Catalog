<?php


class adminLogin
{
    private $error = "";
    public function evaluate($data)
    {
        $encrypted_pass=addslashes($data['password']);
        $password=$encrypted_pass;
        $email=addslashes($data['email']);
        $query="select * from admin where admin_email = '$email' limit 1";
        $DB= new Database();
        $result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            if($password == $row['admin_password'])
            {
                //create a session data
                session_start();
                $_SESSION['gamelist_adminid'] = $row['admin_id'];
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

    public function check_admin_login($id)
    {
        $query="select admin_id from admin where admin_id = $id limit 1";
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