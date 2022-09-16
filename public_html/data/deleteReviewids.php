<?php
	//submit_rating.php

error_reporting(-1);
ini_set('display_errors', true);
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

	if(isset($_POST['id'])) {
		$id = trim($_POST['id']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_review WHERE review_id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		$stmt->execute();
		$stmt->close();
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}
?>
