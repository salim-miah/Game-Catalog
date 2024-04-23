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
            $query = "SELECT * FROM games
            LEFT JOIN 
            (SELECT addinggames.game_id as g_id, AVG(game_list.rating) as avg_rating 
            FROM addinggames 
            INNER JOIN game_list
            ON addinggames.list_id = game_list.list_id AND addinggames.entry_id = game_list.entry_id
            WHERE game_list.rating != 0
            GROUP BY addinggames.game_id) AS table1
            ON games.game_id = table1.g_id
            ORDER BY avg_rating DESC;";
            $g = new Database();
            $result=$g->read($query);
            return $result;

        }
        public function extract_currently_playing( $game_id )
        {
            $query = "select count(games.game_id) as count from games
            INNER JOIN addinggames
            ON games.game_id = addinggames.game_id
            INNER JOIN game_list
            ON game_list.list_id = addinggames.list_id and addinggames.entry_id = game_list.entry_id
            where games.game_id = '$game_id' and game_list.flag_currentlyplaying = 1;";
            $g = new Database();
            $result=$g->read($query);
            return $result;
        }
        
    }

?>


