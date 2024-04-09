<?php

    class User
    {
        public function user_data($id)
        {
            $query="select * from user where user_id='$id' limit 1";

            $DB = new Database();
            $result=$DB->read($query);

            return $result[0];
        }
    }

?>