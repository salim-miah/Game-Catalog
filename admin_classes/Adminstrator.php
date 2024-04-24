<?php

    class Adminstrator
    {
        public function admin_data($id)
        {
            $query="select * from admin where admin_id='$id' limit 1";

            $DB = new Database();
            $result=$DB->read($query);

            return $result[0];
        }
    }

?>