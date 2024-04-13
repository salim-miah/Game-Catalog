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

        public function extract_games_by_oldest()
        {
            $query = "select * from games order by release_date ASC";
            $g = new Database();
            $result=$g->read($query);
            return $result;

        }
        public function extract_games_by_latest()
        {
            $query = "select * from games order by release_date DESC";
            $g = new Database();
            $result=$g->read($query);
            return $result;

        }
        public function extract_games_by_genre()
        {
            $query = "select * from games order by genre ASC";
            $g = new Database();
            $result=$g->read($query);
            return $result;

        }

        public function view_game_details($game_id)
        {
            $query = "select * from games where game_id='$game_id' limit 1";
            $g = new Database();
            $result=$g->read($query);
            return $result;
        }

    }

?>


