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

$content = $_POST['content'];
if(!empty($content)){
        $issue_no=explode(" ",$_POST['issue_no']);
$stmt = $mysqli->prepare("Select mag_id from edu_magazine where mag_type_id=? and mag_status=? and mag_issue=?");
		/* Bind parameters */
		$stmt->bind_param("sss", $param_mag_type_id,$param_mag_status,$param_mag_issue);
		/* Set parameters */
		$param_mag_type_id = $_POST["mag_type"];
		$param_mag_status = $active;
		$param_mag_issue = $issue_no[1];
		$stmt->execute();
		$stmt->bind_result($mag_id);
		$stmt->fetch();
		$stmt->close();
		
	    $stmt = $mysqli->prepare("INSERT into edu_article (article_title,article_published_date,mag_id,article_status,essay_type_id,article_path,article_image,article_content, 	article_style,audio_path,art_year,theme,genre,topic_words,audio_support ,fiction,difficulty_level,description,word_count ,author, last_modified) 
						values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");	
		  $stmt->bind_param("sssssssssssssssssssss", $param_article_title,$param_article_published_date,$param_mag_id,$param_article_status,$param_essay_type_id,$param_article_path,$param_article_image,$param_article_content, 	$param_article_style,$param_audio_path,$param_art_year,$param_theme,$param_genre,$param_topic_words,$param_audio_support ,$param_fiction,$param_difficulty_level,$param_description,$param_word_count ,$param_author,$param_last_modified);  
		  $param_article_title = $_POST['title'];
		  $param_article_published_date = $todaysDate;
		  $param_mag_id = $mag_id;
		  $param_article_status = $active;
		  $param_essay_type_id = $_POST['text_type'];
		  $param_article_path ='';
		  $param_article_image ='';
		  $param_article_content =$content;	
		  $param_article_style ='';
		  $param_audio_path ='';
		  $param_art_year = $_POST['art_year'];
		  $param_theme = $_POST['theme'];
		  $param_genre = $_POST['genre'];
		  $param_topic_words = $_POST['topic_words'];
		  $param_audio_support = $_POST['audio_support'];
		  $param_fiction = $_POST['fiction'];
		  $param_difficulty_level = $_POST['difficulty_level'];
		  $param_description = $_POST['description'];
		  $param_word_count = $_POST['word_count'];
		  $param_author = $_POST['author'];
		   $param_last_modified = $todaysDate;
		  $stmt->execute();
		  $stmt->close();
}
?>