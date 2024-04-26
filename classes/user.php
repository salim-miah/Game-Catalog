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

        public function search_user($username,$user_id)
        {   
            if ($username!='')
            {
                $query="select user_id,firstname,lastname from user where (firstname like '%$username%' or lastname like '%$username%') and user_id!='$user_id'";
                $DB = new Database();
                $result=$DB->read($query);
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function check_follow($id1,$id2)
        {

            $query="select * from friends where user_id1='$id1' and user_id2='$id2'";
            $DB = new Database();
            $result=$DB->read($query);
            if ($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        // public function check_if_friends($id1,$id2)
        // {
        //     $query="(SELECT * FROM friends
        //     WHERE flag1 = 1 AND flag2 = 1 AND user_id1 = '$id1' AND user_id2='$id2')
        //     UNION
        //     (SELECT * FROM friends
        //     WHERE flag1 = 1 AND flag2 = 1 AND user_id2 = '$id1' AND user_id2='$id1')";
        //     $DB = new Database();
        //     $result=$DB->read($query);
        //     return $result;
        // }

        // public function check_if_friend_request_received($id1,$id2)
        // {
        //     $query="(SELECT * FROM Friends
        //     WHERE flag1 = 0 AND flag2 = 1 AND user_id1 = '$id1' AND user_id2 = )
        //     UNION
        //     (SELECT user1 FROM Friends
        //     WHERE flag1 = 1 AND flag2 = 0 AND user2 = 3);";
        //     $DB = new Database();
        //     $result=$DB->read($query);
        //     return $result;
        // }
    }

?>