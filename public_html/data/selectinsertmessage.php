<?php
session_start(); /*Session Start*/
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
}


/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
include '../inc/functions.php';

/* posted variables from Ajax call */
$messagetext = $_POST['messagetext'];
$messagetitle = $_POST['messagetitle'];

if($messagetext != '')
{
 

	
	  $stmt = $mysqli->prepare("INSERT into edu_messages (message_title,message_content,from_id,to_id,parent_msg_id,status,publish_date,message_type,message_status,date_resolved) 
	            	values(?,?,?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssssss", $param_message_title,$param_message_content,$param_from_id,$param_to_id,$param_status,$param_publish_date,$param_message_type,$param_message_status,$param_date_resolved);  
	 
	  $param_message_title = $messagetitle;	
	  $param_message_content = $messagetext;	  
	  $param_from_id = $_SESSION['id'];
	  $param_to_id = $admtchconst;
	  $param_status = $active;
	  $param_publish_date = $todaysDate;
	  $param_message_type = $nontech;
	  $param_message_status = $unresolved;
	  $param_date_resolved = $todaysDate;
	  $stmt->execute();
	  $stmt->close();
 
				
}


?>
