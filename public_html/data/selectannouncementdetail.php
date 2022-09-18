<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

if($_POST['userId'] != '')
{
  
 if ($stmt = $mysqli->prepare("SELECT noti_title,noti_published_date,noti_content,added_by,first_name,last_name FROM edu_noti a inner join edu_users b on a.added_by=b.user_id where noti_status=? and a.user_id=? and noti_id=?")) {
    
       $stmt->bind_param("sss", $param_status, $param_user_id, $param_noti_id);
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_POST['userId'];
	 $param_noti_id = $_POST['noti_id'];
    
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($col1, $col2,$col3,$added_by, $first_name, $last_name);
	 $sr =1;
	 /* fetch values */
	 while ($stmt->fetch()) {
	      
		 	
		  $newDate = date("d M Y", strtotime($col2));		
	     
		  
		  echo "<div class='panel panel-default'><div class='panel-heading'>
                                     " . stripslashes($col1) . "
                                    <div class='pull-right'>
                                        <div class='btn-group'>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-heading -->
                                <div class='panel-body' >
                                     
									 <table >
									 <tr>
											<td class='normaltext'>Posted By Teacher " . $last_name . "  " . $first_name . ", " . $newDate . "</td>
                                     </tr>
                                    <tr><td class='normaltext'>" . stripslashes($col3) . "</td></tr></table><br>
                                </div></div>";
					$sr++;
	}
 }						
 
}
?>
