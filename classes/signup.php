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

    public function create_user($data)
    {
        $firstname=$data['firstname'];
        $lastname=$data['lastname'];
        $encrypted_pass=md5($data['password1']);
        $password=$encrypted_pass;
        $email=$data['email'];
        $dob=$data['dob'];
        $query="insert into user (firstname,lastname,password,email,dob) values ('$firstname','$lastname','$password','$email','$dob')";
        $DB= new Database();
        $DB->save($query);
    }
}

?>