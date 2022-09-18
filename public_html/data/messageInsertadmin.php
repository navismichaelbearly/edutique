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
$refID = $_POST['refID'];

if($messagetext != '')
{
      
    $stmt = $mysqli->prepare("SELECT message_title,from_id,to_id FROM edu_messages where id=? and parent_msg_id=?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_id,$param_parent_msg_id);
	/* Set parameters */
	$param_id = $refID;
	$param_parent_msg_id = 0;
	
	$stmt->execute();
	$stmt->bind_result($message_title, $from_id, $to_id);
	$stmt->fetch();
	$stmt->close();
	
	  $stmt = $mysqli->prepare("INSERT into edu_messages (message_title,message_content,from_id,to_id,status,publish_date, message_type,message_status,date_resolved,parent_msg_id) 
	            	values(?,?,?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssssss", $param_message_title,$param_message_content,$param_from_id,$param_to_id,$param_status,$param_publish_date,$param_message_type,$param_message_status,$param_date_resolved,$param_parent_msg_id);  
	  $param_message_title = $message_title;	
	  $param_message_content = $messagetext;	  
	  $param_from_id = $_SESSION['id'];
	  $param_status = $active;
	  $param_publish_date = $todaysDate;
	  $param_message_type = $nontech;
	  $param_message_status = '';
	  $param_to_id = $from_id;
	  $param_date_resolved='';
	  $param_parent_msg_id=$refID;
	  if($stmt->execute()){
	      $stmt = $mysqli->prepare("UPDATE edu_messages SET message_status = ?, date_resolved=? WHERE message_type = ? and id=?");
		 /* Bind parameters */
		 $stmt->bind_param("ssss", $param_message_status,$param_date_resolved, $param_message_type, $param_id);
		 /* Set parameters */
		 $param_message_status = $resolved;
		 $param_date_resolved = $todaysDate;
		 $param_message_type =  $nontech;
		 $param_id = $refID;
		 $stmt->execute();
	  }
 
				
}


?>
