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

if($_POST['asssigned'] != '')
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
		
		if ($stmt = $mysqli->prepare("SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE assigned_by=? and a.activity_id=? GROUP BY b.task_id UNION SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE assigned_by=? and a.activity_id !=? GROUP BY b.task_id")) {    
		 
		  
		 $stmt->bind_param("ssss", $param_assigned_by,$param_actid,$param_assigned_by2,$param_actid2);
		 $param_assigned_by = $_SESSION['id'];	
		 $param_assigned_by2 = $_SESSION['id'];	
		 $param_actid =0;
		 $param_actid2=0;
		 
		 $stmt->execute();
		 /* bind variables to prepared statement */
		 $stmt->bind_result($task_id,$due_date, $article_title,$class_name,$level,$comp_count,$overd_count,$tottid, $article_id,$activity_id,$mag_id);
		 $sr =1;
		 echo "<br><br><label for='Assigned'>Assigned:</label><br>";
		 echo "<table  id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
											<thead>
												<tr>
													<th>Title</th>
													<th>Assigned to</th>
													<th>Unlock On</th>
													<th>Due Date</th>
													<th>Completed</th>
													<th>Overdue</th>
													<th>Average Score</th>
												</tr>
											</thead>
											<tbody>
											";
												
		 /* fetch values */
		 while ($stmt->fetch()) {
			  echo "<tr>";
			 	
			 $due_date1 = date("d M Y", strtotime($due_date));
			 $countcomp1 = $comp_count / $tottid;
			 $countcomp2 = $countcomp1 * 100;
			 $countcomp = number_format($countcomp2, 0);
			 
			 $countoverd1 = $overd_count / $tottid;
			 $countoverd2 = $countoverd1 * 100;
			 $countoverd = number_format($countoverd2, 0); 
			  if($activity_id == 0){
			     $magLink = "article-detail.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
			  }else{
			     $magLink = "activity-detail.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
			  }
			  if($task_id == 0) {$task_id="";
			  
			  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
			  }	else {
				   echo "<td><a href='".$magLink."'> " . $article_title . "</a></td>";	   
				   #echo "<td class='normaltext'>" . $level . " " . $class_name. " &nbsp;&nbsp;&nbsp;&nbsp;<a href='#' id='tlViewstud' data-id='" . $task_id ."'>View Students</a></td>";
				   echo "<td class='normaltext'>" . $level . " " . $class_name. " </td>";
				   echo "<td class='normaltext'></td>";
				   echo "<td class='normaltext'>" . $due_date1 . "</td>";
				   echo "<td class='normaltext'>" . $countcomp ."%</td>";
				   echo "<td class='normaltext'>" . $countoverd ."%</td>";
				   echo "<td class='normaltext'>-</td>";
				   echo "<td class='normaltext'><a class='material-icons annocom' style='text-decoration:none' id='tlDel' data-id='" . $task_id ."'>delete</a></td>";
			  }	
			  
				 echo "</tr>" ;
						$sr++;
		}
		
		echo "
											</tbody>    
										  </table>";
 }									
 
}

if($_POST['tl_id'] != '')
{
	$stmt = $mysqli->prepare("delete FROM edu_task where task_id=?");
	$stmt->bind_param("s", $param_task_id);
	$param_task_id = $_POST['tl_id'];
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("delete FROM edu_user_task where task_id=?");
	$stmt->bind_param("s", $param_task_id);
	$param_task_id = $_POST['tl_id'];
	$stmt->execute();
	$stmt->close();
}


?>
