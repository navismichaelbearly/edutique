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


if($messagetext != '')
{
      

	
	  $stmt = $mysqli->prepare("INSERT into edu_feedback (feedback,feed_status,feedback_published_date,user_id ,mag_id, article_id, activity_id, emotions) 
	            	values(?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssss", $param_feedback,$param_feed_status,$param_feedback_published_date,$param_user_id,$param_mag_id,$param_article_id,$param_activity_id,$param_emotions);  
	  	
	  $param_feedback = $messagetext;	  
	  $param_user_id = $_SESSION['id'];
	  $param_feed_status = $active;
	  $param_feedback_published_date = $todaysDate;
	  $param_mag_id = $_POST['mag_id'];
	  $param_article_id = $_POST['art_id'];
	  $param_activity_id = $_POST['act_id'];
	  $param_emotions = $_POST['emo'];
	  if($stmt->execute()){
	     echo "<script type='text/javascript'>$('#successfeedback').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					 });
                        
                       </script>";
	  }				   
	  $stmt->close();
 
				
}


?>