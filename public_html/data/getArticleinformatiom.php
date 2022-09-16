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


$artDetail = !empty($_POST['artDetail'])?$_POST['artDetail']:0;
if($artDetail > 0)
{
  if ($stmt = $mysqli->prepare("SELECT a.article_title, a.theme,a.author, a.topic_words,a.art_year,a.difficulty_level,b.essay_type, c.mag_issue, d.mag_type from edu_article a inner join edu_essay_type b on a.essay_type_id=b.essay_type_id inner join edu_magazine c on a.mag_id=c.mag_id inner join edu_mag_type d on c.mag_type_id=d.mag_type_id  where a.article_status=? and a.article_id=? and a.mag_id=?")) {
	
	
		
	 $stmt->bind_param("sss", $param_article_status, $param_article_id, $param_mag_id);
		 // Set parameters 
	 $param_article_status = $active;
	 $param_article_id = $_POST['art_id'];
	 $param_mag_id = $_POST["mag_id"];
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_title, $theme,$author, $topic_words,$art_year,$difficulty_level, $essay_type, $mag_issue, $mag_type);
	 $stmt->fetch();
	 echo "<br><div align='justify'>".$mag_type. " Issue ".$mag_issue."</div>";
	 echo "<div align='justify'>".$theme."</div>";
	 echo "<div align='left'  class='normaltext'><b style='color:#323c47;'>Title: </b> ".$article_title."</div>";
	 echo "<div align='left' class='normaltext'><b style='color:#323c47;'>Author: </b> ".$author."</div>";
	 echo "<div align='left' class='normaltext'><b style='color:#323c47;'>Essay Type: </b> ".$essay_type."</div>";
	 echo "<div align='left' class='normaltext'><b style='color:#323c47;'>Keywords: </b> ".$topic_words."</div>";
	 echo "<div align='left' class='normaltext'><b style='color:#323c47;'>Difficulty: </b> ".$difficulty_level."</div>";
     $stmt->close();
        	
	}
}






?>