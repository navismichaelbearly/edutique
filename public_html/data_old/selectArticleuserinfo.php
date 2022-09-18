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

if($_POST['notStff'] != '')
{
 
  
 if ($stmt = $mysqli->prepare("SELECT user_image_path FROM edu_users  where user_status=? and user_id=?")) {
     
     $stmt->bind_param("ss", $param_status, $param_user_id);
     
       
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_POST['userId'];
    
	 
	 $stmt->execute();
	 // bind variables to prepared statement 
	 $stmt->bind_result($col1);
	 while ($stmt->fetch()) {
	     echo "<span class='user' style='background-image:url(upload/" . $col1 . ");'></span>";
	 }
	 
 }						
 
 
}

if($_POST['stff'] !=""){
	if ($stmt = $mysqli->prepare("SELECT a.first_name,a.last_name,c.user_type FROM edu_users a INNER JOIN edu_question_portal b ON a.user_id=b.qp_by inner join edu_utype c on a.user_type_id=c.user_type_id where b.status=? and b.qp_by !=?  and b.id=? or b.parent_qp_id=?")) {
		 
		  $stmt->bind_param("ssss", $param_status, $param_user_id, $param_id, $param_parent_id);
    
       
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_SESSION["id"];
	 $param_id = $_POST['qpId'];
	 $param_parent_id = $_POST['qpId'];
		 
		
		 
		 $stmt->execute();
		 // bind variables to prepared statement 
		 $stmt->bind_result($col1,$col2,$col3);
		 $stmt->fetch();
		 echo $col3." ".$col2." ".$col1;
		 
		 
	}
}		



?>
