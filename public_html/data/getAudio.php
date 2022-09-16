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

if($_POST['aud'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.audio_path from edu_article a inner join edu_school_subscription b on a.article_id=b.article_id  where a.article_status=? and b.school_subscription_status=? and b.school_id= ? and a.article_id=? ")) {
	
	
		
	 $stmt->bind_param("ssss", $param_article_status, $param_school_subscription_status, $param_school_id, $param_article_id);
		 // Set parameters 
	 $param_article_status = $active;
	 $param_school_subscription_status = $active;
	 $param_school_id = $school_id;
	 $param_article_id = $_POST['art_id'];
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($audio_path);
	 $stmt->fetch();
	 echo "<audio  preload='auto' controls >
	  <source src='".$audio_path."'>
	  </audio>";
	 
	 
     $stmt->close();
        	
	}
}




?>