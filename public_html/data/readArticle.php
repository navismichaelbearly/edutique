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

if($_POST['readArticlenew'] !='');
	
{
        $stmt = $mysqli->prepare("SELECT b.school_id FROM  edu_users a inner join edu_user_school_level_class b on a.user_id  = b.user_id  WHERE a.user_id = ? and a.user_status = ?");
		/* Bind parameters */
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_id);
		$stmt->fetch();
		$stmt->close();
	  
	 	
	  $stmt = $mysqli->prepare("UPDATE edu_user_task as UE  
    INNER JOIN edu_task As ED 
        ON UE.task_id = ED.task_id SET task_stages  = ?, completed_date=? WHERE article_id = ? and school_id = ? and assigned_to = ? and mag_id = ? and activity_id=?");	
	  $stmt->bind_param("sssssss", $param_task_stages,$param_completed_date,$param_article_id,$param_school_id,$param_assigned_to, $param_mag_id, $param_activity_id);    
	  $param_task_stages = $completed;
	  $param_completed_date = $todaysDate;
	  $param_article_id = $_POST["art_id"];
	  $param_school_id = $school_id; 
	  $param_assigned_to = $_SESSION["id"];
	  $param_mag_id = $_POST["mag_id"];
	  $param_activity_id = 0;
	  $stmt->execute();
	  $stmt->close();
 
				
}

/*if($_POST['unreadArticle'] !='');
	
{
        $stmt = $mysqli->prepare("SELECT b.school_id FROM  edu_users a inner join edu_user_school_level_class b on a.user_id  = b.user_id  WHERE a.user_id = ? and a.user_status = ?");
		
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_id);
		$stmt->fetch();
		$stmt->close();
		
	  $stmt = $mysqli->prepare("UPDATE edu_user_task SET task_stages  = ? WHERE article_id = ? and school_id = ? and assigned_to =?");	
	  $stmt->bind_param("ssss", $param_task_stages,$param_article_id,$param_school_id,$param_assigned_to);    
	  $param_task_stages = $incomplete;
	  $param_article_id = $_POST["art_id"];
	  $param_school_id = $school_id; 
	  $param_assigned_to = $_SESSION["id"];
	  $stmt->execute();
	  $stmt->close();
 
				
}*/


?>