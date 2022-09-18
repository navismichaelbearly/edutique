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

   
   
   
		
		
		if ($stmt = $mysqli->prepare("INSERT INTO edu_level_class_temp (levelname, class_name,level_id, class_id,school_id,user_id) SELECT b.level, group_concat(c.class_name),b.level_id, group_concat(c.class_id),a.school_id,a.user_id from edu_user_school_level_class a inner join edu_levels b on a.level_id=b.level_id inner join edu_class c on a.class_id = c.class_id where a.school_id= ? and a.user_id =? group by b.level_id order by c.class_name ASC")) {
			 
			 
					$stmt->bind_param("ss", $param_school_id, $param_user_id);
					 // Set parameters 
				    $param_school_id = $school_id;
				    $param_user_id = $_SESSION['id'];
			 
			
			 
			 $stmt->execute();
			 $stmt->close();
		}
		
		if ($stmt = $mysqli->prepare("SELECT levelname, class_name,level_id,class_id from edu_level_class_temp where school_id= ? and user_id =?")) {
	
	
		
		 $stmt->bind_param("ss", $param_school_id, $param_user_id);
			 // Set parameters 
		 $param_school_id = $school_id;
				    $param_user_id = $_SESSION['id'];	
		 
		 $stmt->execute();
			 /* bind variables to prepared statement */
		 $stmt->bind_result($level_name, $class_name,$level_id,$class_id);
		 $sr =1;
		 echo "<label for='Send To'>Send To:</label><br><table class='table' style='width:100%; background-color:transparent'>";
		 while ($stmt->fetch()) {
			  echo "<tr>
						  <td><input type='checkbox' id='checkAllitem' value='".$level_id."' name='levelname[]' /> ".$level_name."</td>
						  <td></td>
					  <tr>
					  <tr>";
					    /* $clssnames = explode(",", $class_name);
						 $clssid = explode(",", $class_id);
							foreach($clssnames as $index => $value) {
								
								echo "<td rowspan=1> &nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' id='checkAll' class='case".$clssid[$index]."' value='".$clssid[$index]."' name='classname[]' /> ".$clssnames[$index]." Class</td>";
							}
						  
						  
					  echo "</tr>							";*/
							$sr++;
		 }
				
		}
        	
       /* $stmt = $mysqli->prepare("Delete from edu_level_class_temp  where school_id= ? and user_id =?");
			 
			 
					$stmt->bind_param("ss", $param_school_id, $param_user_id);
					 // Set parameters 
				    $param_school_id = $school_id;
				    $param_user_id = $_SESSION['id'];
			 
			
			 
			 $stmt->execute();
			 $stmt->close();*/			
 
}




?>
