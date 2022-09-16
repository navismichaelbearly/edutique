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


if($_POST['announceu'] != '')
{
 $stmt = $mysqli->prepare("SELECT noti_title,user_id FROM edu_noti where noti_id=?");
	/* Bind parameters */
	$stmt->bind_param("s", $param_noti_id);
	/* Set parameters */
	$param_noti_id = $_POST['notiId'];
	
	$stmt->execute();
	$stmt->bind_result($noti_title, $user_id);
	$stmt->fetch();
	$stmt->close();
	
	$stmt = $mysqli->prepare("SELECT a.school_id FROM edu_user_school_level_class a inner join edu_school where user_id=?");
	/* Bind parameters */
	$stmt->bind_param("s", $param_user_id);
	/* Set parameters */
	$param_user_id = $user_id;
	
	$stmt->execute();
	$stmt->bind_result($school_id);
	$stmt->fetch();
	$stmt->close();
	 
 if ($stmt = $mysqli->prepare("SELECT noti_title,noti_published_date,noti_content,noti_id, added_by, first_name, last_name  FROM edu_noti a inner join edu_users b on a.user_id=b.user_id inner join edu_user_school_level_class c on b.user_id=c.user_id  where noti_status=? and added_by !=? and school_id=? and noti_title=?")) {
    
       $stmt->bind_param("ssss", $param_noti_status, $param_added_by, $param_school_id, $param_noti_title);
			        $param_noti_status = $active;	
			        $param_added_by = 1;
					$param_school_id = $school_id;
					$param_noti_title= $noti_title;
    
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($noti_title,$noti_published_date, $noti_content, $noti_id, $added_by, $first_name, $last_name);
	 $sr =1;
	 
	 	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
	 
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Student Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>	
										";	
									
	 /* fetch values */
	 while ($stmt->fetch()) {
	      
		 	
		 	
	     
		  
		  echo "<tr><td class='normaltext'>" . $sr . "</td>";
		 
		  
		  echo "<td class='normaltext'>" . $last_name ." ".$first_name. "</td></tr>";
					$sr++;
	}
	 echo "</tbody></table>";
 }						
 
}
?>
