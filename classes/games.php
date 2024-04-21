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
        
        public function view_game_platforms($game_id)
        {
            $query = "select platform from platforms where game_id = '$game_id'";
            $g = new Database();
            $result=$g->read($query);
            return $result;
        }


        public function get_rating( $game_id )
        {
            $query = "select avg(rating) as ratings from (addinggames inner join game_list on addinggames.list_id=game_list.list_id and addinggames.entry_id=game_list.entry_id) where game_id= '$game_id' and rating!=0 group by game_id";
            $g = new Database();
            $result=$g->read($query);
            return $result;
        }


        public function extract_games_by_rating()
        {
            $query = "select * from games order by rating ASC";
            $g = new Database();
            $result=$g->read($query);
            return $result;

        }
    }

?>


