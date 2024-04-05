<?php

class Signup
{
    private $error = "";

    public function evaluate($data)
    {
        foreach ($data as $key => $value)
        {
            if(empty($value)) #to check if the value is empty
            {
                $this->error.= $key . " is empty!<br>";
            }
            if($key=='email')
            {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value))
                {
                    $this->error.="Invalid email address!<br>";
                }
            }
            if($key=='firstname')
            {
                if (is_numeric($value))
                { 
                    $this->error.="First name can't be a number<br>";
                }
            }
            if($key=='lastname')
            {
                if (is_numeric($value))
                { 
                    $this->error.="Last name can't be a number<br>";
                }
            }   
        }
        if ($data['password1']!=$data['password2'])
        {
            $this->error.="The passwords don't match";
        }
        if ($this->error=="")
        {
            $this->create_user($data);
        }
        else
        {
            return $this->error;
        }
    }

    private function create_user($data)
    {
        $userid=$this->create_userid();
        $firstname=$data['firstname'];
        $lastname=$data['lastname'];
        $encrypted_pass=md5(addslashes($data['password1']));
        $password=$encrypted_pass;
        $email=$data['email'];
        $dob=$data['dob'];
        $query="insert into user (user_id,firstname,lastname,password,email,dob) values ('$userid','$firstname','$lastname','$password','$email','$dob')";
        $DB= new Database();
        $DB->save($query);
    }

    private function create_userid()
    {
        $length=rand(4,19);
        $userid="";
        for ($i=0 ; $i<$length; $i++)
        {
            $userid.=rand(0,9);
        }
        return $userid;
    }
}

?>