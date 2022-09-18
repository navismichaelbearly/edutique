<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	session_start(); 
	$classId = $_POST['class_id'];
	$studentId = $_POST['student_id'];
	if(!empty($_POST['school_id'])){
		$schollId = $_POST['school_id'];
	}else{ 
		$schollId = $_SESSION['school_id'];
	}

	$comploted = 0;
	$inComplete = 0;
	$unopened = 0;
	$overdue = 0;
	if(!empty($classId)){
		$classStmt = $mysqli->prepare("SELECT  task_id  FROM edu_task where class_id = ? AND school_id = ?");
		$classStmt->bind_param("ss",$classId,$schollId);
	}else{
		$classStmt = $mysqli->prepare("SELECT  task_id  FROM edu_task where school_id = ?");
		$classStmt->bind_param("s",$schollId);
	}
	$classStmt->execute();
	$result = $classStmt->get_result(); 

	$taskIds = [];
	while($row = $result->fetch_assoc()) { 
		if(!empty($studentId)){
			$compliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ?  AND assigned_to = ? AND task_stages='Completed'");
			$compliteStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$compliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND task_stages='Completed'");
			$compliteStmt->bind_param("s",$row['task_id']);
		}
		$compliteStmt->execute(); 
		$compliteStmt->store_result();
	   	$compliteStmt->fetch();
	    $comploted = ($comploted + $compliteStmt->num_rows()); 
	   	$compliteStmt->close();

	   	if(!empty($studentId)){
			$incompliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Incomplete'");
			$incompliteStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$incompliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND task_stages='Incomplete'");
			$incompliteStmt->bind_param("s",$row['task_id']);
		}
		$incompliteStmt->execute(); 
		$incompliteStmt->store_result();
	   	$incompliteStmt->fetch();
	    $inComplete = ($inComplete + $incompliteStmt->num_rows()); 
	   	$incompliteStmt->close();
	   	
	   	if(!empty($studentId)){
			$unopenStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Unopened'");
			$unopenStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$unopenStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND task_stages='Unopened'");
			$unopenStmt->bind_param("s",$row['task_id']);
		}
		$unopenStmt->execute(); 
		$unopenStmt->store_result();
	   	$unopenStmt->fetch();
	    $unopened = ($unopened + $unopenStmt->num_rows());  
	   	$unopenStmt->close();
	   	
	   	if(!empty($studentId)){
			$overdueStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Overdue'");
			$overdueStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$overdueStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND task_stages='Overdue'");
			$overdueStmt->bind_param("s",$row['task_id']);
		}
		$overdueStmt->execute(); 
		$overdueStmt->store_result();
	   	$overdueStmt->fetch();
	    $overdue = ($overdue + $overdueStmt->num_rows()); 
	   	$overdueStmt->close(); 
	} 
	$articalCount = array(
		'comploted'=>$comploted,
		'inComplete'=>$inComplete,
		'unopened'=>$unopened,
		'overdue'=>$overdue,
	);

	$readingComploted = 0;
	$readingInComplete = 0;
	$readingUnopened = 0;
	$readingOverdue = 0;

 	if(!empty($classId)){
		$readingStatement = $mysqli->prepare("SELECT  task_id  FROM edu_task where school_id = ? AND class_id = ? AND article_id != 0 AND activity_id = 0");
		$readingStatement->bind_param("ss",$schollId,$classId);
	}else{
		$readingStatement = $mysqli->prepare("SELECT  task_id  FROM edu_task where school_id = ? AND article_id != 0 AND activity_id = 0");
		$readingStatement->bind_param("s",$schollId);
	}

	$readingStatement->execute();
	$result = $readingStatement->get_result();  
	while($row = $result->fetch_assoc()) { 
		if(!empty($studentId)){
			$compliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ?  AND assigned_to = ? AND task_stages='Completed'");
			$compliteStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$compliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND task_stages='Completed'");
			$compliteStmt->bind_param("s",$row['task_id']);
		} 
		$compliteStmt->execute(); 
		$compliteStmt->store_result();
	   	$compliteStmt->fetch();
	    $readingComploted = ($readingComploted + $compliteStmt->num_rows()); 
	   	$compliteStmt->close();

	   	if(!empty($studentId)){
			$incompliteStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Incomplete'");
			$incompliteStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$incompliteStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Incomplete'");
			$incompliteStmt->bind_param("s",$row['task_id']);
		}
		$incompliteStmt->execute(); 
		$incompliteStmt->store_result();
	   	$incompliteStmt->fetch();
	    $readingInComplete = ($readingInComplete + $incompliteStmt->num_rows()); 
	   	$incompliteStmt->close();
	   	
	   	if(!empty($studentId)){
			$unopenStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Unopened'");
			$unopenStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$unopenStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Unopened'");
			$unopenStmt->bind_param("s",$row['task_id']);
		}
		$unopenStmt->execute(); 
		$unopenStmt->store_result();
	   	$unopenStmt->fetch();
	    $readingUnopened = ($readingUnopened + $unopenStmt->num_rows());  
	   	$unopenStmt->close();
	   	
	   	if(!empty($studentId)){
			$overdueStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Overdue'");
			$overdueStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$overdueStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND task_stages='Overdue'");
			$overdueStmt->bind_param("s",$row['task_id']);
		}
		$overdueStmt->execute(); 
		$overdueStmt->store_result();
	   	$overdueStmt->fetch();
	    $readingOverdue = ($readingOverdue + $overdueStmt->num_rows()); 
	   	$overdueStmt->close(); 
	}  


	$activitiesComploted = 0;
	$activitiesInComplete = 0;
	$activitiesUnopened = 0;
	$activitiesOverdue = 0;

	if(!empty($classId)){
		$activitiesStatement = $mysqli->prepare("SELECT  task_id  FROM edu_task where school_id = ? AND class_id = ? AND article_id != 0 AND activity_id != 0");
		$activitiesStatement->bind_param("ss",$schollId,$classId);
	}else{
		$activitiesStatement = $mysqli->prepare("SELECT  task_id  FROM edu_task where school_id = ? AND article_id != 0 AND activity_id != 0");
		$activitiesStatement->bind_param("s",$schollId);
	}
	$activitiesStatement->execute();
	$result = $activitiesStatement->get_result();  
	while($row = $result->fetch_assoc()) { 
	   	if(!empty($studentId)){
			$compliteStmt = $mysqli->prepare("SELECT id  FROM edu_user_task where `task_id` = ?  AND assigned_to = ? AND task_stages='Completed'");
			$compliteStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$compliteStmt = $mysqli->prepare("SELECT id  FROM edu_user_task where `task_id` = ? AND task_stages='Completed'");
			$compliteStmt->bind_param("s",$row['task_id']);
		} 
		$compliteStmt->execute(); 
		$compliteStmt->store_result();
	   	$compliteStmt->fetch();
	    $activitiesComploted = ($activitiesComploted + $compliteStmt->num_rows()); 
	   	$compliteStmt->close();

	   	if(!empty($studentId)){
			$incompliteStmt = $mysqli->prepare("SELECT id  FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Incomplete'");
			$incompliteStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$incompliteStmt = $mysqli->prepare("SELECT id  FROM edu_user_task where `task_id` = ? AND task_stages='Incomplete'");
			$incompliteStmt->bind_param("s",$row['task_id']);
		}
		$incompliteStmt->execute(); 
		$incompliteStmt->store_result();
	   	$incompliteStmt->fetch();
	    $activitiesInComplete = ($activitiesInComplete + $incompliteStmt->num_rows()); 
	   	$incompliteStmt->close();
	   	
	   if(!empty($studentId)){
			$unopenStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Unopened'");
			$unopenStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$unopenStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Unopened'");
			$unopenStmt->bind_param("s",$row['task_id']);
		}
		$unopenStmt->execute(); 
		$unopenStmt->store_result();
	   	$unopenStmt->fetch();
	    $activitiesUnopened = ($activitiesUnopened + $unopenStmt->num_rows());  
	   	$unopenStmt->close();
	   	
	   	if(!empty($studentId)){
			$overdueStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND assigned_to = ? AND task_stages='Overdue'");
			$overdueStmt->bind_param("ss",$row['task_id'],$studentId);
		}else{
		   	$overdueStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? AND task_stages='Overdue'");
			$overdueStmt->bind_param("s",$row['task_id']);
		}
		$overdueStmt->execute(); 
		$overdueStmt->store_result();
	   	$overdueStmt->fetch();
	    $activitiesOverdue = ($activitiesOverdue + $overdueStmt->num_rows()); 
	   	$overdueStmt->close(); 
	} 


	$readingArticalCount = array(
		'comploted'=>$readingComploted,
		'inComplete'=>$readingInComplete,
		'unopened'=>$readingUnopened,
		'overdue'=>$readingOverdue,
	); 

	$activitiesArticalCount = array(
		'comploted'=>$activitiesComploted,
		'inComplete'=>$activitiesInComplete,
		'unopened'=>$activitiesUnopened,
		'overdue'=>$activitiesOverdue,
	);
	$total = ($comploted + $inComplete + $unopened + $overdue);
	$readingtotal = ($readingComploted + $readingInComplete + $readingUnopened + $readingOverdue);
	$activitiestotal = ($activitiesComploted + $activitiesInComplete + $activitiesUnopened + $activitiesOverdue);

	$artCompleted = '0';
	$readingCompleted = '0';
	$activitieCompleted = '0';
	if($comploted > 0){
		$artCompleted1 = $comploted / $total;
		$artCompleted2 = $artCompleted1 * 100;
		$artCompleted = number_format($artCompleted2, 0);
	}
	if($readingComploted > 0){
		$readingCompleted1 = $readingComploted / $readingtotal;
		$readingCompleted2 = $readingCompleted1 * 100;
		$readingCompleted = number_format($readingCompleted2, 0);
	} 
	if($activitiesComploted > 0){
		$activitieCompleted1 = $activitiesComploted / $activitiestotal;
		$activitieCompleted2 = $activitieCompleted1 * 100;
		$activitieCompleted = number_format($activitieCompleted2, 0);
	} 
	
	


	$json['success'] = ($total > 0)?true:false;
	$json['reading_success'] = ($readingtotal > 0)?true:false;
	$json['activities_success'] = ($activitiestotal > 0)?true:false;
	$json['data'] = $articalCount;
	$json['total'] =$total;
	$json['total_complited'] =$artCompleted;
	$json['total_reading'] =$readingCompleted;
	$json['total_activitie'] =$activitieCompleted;
	$json['reading'] = $readingArticalCount;
	$json['reading_total'] = $readingtotal;
	$json['activities'] = $activitiesArticalCount;
	$json['activities_total'] = $activitiestotal;
	echo json_encode($json);
?>