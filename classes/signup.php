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