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

if($_POST['asssignInfo'] != '')
{
		$stmt = $mysqli->prepare("Select a.school_name, b.level, c.class_name, a.school_id, b.level_id, c.class_id  from edu_school a inner join edu_levels b on a.school_id= b.school_id inner join edu_class c on b.level_id= c.level_id inner join edu_school_subscription d on a.school_id= d.school_id where d.user_id=? and d.school_subscription_status=? group by d.user_id");
		/* Bind parameters */
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_name, $level_name, $class_name, $school_id, $level_id, $class_id);
		$stmt->fetch();
		$stmt->close();
		
		if ($stmt = $mysqli->prepare("Select a.first_name, a.last_name, a.user_id from edu_users a inner join edu_school_subscription b on a.user_id = b.user_id inner join edu_user_school_level_class c on b.user_id = c.user_id where c.school_id =? and c.level_id = ? and c.class_id=? and a.user_type_id=? and b.school_subscription_status=? group by c.user_id")) {
			 
			 
					$stmt->bind_param("sssss", $param_school_id,$param_level_id,$param_class_id, $param_user_type_id, $param_school_subscription_status);
					$param_school_id = $school_id;
					$param_level_id = $level_id;
					$param_class_id = $class_id;
					$param_user_type_id = 3;
					$param_school_subscription_status  = $active;
			 
			
			 
			 $stmt->execute();
			 /* bind variables to prepared statement */
			 $stmt->bind_result($first_name, $last_name, $user_idstud);
			 $sr =1;
			 echo "<label for='Assign To'>Assign To:</label><br><table class='table table-bordered' style='width:100%; background-color:transparent'>
					  <tr>
						  <td><input type='checkbox' id='checkAllitem' value='".$level_id."' name='levelname' /> ".$level_name."</td>
						  <td></td>
					  <tr>
					  <tr>
						  
						  <td rowspan=1> &nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' id='checkAll' class='case' value='".$class_id."' name='classname' /> ".$class_name." Class</td>
					  </tr>							";
													
			 /* fetch values */
			 while ($stmt->fetch()) {
				  
				  
				  echo "<tr><td rowspan=1> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' class='case'  value='".$user_idstud."' name='users[]' /> ".$first_name." ".$last_name."</td></tr>";
							$sr++;
			}
			
			echo "</table>";
		 }						
 
}




?>
