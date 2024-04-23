<?php

    class GameList
    {
        public function check_userlist($user_id)  //To check the value of list_id
        {
            $query="select * from user where user_id='$user_id' limit 1";
            $DB= new Database();
            $result=$DB->read($query);
            $row=$result[0];
            return $row['list_id'];
        }
        public function check_addinggames($game_id,$list_id)
        {
            $query="select * from addinggames where game_id='$game_id' and list_id='$list_id' limit 1";
            $DB= new Database();
            $result=$DB->read($query);
            if ($result)
            {
                $query="select list_id,entry_id from addinggames where game_id='$game_id' and list_id='$list_id' limit 1";
                $data=$DB->read($query);
                $row=$data[0];
                return $row['entry_id'];
            }
            else
            {
                return false;
            }
        }

        public function addgame($game_id,$list_id,$entry_id)
        {
            $query="insert into addinggames(game_id,list_id,entry_id) values ('$game_id','$list_id','$entry_id')";
            $DB= new Database();
            $addgame=$DB->save($query);
        }
        

        public function post_review($review,$list_id,$entry_id)
        {
            $query1="insert into reviews(list_id,entry_id,review) values ('$list_id','$entry_id','$review')";
            $DB= new Database();
            $DB->save($query1);
        }

        public function create_new_game_list($user_id,$game_id,$status) //For users who have list_id valued NULL
        {
            $entry_id=$this->create_entryid();
            $DB= new Database();
            if ($status=='review')
            {
                $flag=1;
                $query1="insert into game_list(entry_id,flag_review) values ('$entry_id','$flag')";
                $query2="select list_id from game_list where entry_id='$entry_id' limit 1";
                $create_list=$DB->save($query1);
                $data=$DB->read($query2); // To extract the list_id
                $row=$data[0];
                $list_id=$row['list_id'];
                $query3="update user set list_id='$list_id' where user_id='$user_id'";
                $this->addgame($game_id,$list_id,$entry_id);
                $update_list_id=$DB->save($query3);
                $id = array($list_id,$entry_id);
                return $id;
            }
            elseif ($status=='plantoplay')
            {
                $flag=1;
                $query1="insert into game_list(entry_id,flag_plantoplay,flag_allgames) values ('$entry_id','$flag','$flag')"; 
                $query2="select list_id from game_list where entry_id='$entry_id' limit 1";
                $create_list=$DB->save($query1);
                $data=$DB->read($query2); // To extract the list_id
                $row=$data[0];
                $list_id=$row['list_id']; 
                $query3="update user set list_id='$list_id' where user_id='$user_id'";
                $this->addgame($game_id,$list_id,$entry_id);
                $update_list_id=$DB->save($query3);
                $id = array($list_id,$entry_id);
                return $id; 
            }
            elseif ($status=='completed')
            {
                $flag=1;
                $query1="insert into game_list(entry_id,flag_completed,flag_allgames) values ('$entry_id','$flag','$flag')"; 
                $query2="select list_id from game_list where entry_id='$entry_id' limit 1";
                $create_list=$DB->save($query1);
                $data=$DB->read($query2); // To extract the list_id
                $row=$data[0];
                $list_id=$row['list_id']; 
                $query3="update user set list_id='$list_id' where user_id='$user_id'";
                $this->addgame($game_id,$list_id,$entry_id);
                $update_list_id=$DB->save($query3);
                $id = array($list_id,$entry_id);
                return $id; 
            }
            elseif ($status=='currentlyplaying')
            {
                $flag=1;
                $query1="insert into game_list(entry_id,flag_currentlyplaying,flag_allgames) values ('$entry_id','$flag','$flag')"; 
                $query2="select list_id from game_list where entry_id='$entry_id' limit 1";
                $create_list=$DB->save($query1);
                $data=$DB->read($query2); // To extract the list_id
                $row=$data[0];
                $list_id=$row['list_id']; 
                $query3="update user set list_id='$list_id' where user_id='$user_id'";
                $this->addgame($game_id,$list_id,$entry_id);
                $update_list_id=$DB->save($query3);
                $id = array($list_id,$entry_id);
                return $id; 
            }
            elseif ($status=='dropped')
            {
                $flag=1;
                $query1="insert into game_list(entry_id,flag_dropped,flag_allgames) values ('$entry_id','$flag','$flag')"; 
                $query2="select list_id from game_list where entry_id='$entry_id' limit 1";
                $create_list=$DB->save($query1);
                $data=$DB->read($query2); // To extract the list_id
                $row=$data[0];
                $list_id=$row['list_id']; 
                $query3="update user set list_id='$list_id' where user_id='$user_id'";
                $this->addgame($game_id,$list_id,$entry_id);
                $update_list_id=$DB->save($query3);
                $id = array($list_id,$entry_id);
                return $id; 
            }
        }
        public function create_existing_game_list($list_id,$game_id,$status) //For users who don't have list_id valued NULL
        {
            $entry_id=$this->create_entryid();
            $DB= new Database();
            if ($status=='review')
            {
                $flag=1;
                $query="insert into game_list(list_id,entry_id,flag_review) values ('$list_id','$entry_id','$flag')";
                $create_list=$DB->save($query);
                $this->addgame($game_id,$list_id,$entry_id);
                return $entry_id;
            }
            elseif ($status=='plantoplay')
            {
                $flag=1;
                $query="insert into game_list(list_id,entry_id,flag_plantoplay,flag_allgames) values ('$list_id','$entry_id','$flag','$flag')";
                $create_list=$DB->save($query);
                $this->addgame($game_id,$list_id,$entry_id);
                return $entry_id;
            }
            elseif ($status=='completed')
            {
                $flag=1;
                $query="insert into game_list(list_id,entry_id,flag_completed,flag_allgames) values ('$list_id','$entry_id','$flag','$flag')";
                $create_list=$DB->save($query);
                $this->addgame($game_id,$list_id,$entry_id);
                return $entry_id;
            }
            elseif ($status=='currentlyplaying')
            {
                $flag=1;
                $query="insert into game_list(list_id,entry_id,flag_currentlyplaying,flag_allgames) values ('$list_id','$entry_id','$flag','$flag')";
                $create_list=$DB->save($query);
                $this->addgame($game_id,$list_id,$entry_id);
                return $entry_id;
            }
            elseif ($status=='dropped')
            {
                $flag=1;
                $query="insert into game_list(list_id,entry_id,flag_dropped,flag_allgames) values ('$list_id','$entry_id','$flag','$flag')";
                $create_list=$DB->save($query);
                $this->addgame($game_id,$list_id,$entry_id);
                return $entry_id;
            }  
        }
        public function check_flag($status,$list_id,$entry_id)
        {
            if ($status=="plantoplay")
            {
                $query="select * from game_list where list_id='$list_id' and entry_id='$entry_id'";
                $DB= new Database();
                $result=$DB->read($query);
                $row=$result[0];
                if ($row['flag_plantoplay']==0 or $row['flag_plantoplay']==NULL)
                {
                    $query0="update game_list set flag_currentlyplaying=0, flag_completed=0, flag_dropped=0 where list_id='$list_id' and entry_id='$entry_id'";
                    $query1="update game_list set flag_plantoplay=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $query2="update game_list set flag_allgames=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $DB->save($query0);
                    $DB->save($query1);
                    $DB->save($query2);
                    return false;
                }       
                else
                {
                    return true;
                }
            }
            elseif ($status=="completed")
            {
                $query="select * from game_list where list_id='$list_id' and entry_id='$entry_id'";
                $DB= new Database();
                $result=$DB->read($query);
                $row=$result[0];
                if ($row['flag_completed']==0 or $row['flag_completed']==NULL)
                {
                    $query0="update game_list set flag_currentlyplaying=0, flag_plantoplay=0, flag_dropped=0 where list_id='$list_id' and entry_id='$entry_id'";
                    $query1="update game_list set flag_completed=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $query2="update game_list set flag_allgames=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $DB->save($query0);
                    $DB->save($query1);
                    $DB->save($query2);
                    return false;
                }       
                else
                {
                    return true;
                }
            }
            elseif ($status=="currentlyplaying")
            {
                $query="select * from game_list where list_id='$list_id' and entry_id='$entry_id'";
                $DB= new Database();
                $result=$DB->read($query);
                $row=$result[0];
                if ($row['flag_currentlyplaying']==0 or $row['flag_currentlyplaying']==NULL)
                {
                    $query0="update game_list set flag_plantoplay=0, flag_completed=0, flag_dropped=0 where list_id='$list_id' and entry_id='$entry_id'";
                    $query1="update game_list set flag_currentlyplaying=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $query2="update game_list set flag_allgames=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $DB->save($query0);
                    $DB->save($query1);
                    $DB->save($query2);
                    return false;
                }       
                else
                {
                    return true;
                }
            }
            elseif ($status=="dropped")
            {
                $query="select * from game_list where list_id='$list_id' and entry_id='$entry_id'";
                $DB= new Database();
                $result=$DB->read($query);
                $row=$result[0];
                if ($row['flag_dropped']==0 or $row['flag_dropped']==NULL)
                {
                    $query0="update game_list set flag_plantoplay=0, flag_completed=0, flag_currentlyplaying=0 where list_id='$list_id' and entry_id='$entry_id'";
                    $query1="update game_list set flag_dropped=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $query2="update game_list set flag_allgames=1 where list_id='$list_id' and entry_id='$entry_id'";
                    $DB->save($query0);
                    $DB->save($query1);
                    $DB->save($query2);
                    return false;
                }       
                else
                {
                    return true;
                }
            }
        }
        public function extract_all_games($list_id)
        {
            $query= "select game_list.list_id,game_list.entry_id,games.game_id,name,genre,release_date,images from ((game_list inner join addinggames on game_list.list_id=addinggames.list_id and game_list.entry_id=addinggames.entry_id) inner join games on addinggames.game_id=games.game_id) where game_list.list_id='$list_id' and game_list.flag_allgames=1";
            $DB= new Database();
            $result= $DB->read($query);
            return $result;
        }
        public function extract_currently_playing($list_id)
        {
            $query= "select game_list.list_id,game_list.entry_id,games.game_id,name,genre,release_date,images from ((game_list inner join addinggames on game_list.list_id=addinggames.list_id and game_list.entry_id=addinggames.entry_id) inner join games on addinggames.game_id=games.game_id) where game_list.list_id='$list_id' and game_list.flag_currentlyplaying=1";
            $DB= new Database();
            $result= $DB->read($query);
            return $result;
        }
        public function extract_completed($list_id)
        {
            $query= "select game_list.list_id,game_list.entry_id,games.game_id,name,genre,release_date,images from ((game_list inner join addinggames on game_list.list_id=addinggames.list_id and game_list.entry_id=addinggames.entry_id) inner join games on addinggames.game_id=games.game_id) where game_list.list_id='$list_id' and game_list.flag_completed=1";
            $DB= new Database();
            $result= $DB->read($query);
            return $result;
        }

        public function extract_dropped($list_id)
        {
            $query= "select game_list.list_id,game_list.entry_id,game_list.reeason_of_dropping,games.game_id,name,genre,release_date,images from ((game_list inner join addinggames on game_list.list_id=addinggames.list_id and game_list.entry_id=addinggames.entry_id) inner join games on addinggames.game_id=games.game_id) where game_list.list_id='$list_id' and game_list.flag_dropped=1";
            $DB= new Database();
            $result= $DB->read($query);
            return $result;
        }

        public function extract_plantoplay($list_id)
        {
            $query= "select game_list.list_id,game_list.entry_id,games.game_id,name,genre,release_date,images from ((game_list inner join addinggames on game_list.list_id=addinggames.list_id and game_list.entry_id=addinggames.entry_id) inner join games on addinggames.game_id=games.game_id) where game_list.list_id='$list_id' and game_list.flag_plantoplay=1";
            $DB= new Database();
            $result= $DB->read($query);
            return $result;
        }

        public function rate($list_id,$entry_id,$rating)
        {
            $query="update game_list set rating='$rating' where list_id='$list_id' and entry_id='$entry_id'";
            $DB= new Database();
            $DB->save($query);  
        }
        private function create_entryid()
        {
            $length=rand(4,19);
            $entryid="";
            for ($i=0 ; $i<$length; $i++)
            {
                $entryid.=rand(0,9);
            }
            return $entryid;
        }
        public function reason_of_dropping($list_id,$entry_id,$reason)
        {
            $query= "update game_list set reeason_of_dropping = '$reason' where list_id='$list_id' and entry_id='$entry_id'";
            $DB= new Database();
            $DB->save($query);
        }

        public function extract_reviews($list_id)
        {
            $query="select game_list.list_id,game_list.entry_id,game_list.rating,games.game_id,review,review_id,games.name,games.images,games.genre from (((game_list inner join addinggames on game_list.list_id=addinggames.list_id and game_list.entry_id=addinggames.entry_id) inner join games on addinggames.game_id=games.game_id) inner join reviews on game_list.list_id=reviews.list_id and game_list.entry_id=reviews.entry_id) where game_list.list_id='$list_id'";
            $DB= new Database();
            $result=$DB->read($query);
            return $result;
        }

        public function delete_list($list_id,$entry_id,$status)
        {
            $result=$this->check_review_flag($list_id,$entry_id);
            if ($result)
            {
                $query="update game_list set $status=0, flag_allgames=0 where list_id='$list_id' and entry_id='$entry_id'";
                $DB= new Database();
                $DB->save($query);
            }
            else{
                $query1="delete from addinggames where list_id='$list_id' and entry_id='$entry_id'";
                $query2="delete from game_list where list_id='$list_id' and entry_id='$entry_id'";
                $DB= new Database();
                $DB->save($query1);
                try {
                    $DB->save($query2);
                }
                catch(Exception $e) {
                    if ($status=="flag_currentlyplaying")
                    {
                        header("Location: game_list_currently_playing.php");
                        die;    
                    }
                    elseif ($status=="flag_plantoplay")
                    {
                        header("Location: game_list_plan_to_play.php");
                        die;
                    }
                    elseif ($status=="flag_dropped")
                    {
                        header("Location: game_list_dropped.php");
                        die;
                    }
                    elseif ($status=="flag_completed")
                    {
                        header("Location: game_list_completed.php");
                        die;
                    }
                    elseif ($status=="flag_review")
                    {
                        header("Location: game_list_my_reviews.php");
                        die;
                    }
                }
            }
        }

        public function get_individual_rating($list_id,$entry_id)
        {
            $query="select rating from game_list where list_id='$list_id' and entry_id='$entry_id' and rating!=0";
            $DB= new Database();
            $result=$DB->read($query);
            if ($result)
            {
                $row=$result[0];
                $rating=$row['rating'];
                return $rating;
            }
            else
            {
                return false;
            }
        }

        public function delete_reviewlist($review_id)
        {
                $query="delete from reviews where review_id='$review_id'";
                $DB= new Database();
                $DB->save($query);
        }

        private function check_review_flag($list_id,$entry_id)
        {
            $query="select flag_review from game_list where list_id='$list_id' and entry_id='$entry_id'";
            $DB= new Database();
            $result=$DB->read($query);
            $row=$result[0];
            $flag_review=$row['flag_review'];
            if ($flag_review==0)
            {
                return false;
            }
            else{
                return true;
            }
        }
        
    }

?>
