<?php
    class Games
    {

        public function extract_games()
        {
            $query = "select * from games";
            
            $g = new Database();
            $result=$g->read($query);
            return $result;
        }

    }

?>


