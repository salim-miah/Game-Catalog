<?php

    class Follow
    {
        public function follow($id1,$id2)
        {
            $query="insert into friends(user_id1,user_id2) values ('$id1','$id2')";
            $DB= new Database();
            $DB->save($query);
        }
        public function unfollow($id1,$id2)
        {
            $query="delete from friends where user_id1='$id1' and user_id2='$id2'";
            $DB= new Database();
            $DB->save($query);
        }
    }

?>