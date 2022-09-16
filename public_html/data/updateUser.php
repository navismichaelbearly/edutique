<?php

//update_is_type_status.php

require_once "../inc/config.php";
include "../inc/constants.php";

session_start();

/*$query = "
UPDATE login_details 
SET is_type = '".$_POST["is_type"]."' 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();*/
if($_POST['checkedassignedReading'] != ''){
$stmt = $mysqli->prepare("UPDATE edu_users 
SET assigned_article_notify = ?
WHERE user_id = ?");	
	  $stmt->bind_param("ss", $param_assigned_article_notify,$param_user_id);    
	  $param_assigned_article_notify = $_POST["checkedassignedReading"];
	  $param_user_id =$_SESSION['id'];
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
}

if($_POST['checkedassignedActivity'] != ''){
$stmt = $mysqli->prepare("UPDATE edu_users 
SET assigned_activity_notify = ?
WHERE user_id = ?");	
	  $stmt->bind_param("ss", $param_assigned_activity_notify,$param_user_id);    
	  $param_assigned_activity_notify = $_POST["checkedassignedActivity"];
	  $param_user_id =$_SESSION['id'];
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
}

if($_POST['checkedreviewActivity'] != ''){
$stmt = $mysqli->prepare("UPDATE edu_users 
SET assigned_activity_review_notify = ?
WHERE user_id = ?");	
	  $stmt->bind_param("ss", $param_assigned_activity_review_notify,$param_user_id);    
	  $param_assigned_activity_review_notify = $_POST["checkedreviewActivity"];
	  $param_user_id =$_SESSION['id'];
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
}
?>