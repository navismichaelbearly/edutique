<?php

//fetch_user_chat_history.php

require_once "../inc/config.php";
include "../inc/constants.php";

session_start();

echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $mysqli);

?>