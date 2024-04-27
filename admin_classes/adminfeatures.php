<?php

class AdminFeatures
{
    public function add_game($name,$genre,$date,$dev,$hq,$synop,$image)
        {
            $query1 = "select * from developers where developer_name = '$dev'";
            $query2 = "insert into developers (developer_name, headquarters) values 
            ('$dev', '$hq')";
            $synop=addslashes($synop);
            $query="insert into games(name, genre, release_date, developer, synopsis, images) values 
            ('$name','$genre','$date','$dev','$synop', '$image')";
            $DB = new Database();
            $x = $DB->read($query1);
            if ($x == false)
            {
                $DB->save($query2);
            }
            $DB->save($query);
        }

    public function check_game($name)
    {
        $query1 = "select * from games where name = '$name' ";
        $DB = new Database();
        $q1 = $DB->read($query1);
        if ($q1)
        {
            return 'Game Name already exists!';
        }
        else
        {
            return false;
        }

    }

    public function retrieve_gameid($game_name,$game_date,$synopsis)
    {
        $synopsis=addslashes($synopsis);
        $query="select game_id from games where name='$game_name' and release_date='$game_date' and synopsis='$synopsis'";
        $DB = new Database();
        $result = $DB->read($query);
        $row=$result[0];
        $game_id=$row['game_id'];
        return $game_id;
    }

    public function add_platform($game_id,$platform)
    {
        $query="insert into platforms(game_id,platform) values ('$game_id','$platform')";
        $DB = new Database();
        $result = $DB->save($query);
    }
    
    public function check_user($id)
    {
        $query= "select * from user where user_id = '$id' ";
        $DB = new Database();   
        $result = $DB->read($query);
        return $result;
         
    }
    public function delete_user($id)
    {
        $DB = new Database();
        $q1 = "SELECT list_id FROM user WHERE user_id = '$id'";
        $r1 = $DB->read($q1);
        $row = $r1[0];
        $l1 = $row["list_id"];
        $query= "delete from user where user_id = '$id' ";
        $d1 = "DELETE FROM addinggames WHERE list_id = '$l1' ";
        $d2 = "DELETE FROM reviews WHERE list_id = '$l1'";
        $d3 = "DELETE FROM game_list WHERE list_id = '$l1'";
        $d4 = "DELETE FROM Friends WHERE user_id1 = '$id'";
        $d5 = "DELETE FROM Friends WHERE user_id2 = '$id' ";
        $DB->save($d4);
        $DB->save($d5);
        $DB->save($query);
        $DB->save($d1);
        $DB->save($d2);
        $DB->save($d3);
    }



}




?>