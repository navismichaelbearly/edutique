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



if($_POST['actDetail'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.activity_content, a.activity_html from edu_activity a  where a.activity_status=?  and a.article_id=? and a.mag_id=? and a.activity_id=?")) {
	
	
		
	 $stmt->bind_param("ssss", $param_article_status, $param_article_id, $param_mag_id, $param_activity_id);
		 // Set parameters 
	 $param_article_status = $active;
	 $param_article_id = $_POST['art_id'];
	 $param_mag_id = $_POST["mag_id"];
	 $param_activity_id = $_POST["act_id"];
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_content,$activity_html);
	 $stmt->fetch();
	 echo $activity_content;
	 echo $activity_html;
     $stmt->close();
        	
	}
}

if($_POST['actDetailcss'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.activity_style from edu_activity a  where a.activity_status=? and a.article_id=? and a.mag_id=? and a.activity_id=?")) {
	
	
		
	 $stmt->bind_param("ssss", $param_article_status, $param_article_id, $param_mag_id, $param_activity_id);
		 // Set parameters 
	 $param_article_status = $active;
	 $param_article_id = $_POST['art_id'];
	 $param_mag_id = $_POST["mag_id"];
	 $param_activity_id = $_POST["act_id"];
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_style);
	 $stmt->fetch();
	 echo $activity_style;
     $stmt->close();
        	
	}
}





?>