<?php
error_reporting(-1);
ini_set('display_errors', true);
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
$announcementLog = !empty($_POST['announcementLog'])?$_POST['announcementLog']:0;
$announcementLogschool = !empty($_POST['announcementLogschool'])?$_POST['announcementLogschool']:0;
if($_SESSION["utypeid"]==$admconst){
   if($announcementLog == 1)
	{
			
			
			if ($stmt = $mysqli->prepare("SELECT noti_title,noti_published_date,noti_content,noti_id, added_by, first_name, last_name  FROM edu_noti a inner join edu_users b on a.added_by=b.user_id  where noti_status=? and added_by !=?  group by noti_title")) {    
			 
			  
			 $stmt->bind_param("ss", $param_noti_status, $param_added_by);
			 $param_noti_status = $active;	
			 $param_added_by = 1;
			 $stmt->execute();
			 /* bind variables to prepared statement */
			 $stmt->bind_result($noti_title,$noti_published_date, $noti_content, $noti_id, $added_by, $first_name, $last_name);
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th><th>No.</th>
														<th>Announcement Title</th>
														<th>Detail</th>
														<th>Posted By</th>
														<th>Posted To</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			 while ($stmt->fetch()) { $newDate = date("d M Y", strtotime($noti_published_date));
				  echo "<tr>";
					
				       echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $noti_id . "'>";
		               echo "<td>" . $sr . "</td>";	
					   echo "<td class='normaltext'>" . stripslashes($noti_title) . "</td>";
					   echo "<td class='normaltext'>" . stripslashes($noti_content) ."</td>";
					   echo "<td class='normaltext'>" . $last_name ." ".$first_name."</td>"; 
					   echo "<td class='normaltext'><a href='view-student-list.php?notiID=".$noti_id."'>View List</a></td>";
					   echo "<td class='normaltext'>" . $newDate ."</td>";
				 
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	 
	}
	
	if($announcementLogschool == 1){
		if($_POST['schoolid']=='Allschool'){
		  $var ="SELECT noti_title,noti_published_date,noti_content,noti_id, added_by, first_name, last_name  FROM edu_noti a inner join edu_users b on a.added_by=b.user_id  where noti_status=? and added_by !=?  group by noti_title";
		}else {
		  $var ="SELECT noti_title,noti_published_date,noti_content,noti_id, added_by, first_name, last_name  FROM edu_noti a inner join edu_users b on a.added_by=b.user_id inner join edu_user_school_level_class c on b.user_id=c.user_id  where noti_status=? and added_by !=? and school_id=? group by noti_title";
		}
		if ($stmt = $mysqli->prepare($var)) {    
			 
			  if($_POST['schoolid']=='Allschool'){
				   $stmt->bind_param("ss", $param_noti_status, $param_added_by);
			       $param_noti_status = $active;	
			       $param_added_by = 1; 
				}else {
				    $stmt->bind_param("sss", $param_noti_status, $param_added_by, $param_school_id);
			        $param_noti_status = $active;	
			        $param_added_by = 1;
					$param_school_id = $_POST['schoolid'];
				}
			
				
			 
			 
			 $stmt->execute();
			 /* bind variables to prepared statement */
			$stmt->bind_result($noti_title,$noti_published_date, $noti_content, $noti_id, $added_by, $first_name, $last_name);
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th><th>No.</th>
														<th>Announcement Title</th>
														<th>Detail</th>
														<th>Posted By</th>
														<th>Posted To</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			 while ($stmt->fetch()) { $newDate = date("d M Y", strtotime($noti_published_date));
				  echo "<tr>";
					
				       echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $noti_id . "'>";
		               echo "<td>" . $sr . "</td>";	
					   echo "<td class='normaltext'>" . stripslashes($noti_title) . "</td>";
					   echo "<td class='normaltext'>" . stripslashes($noti_content) ."</td>";
					   echo "<td class='normaltext'>" . $last_name ." ".$first_name."</td>"; 
					   echo "<td class='normaltext'><a href='view-student-list.php?notiID=".$noti_id."'>View List</a></td>";
					   echo "<td class='normaltext'>" . $newDate ."</td>";
				 
					 echo "</tr>" ;
							$sr++;
			}
			
				  
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	}



?>
