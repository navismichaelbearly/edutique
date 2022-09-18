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
/*$stmt = $mysqli->prepare("Select a.school_name, b.level, c.class_name, a.school_id, b.level_id, c.class_id  from edu_school a inner join edu_levels b on a.school_id= b.school_id inner join edu_class c on b.level_id= c.level_id inner join edu_school_subscription d on a.school_id= d.school_id where d.user_id=? and d.school_subscription_status=? group by d.user_id");
		
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_name, $level_name, $class_name, $school_id, $level_id, $class_id);
		$stmt->fetch();
		$stmt->close();*/
		

		
if($_POST['asssigned'] != '' || $_POST['selectTaskid'] == 'All' || $_POST['levelclassid'] == 'Allclasses')
{
		
		
		if ($stmt = $mysqli->prepare("SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id=? GROUP BY b.task_id UNION SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE  a.activity_id !=? GROUP BY b.task_id")) {    
		 
		  
		 $stmt->bind_param("ss", $param_actid,$param_actid2);
		 $param_actid =0;
		 $param_actid2=0;
		 
		 $stmt->execute();
		  $result = $stmt->get_result();
		 /* bind variables to prepared statement */
		// $stmt->bind_result($task_id,$due_date, $article_title,$class_name,$level,$comp_count,$overd_count,$tottid, $article_id,$activity_id,$mag_id, $assigned_by);
		 $sr =1;
		 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
											<thead>
												<tr>
													<th>Title</th>
													<th>Assigned to</th>
													<th>Assigned by</th>
													<th>Unlock On</th>
													<th>Due Date</th>
													<th>Completed</th>
													<th>Overdue</th>
													<th>Average Score</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											";
												
		 /* fetch values */
		 while ($row = $result->fetch_assoc()) {
		      $stmt1 = $mysqli->prepare("SELECT first_name, last_name from edu_users where user_id=?");
		      $stmt1->bind_param("s", $param_assigned_by);
					  $param_assigned_by =$row['assigned_by'];
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                        $row1 = $result1->fetch_assoc();
			  echo "<tr>";
			 	
			 $due_date1 = date("d M Y", strtotime($row['due_date']));
			 $countcomp1 = $row['comp_count'] / $row['tottid'];
			 $countcomp2 = $countcomp1 * 100;
			 $countcomp = number_format($countcomp2, 0);
			 
			 $countoverd1 = $row['overd_count'] / $row['tottid'];
			 $countoverd2 = $countoverd1 * 100;
			 $countoverd = number_format($countoverd2, 0); 
			  if($row['activity_id'] == 0){
			     $magLink = "article-detail-admin.php?artID=".$row['article_id']."&actID=".$row['activity_id']."&magID=".$row['mag_id'];
			  }else{
			     $magLink = "activity-detail-admin.php?artID=".$row['article_id']."&actID=".$row['activity_id']."&magID=".$row['mag_id'];
			  }
			  if($row['task_id'] == 0) {$task_id="";
			  
			  echo "<td colspan='7' align='center'> <span class='normaltext'>No entries to show</span></td>";
			  }	else {
				   echo "<td><a href='".$magLink."'> " . $row['article_title'] . "</a></td>";	   
				   #echo "<td class='normaltext'>" . $level . " " . $class_name. " &nbsp;&nbsp;&nbsp;&nbsp;<a href='#' id='tlViewstud' data-id='" . $task_id ."'>View Students</a></td>";
				   echo "<td class='normaltext'>" . $row['level'] . " " . $row['class_name']. " </td>";
				    echo "<td class='normaltext'>".$row1['last_name']." " .$row1['first_name']."</td>";
				   echo "<td class='normaltext'></td>";
				   echo "<td class='normaltext'>" . $due_date1 . "</td>";
				   echo "<td class='normaltext'>" . $countcomp ."%</td>";
				   echo "<td class='normaltext'>" . $countoverd ."%</td>";
				   echo "<td class='normaltext'>-</td>";
				   echo "<td class='normaltext'><a class='material-icons annocom' style='text-decoration:none' id='tlDel' data-id='" . $row['task_id'] ."'>delete</a></td>";
			  }	
			  
				 echo "</tr>" ;
						$sr++;
		}
		
		echo "
											</tbody>    
										  </table>";
 }									
 
}
else {
     $varDuedate='';
	 $mainSql=''; 
	 $varLevelclass ='';
	 $levelclassidexp='';
     if($_POST['selectTaskid'] == 1 )
     {
	    $mainSql = "SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id=? ".$varDuedate." GROUP BY b.task_id";	 
	 }else if($_POST['selectTaskid'] == 2){
	    $mainSql = "SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id!=? ".$varDuedate." GROUP BY b.task_id";
	 }else if($_POST['selectTaskid'] == 3){
	    $varDuedate ="and a.lockitem=1";
	    $mainSql = "SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id=? ".$varDuedate." GROUP BY b.task_id UNION SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id !=? ".$varDuedate." GROUP BY b.task_id";
	    
	 }else if($_POST['selectTaskid'] == 4){
	    
	    $varDuedate ="and a.due_date <= CURDATE() and b.task_stages = 'Overdue'";
		$mainSql = "SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id=? ".$varDuedate." GROUP BY b.task_id UNION SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id !=? ".$varDuedate." GROUP BY b.task_id";
	 }else if($_POST['selectTaskid'] == 5){
	    $varDuedate ="and YEARWEEK(a.due_date, 1) = YEARWEEK(CURDATE(), 1)";
	    $mainSql = "SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id=? ".$varDuedate." GROUP BY b.task_id UNION SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id !=? ".$varDuedate." GROUP BY b.task_id";
	    
	 }else if($_POST['selectTaskid'] == 6){
	    $varDuedate ="and MONTH(a.due_date) = MONTH(CURRENT_DATE()) AND YEAR(a.due_date) = YEAR(CURRENT_DATE())";
	    $mainSql = "SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id=? ".$varDuedate." GROUP BY b.task_id UNION SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id !=? ".$varDuedate." GROUP BY b.task_id";
	    
	 }
	 else if($_POST['levelclassid'] !='Allclasses' )
     {
	    //$levelclassidexp = explode("_",$_POST['levelclassid']);
	    $varLevelclass =' and a.school_id=?';
	   $mainSql = "SELECT a.task_id,a.due_date,c.article_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id  inner join edu_article c on a.article_id=c.article_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id=? ".$varLevelclass." GROUP BY b.task_id UNION SELECT a.task_id,a.due_date,c.activity_title, d.class_name, e.level,count(if(b.task_stages='Completed',1,null)) as comp_count,count(if(b.task_stages='Overdue',1,null)) as overd_count, count(b.task_id) as tottid, a.article_id,a.activity_id,a.mag_id, assigned_by FROM edu_task a inner join edu_user_task b on a.task_id=b.task_id inner join edu_activity c on a.activity_id=c.activity_id inner join edu_class d on a.class_id = d.class_id inner join edu_levels e on a.level_id=e.level_id WHERE a.activity_id !=? ".$varLevelclass." GROUP BY b.task_id";
	   }

      if ($stmt = $mysqli->prepare($mainSql)) {    
		 
		  if($_POST['selectTaskid'] == 1)
         {
		   $stmt->bind_param("s", $param_actid);
		 }else if($_POST['selectTaskid'] == 2){
		   $stmt->bind_param("s", $param_actid2);
		  }else if($_POST['selectTaskid'] == 3){
		   $stmt->bind_param("ss", $param_actid,$param_actid2); 
		  }else if($_POST['selectTaskid'] == 4 || $_POST['selectTaskid'] == 5 || $_POST['selectTaskid'] == 6){
		   $stmt->bind_param("ss", $param_actid,$param_actid2);
		 }else if($_POST['levelclassid'] !='Allclasses' )
		 {
		   $stmt->bind_param("ssss", $param_actid,$param_school_id,$param_actid2,$param_school_id2);
		 }
		 $param_actid =0;
		 $param_actid2=0;
		 if($_POST['levelclassid'] !='' && $_POST['levelclassid'] !='Allclasses' ){
		 $param_school_id=$_POST['levelclassid'];
		 $param_school_id2=$_POST['levelclassid'];
		 }
		 $stmt->execute();
		 $result = $stmt->get_result();
		 /* bind variables to prepared statement */
		// $stmt->bind_result($task_id,$due_date, $article_title,$class_name,$level,$comp_count,$overd_count,$tottid, $article_id,$activity_id,$mag_id, $assigned_by);
		 $sr =1;
		 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
											<thead>
												<tr>
													<th>Title</th>
													<th>Assigned to</th>
													<th>Assigned by</th>
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
		 while ($row = $result->fetch_assoc()) {
		      $stmt1 = $mysqli->prepare("SELECT first_name, last_name from edu_users where user_id=?");
		      $stmt1->bind_param("s", $param_assigned_by);
					  $param_assigned_by =$row['assigned_by'];
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                        $row1 = $result1->fetch_assoc();
			  echo "<tr>";
			 	
			 $due_date1 = date("d M Y", strtotime($row['due_date']));
			 $countcomp1 = $row['comp_count'] / $row['tottid'];
			 $countcomp2 = $countcomp1 * 100;
			 $countcomp = number_format($countcomp2, 0);
			 
			 $countoverd1 = $row['overd_count'] / $row['tottid'];
			 $countoverd2 = $countoverd1 * 100;
			 $countoverd = number_format($countoverd2, 0); 
			  if($row['activity_id'] == 0){
			     $magLink = "article-detail-admin.php?artID=".$row['article_id']."&actID=".$row['activity_id']."&magID=".$row['mag_id'];
			  }else{
			     $magLink = "activity-detail-admin.php?artID=".$row['article_id']."&actID=".$row['activity_id']."&magID=".$row['mag_id'];
			  }
			  if($row['task_id'] == 0) {$task_id="";
			  
			  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
			  }	else {
				   echo "<td><a href='".$magLink."'> " . $row['article_title'] . "</a></td>";	   
				  # echo "<td class='normaltext'>" . $level . " " . $class_name. " &nbsp;&nbsp;&nbsp;&nbsp;<a href='#' id='tlViewstud' data-id='" . $task_id ."'>View Students</a></td>";
				   echo "<td class='normaltext'>" . $row['level'] . " " . $row['class_name']. " </td>";
				   echo "<td class='normaltext'>".$row1['last_name']." " .$row1['first_name']."</td>";
				    echo "<td class='normaltext'></td>";
				   echo "<td class='normaltext'>" . $due_date1 . "</td>";
				   echo "<td class='normaltext'>" . $countcomp ."%</td>";
				   echo "<td class='normaltext'>" . $countoverd ."%</td>";
				   echo "<td class='normaltext'>-</td>";
				   echo "<td class='normaltext'><a class='material-icons annocom' style='text-decoration:none' id='tlDel' data-id='" . $row['task_id'] ."'>delete</a></td>";
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
