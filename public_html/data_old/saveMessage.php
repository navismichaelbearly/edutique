<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

if($_POST['messagetext'] !='');
	
{
	$var = $_POST['msgpId'];
	$stmt = $mysqli->prepare("SELECT from_id,to_id FROM  edu_messages  WHERE id = ?");
	/* Bind parameters */
	$stmt->bind_param("s", $param_mid);
	/* Set parameters */
	$param_mid = $var ;
	$stmt->execute();
	$stmt->bind_result($from_id, $to_id);
	$stmt->fetch();
	$stmt->close();echo $from_id;
	  $stmt = $mysqli->prepare("INSERT into edu_messages (message_content,from_id,to_id,parent_msg_id,status,publish_date,message_type,message_status) 
	            	values(?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssss",$param_message_content,$param_from_id,$param_to_id,$param_parent_msg_id,$param_status,$param_publish_date,$param_message_type,$param_message_status);  
	  $param_status	=$active;
	  $param_message_content = $_POST['messagetext'];	  
	  $param_from_id = $_SESSION['id'];
	  $param_to_id = $to_id;
	  $param_publish_date = $todaysDate;
	  $param_message_type = $nontech;
	  $param_message_status = $unresolved;
	  $param_parent_msg_id = $var;
	  $stmt->execute();
	  $stmt->close();
 
				
}
?>