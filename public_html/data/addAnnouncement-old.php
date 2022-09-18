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

if($_POST['asssignInfo'] != '')
{

   
   
   
		
		
		if ($stmt = $mysqli->prepare("INSERT INTO edu_level_class_temp (level, class_name,level_id, class_id) SELECT b.level, group_concat(c.class_name),b.level_id, group_concat(c.class_id) from edu_user_school_level_class a inner join edu_levels b on a.level_id=b.level_id inner join edu_class c on a.class_id = c.class_id where a.school_id= ? and a.user_id =? group by b.level_id order by c.class_name ASC")) {
			 
			 
					$stmt->bind_param("ss", $param_school_id, $param_user_id);
					 // Set parameters 
				    $param_school_id = $school_id;
				    $param_user_id = $_SESSION['id'];
			 
			
			 
			 $stmt->execute();
			 
			 /*$stmt->bind_result($level_name, $class_name,$level_id,$class_id);
			 $sr =1;
			 echo "<label for='Send To'>Send To:</label><br><table class='table table-bordered' style='width:100%; background-color:transparent'>";
													
			 
			 while ($stmt->fetch()) {
				  
				  
				  echo "<tr>
						  <td><input type='checkbox' id='checkAllitem' value='".$level_id."' name='levelname' /> ".$level_name."</td>
						  <td></td>
					  <tr>
					  <tr>
						  
						  <td rowspan=1> &nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' id='checkAll' class='case' value='".$class_id."' name='classname' /> ".$class_name." Class</td>
					  </tr>							";
							$sr++;
			}
			
			echo "</table>";*/
		 }						
 
}




?>
