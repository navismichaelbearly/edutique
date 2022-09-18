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



if($_POST['artDetail'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.article_content,a.article_title from edu_article a  where a.article_status=? and a.article_id=? and a.mag_id=?")) {
	
	
		
	 $stmt->bind_param("sss", $param_article_status, $param_article_id, $param_mag_id);
		 // Set parameters 
	 $param_article_status = $active;
	 $param_article_id = $_POST['art_id'];
	 $param_mag_id = $_POST["mag_id"];
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_content, $article_title);
	 $stmt->fetch();
	 echo "<div align='center' class='pageTitlenew'>".$article_title. "</div><br>";
	 echo $article_content;
     $stmt->close();
        	
	}
}

if($_POST['artDetailcss'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT article_style from edu_article where article_status=? and article_id=? and mag_id=?")) {
	
	
		
	 $stmt->bind_param("sss", $param_article_status, $param_article_id, $param_mag_id);
		 // Set parameters 
	 $param_article_status = $active;
	 $param_article_id = $_POST['art_id'];
	 $param_mag_id = $_POST["mag_id"];
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_style);
	 $stmt->fetch();
	 echo $article_style;
     $stmt->close();
        	
	}
}





?>