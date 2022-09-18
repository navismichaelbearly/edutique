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
$art_del_id = !empty($_POST['art_del_id'])?$_POST['art_del_id']:0;
$art_del_id_dummy = !empty($_POST['art_del_id_dummy'])?$_POST['art_del_id_dummy']:0;

if($art_del_id > 0)
{
    
	$stmt = $mysqli->prepare("delete FROM edu_article where article_id=?");
	$stmt->bind_param("s", $param_article_id);
	$param_article_id = $art_del_id;
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("delete FROM edu_article_audio where article_id=?");
	$stmt->bind_param("s", $param_article_id);
	$param_article_id = $art_del_id;
	$stmt->execute();
	$stmt->close();
}

if($art_del_id_dummy > 0)
{
    
	$stmt = $mysqli->prepare("delete FROM edu_article_dummy where article_id=?");
	$stmt->bind_param("s", $param_article_id);
	$param_article_id = $art_del_id_dummy;
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("delete FROM edu_article_audio_dummy where article_id=?");
	$stmt->bind_param("s", $param_article_id);
	$param_article_id = $art_del_id_dummy;
	$stmt->execute();
	$stmt->close();
}
?>
