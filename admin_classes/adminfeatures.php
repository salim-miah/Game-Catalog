<?php

class AdminFeatures
{
    public function add_game($name,$genre,$date,$dev,$hq,$synop,$image)
        {
            $query2 = "insert into developers (developer_name, headquarters) values 
            ('$dev', '$hq')";
            $synop=addslashes($synop);
            $query="insert into games(name, genre, release_date, developer, synopsis, images) values 
            ('$name','$genre','$date','$dev','$synop', '$image')";
            $DB = new Database();
            $DB->save($query2);
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
        $query= "delete from user where user_id = '$id' ";
        $DB = new Database();
        $DB->save($query);
    }



}




?>