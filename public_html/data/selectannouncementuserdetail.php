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
if($_POST['announce'] != '')
{
  
 if ($stmt = $mysqli->prepare("SELECT Distinct(noti_title),noti_published_date,noti_content,added_by,first_name,last_name FROM edu_noti a inner join edu_users b on a.added_by=b.user_id where noti_status=?  and noti_title=? limit 1")) {
    
       $stmt->bind_param("ss", $param_status,  $param_noti_id);
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_POST['userId'];
	 $param_noti_id = addslashes($_POST['noti_t']);
    
	 
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
											<td class='normaltext' style='color:#292a2c'>Posted By " . $last_name . "  " . $first_name . ", " . $newDate . "</td>
                                     </tr>
                                    <tr><td class='normaltext'>" . stripslashes($col3) . "</td></tr></table><br>
                                </div></div>";
					$sr++;
	}
 }						
 
}

if($_POST['announceu'] != '')
{
  
 if ($stmt = $mysqli->prepare("SELECT noti_title,noti_published_date,noti_content,added_by,first_name,last_name,user_type_id FROM edu_noti a inner join edu_users b on a.user_id=b.user_id where noti_status=?  and noti_title=?")) {
    
       $stmt->bind_param("ss", $param_status,  $param_noti_id);
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_POST['userId'];
	 $param_noti_id = addslashes($_POST['noti_t']);
    
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($col1, $col2,$col3,$added_by, $first_name, $last_name, $user_type_id);
	 $sr =1;
	 if($_SESSION["utypeid"]==$admconst){
	     echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
	 
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>	
										";	
	 }else {
	 	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
	 
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Student Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>	
										";	
		}								
	 /* fetch values */
	 while ($stmt->fetch()) {
	      
		 	
		 	if($user_type_id == $admtchconst){
			   $teachVar = "(Class Teacher)";
			}else if($user_type_id == $admprogtchconst){
			  $teachVar = "(Teacher Incharge of the Programme)";
			}else {
			  $teachVar = "";
			}   
	     
		  
		  echo "<tr><td class='normaltext'>" . $sr . "</td>";
		 
		  
		  echo "<td class='normaltext'>" . $last_name ." ".$first_name.$teachVar. "</td></tr>";
					$sr++;
	}
	 echo "</tbody></table>";
 }						
 
}
?>
