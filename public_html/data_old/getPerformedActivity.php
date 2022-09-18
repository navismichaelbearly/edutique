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

$actDetail = !empty($_POST['actDetail'])?$_POST['actDetail']:0;
$marksAdd = !empty($_POST['marksAdd'])?$_POST['marksAdd']:0;

if($actDetail ==1)
{
  if ($stmt = $mysqli->prepare("SELECT a.answer, total from edu_activity_result a inner join edu_school_subscription b on a.activity_id=b.activity_id  where  a.activity_id=? and a.user_id=? order by activity_result_id Desc")) {
	
	
		
	 $stmt->bind_param("ss", $param_activity_id, $param_user_id);
		 // Set parameters 
	 $param_activity_id = $_POST['act_id'];
	 $param_user_id = $_POST['addedBy'];
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($answer,$totalmarks);
	 $stmt->fetch();
	 echo "<br><br><div class='row'><div class='col-lg-11'><textarea class='form-control' rows='30' disabled>".$answer."</textarea></div><div class='col-lg-1'>".$totalmarks." Marks</div></div>";
	
     $stmt->close();
        	
	}
}

if($marksAdd ==1)
{
  $stmt = $mysqli->prepare("UPDATE edu_activity_result 
SET correct = ?
WHERE user_id = ? and activity_id=?");	
	  $stmt->bind_param("sss", $param_correct,$param_user_id,$param_activity_id);    
	  $param_correct = $_POST['marksobtained'];
	  $param_user_id =$_POST['addedBy'];
	  $param_activity_id =$_POST['act_id'];
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();

}







?>