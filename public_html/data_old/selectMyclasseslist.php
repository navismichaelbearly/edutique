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
include "userSchoolinfo.php";



if($_POST['myClasses'] != '')
{
  $stmt = $mysqli->prepare("SELECT COUNT(DISTINCT(b.level)) as levelcount from edu_user_school_level_class a inner join edu_levels b on a.level_id=b.level_id where a.school_id= ? and a.user_id =?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_school_id, $param_user_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_user_id = $_SESSION['id'];
	$stmt->execute();
	$stmt->bind_result($levelcount);
	$stmt->fetch();
	$stmt->close();
	
  
	 echo "<div class='scrolls2'>";
		          
	for ($x = 1; $x <= $levelcount; $x++) {
	     
	     echo  "<div class='col-lg-3'>Sec ".$x."<br>";  
		 if ($stmt = $mysqli->prepare("SELECT b.level, c.class_name from edu_user_school_level_class a inner join edu_levels b on a.level_id=b.level_id inner join edu_class c on a.class_id = c.class_id where a.school_id= ? and a.user_id =? and b.level=?")) {
	
	
		
	$stmt->bind_param("sss", $param_school_id, $param_user_id, $param_lvl_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_user_id = $_SESSION['id'];
	 $param_lvl_id = "Secondary ".$x;
	 $stmt->execute();
	 $stmt->store_result();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($level,$class_name);
	 $sr =1;
	 while ($stmt->fetch()) {
	     
	      
				      echo "<span>".$class_name."</span><br>";
		
		 $sr++;
	 }		     
		
	}
	echo "</div> ";
  }
      
	   
				echo "</div>";  	
	
}


?>