<?php

    class ViewDetails
    {
        public function create_session($game_id)
        {
            session_start();
            $_SESSION['game_id']=$game_id;
            header("Location: game_detail.php");
            die;
        }
    }

?>
