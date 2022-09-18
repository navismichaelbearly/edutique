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

if($_POST['artDetail'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT editors_note from edu_magazine a inner join edu_school_subscription b on a.mag_id=b.mag_id  where a.mag_status=? and b.school_subscription_status=? and b.school_id= ? and a.mag_id=?")) {
	
	
		
	 $stmt->bind_param("ssss", $param_article_status, $param_school_subscription_status, $param_school_id, $param_mag_id);
		 // Set parameters 
	 $param_article_status = $active;
	 $param_school_subscription_status = $active;
	 $param_school_id = $school_id;
	 $param_mag_id = $_POST["mag_id"];
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($editors_note);
	 $stmt->fetch();
	 echo "<div align='center' class='pageTitlenew'>Editors Note</div><br>";
	 echo $editors_note;
     $stmt->close();
        	
	}
}







?>