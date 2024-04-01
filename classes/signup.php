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
                $this->error. $key . " is empty!<br>";
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
        
    }
}

?>