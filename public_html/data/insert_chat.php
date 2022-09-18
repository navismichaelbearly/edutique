<?php

//insert_chat.php

require_once "../inc/config.php";
include "../inc/constants.php";

session_start();

/*$data = array(
	':to_user_id'		=>	$_POST['to_user_id'],
	':from_user_id'		=>	$_SESSION['user_id'],
	':chat_message'		=>	$_POST['chat_message'],
	':status'			=>	'1'
);

$query = "
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES (:to_user_id, :from_user_id, :chat_message, :status)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
	echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
}*/

$stmt = $mysqli->prepare("INSERT INTO edu_chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES (?, ?, ?, ?)");	
	  $stmt->bind_param("ssss", $param_to_user_id,$param_from_user_id,$param_chat_message,$param_status);  
	  $param_to_user_id = $_POST['to_user_id'];	  
	  $param_from_user_id = $_SESSION['id'];
	  $param_chat_message = $_POST['chat_message'];
	  $param_status = '1';
	  if($stmt->execute())
		{
			echo fetch_user_chat_history($_SESSION['id'], $_POST['to_user_id'], $mysqli);
		}

?>