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

if($_POST['mesageStatusval'] != '')
{
  
 /*  update query for tooltip */
 $stmt = $mysqli->prepare("UPDATE edu_messages SET message_status = ?, date_resolved=? WHERE message_type = ?");
 /* Bind parameters */
 $stmt->bind_param("sss", $param_message_status,$param_date_resolved, $param_message_type);
 /* Set parameters */
 $param_message_status = $resolved;
 $param_date_resolved = $todaysDate;
 $param_message_type =  $_POST['messagelog'];
 if($stmt->execute()){
 }
 else {
	   echo "Oops! Something went wrong. Please try again later.";
 }			
 
}

if($_POST['techStatusval'] != '')
{
  
 /*  update query for tooltip */
 $stmt = $mysqli->prepare("UPDATE edu_messages SET message_status = ?, date_resolved=? WHERE message_type = ?");
 /* Bind parameters */
 $stmt->bind_param("sss", $param_message_status,$param_date_resolved, $param_message_type);
 /* Set parameters */
 $param_message_status = $resolved;
 $param_date_resolved = $todaysDate;
 $param_message_type =  $_POST['messagelog'];
 if($stmt->execute()){
 }
 else {
	   echo "Oops! Something went wrong. Please try again later.";
 }			
 
}
?>
