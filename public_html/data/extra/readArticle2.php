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

/*if($_POST['unreadArticle'] !='' && $_POST['readArticlechecked'] =='');
	
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

if($_POST['readArticlechecked'] !='' );
	
{
        $stmt = $mysqli->prepare("SELECT task_stages FROM  edu_user_task WHERE article_id = ? and school_id = ? and assigned_to =? and mag_id=?");
		/* Bind parameters */
		$stmt->bind_param("ssss", $param_article_id,$param_school_id,$param_assigned_to,$param_mag_id); 
	    $param_article_id = $_POST["art_id"];
	    $param_school_id = $school_id; 
	    $param_assigned_to = $_SESSION["id"];
		$param_mag_id = $_POST["magazineID"];
		$stmt->execute();
		$stmt->bind_result($task_stages);
		$stmt->fetch();
		if($task_stages == 'Completed'){ $chk = 'checked';
		echo "<input type='checkbox' id='readArticle' ".$chk."> Read Article";
		} else { $chk='';
		echo "<input type='checkbox' id='readArticle' ".$chk."> Read Article";
		} 
		
		$stmt->close();
	
				
}
?>