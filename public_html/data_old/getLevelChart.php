<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	session_start();
	if(!empty($_POST['school_id'])){
		$schollId = $_POST['school_id'];
	}else{ 
		$schollId = $_SESSION['school_id'];
	}
	$classLevel = $_POST['class_level'];
	$taskStatus = [];
	if(!empty($classLevel)){
		$classLevelStmt = $mysqli->prepare("SELECT  el.class_name ,e.class_id  FROM edu_task as e left join edu_class el on e.class_id = el.class_id where e.school_id = ?  AND e.level_id = ? GROUP By e.class_id");
		$classLevelStmt->bind_param("ss",$schollId,$classLevel);
		$classLevelStmt->execute();
		$result1 = $classLevelStmt->get_result();  
		
		while($row1 = $result1->fetch_assoc()) {
			$classId = $row1['class_id'];
			$taskStatus[$classId]['name'] = $row1['class_name'];
			$taskStatus[$classId]['comploted'] = '0';
			$taskStatus[$classId]['inComplete'] = '0';
			$taskStatus[$classId]['unopened'] = '0';
			$taskStatus[$classId]['overdue'] = '0';

			$classStmt = $mysqli->prepare("SELECT  task_id  FROM edu_task where class_id = ?");
			$classStmt->bind_param("s",$classId);
			$classStmt->execute();
			$result = $classStmt->get_result(); 
 
			while($row = $result->fetch_assoc()) { 
			   	$compliteStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? and task_stages='Completed'");
				$compliteStmt->bind_param("s",$row['task_id']);
				$compliteStmt->execute(); 
				$compliteStmt->store_result();
			   	$compliteStmt->fetch();
			   	$taskStatus[$classId]['comploted'] = ($taskStatus[$classId]['comploted'] + $compliteStmt->num_rows()); 
			   	$compliteStmt->close();

			   	$incompliteStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? and task_stages='Incomplete'");
				$incompliteStmt->bind_param("s",$row['task_id']);
				$incompliteStmt->execute(); 
				$incompliteStmt->store_result();
			   	$incompliteStmt->fetch();
			    $taskStatus[$classId]['inComplete'] = ($taskStatus[$classId]['inComplete'] + $incompliteStmt->num_rows()); 
			   	$incompliteStmt->close();
			   	
			   	$unopenStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? and task_stages='Unopened'");
				$unopenStmt->bind_param("s",$row['task_id']);
				$unopenStmt->execute(); 
				$unopenStmt->store_result();
			   	$unopenStmt->fetch();
			    $taskStatus[$classId]['unopened'] = ($taskStatus[$classId]['unopened'] + $unopenStmt->num_rows());
			   	$unopenStmt->close();
			   	
			   	$overdueStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? and task_stages='Overdue'");
				$overdueStmt->bind_param("s",$row['task_id']);
				$overdueStmt->execute(); 
				$overdueStmt->store_result();
			   	$overdueStmt->fetch();
			    $taskStatus[$classId]['overdue'] = ($taskStatus[$classId]['overdue'] + $overdueStmt->num_rows()); 
			   	$overdueStmt->close(); 

				$taskStatus[$classId]['total'] = ($taskStatus[$classId]['comploted'] + $taskStatus[$classId]['inComplete'] + $taskStatus[$classId]['unopened'] + $taskStatus[$classId]['overdue']);
			   	if($taskStatus[$classId]['comploted'] > 0){
				   	$artCompleted = $taskStatus[$classId]['comploted'] / $taskStatus[$classId]['total'];
					$artCompleted = $artCompleted * 100;
					$taskStatus[$classId]['total_complited'] = number_format($artCompleted, 0);
				}else{
					$taskStatus[$classId]['total_complited'] = 0;
				}
			}
		}
	}else{
		$classLevelStmt = $mysqli->prepare("SELECT  el.class_name ,e.class_id  FROM edu_task as e left join edu_class el on e.class_id = el.class_id where e.school_id = ? GROUP By e.class_id");
		$classLevelStmt->bind_param("s",$schollId);
		$classLevelStmt->execute();
		$result1 = $classLevelStmt->get_result();  
		
		while($row1 = $result1->fetch_assoc()) { 
			$classId = $row1['class_id'];
			$taskStatus[$classId]['name'] = $row1['class_name'];
			$taskStatus[$classId]['comploted'] = '0';
			$taskStatus[$classId]['inComplete'] = '0';
			$taskStatus[$classId]['unopened'] = '0';
			$taskStatus[$classId]['overdue'] = '0';


			$classStmt = $mysqli->prepare("SELECT  task_id  FROM edu_task where class_id = ?");
			$classStmt->bind_param("s",$classId);
			$classStmt->execute();
			$result = $classStmt->get_result(); 
 
			while($row = $result->fetch_assoc()) { 
			   	$compliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? and task_stages='Completed'");
				$compliteStmt->bind_param("s",$row['task_id']);
				$compliteStmt->execute(); 
				$compliteStmt->store_result();
			   	$compliteStmt->fetch();
			   	$taskStatus[$classId]['comploted'] = ($taskStatus[$classId]['comploted'] + $compliteStmt->num_rows()); 
			   	$compliteStmt->close();

			   	$incompliteStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? and task_stages='Incomplete'");
				$incompliteStmt->bind_param("s",$row['task_id']);
				$incompliteStmt->execute(); 
				$incompliteStmt->store_result();
			   	$incompliteStmt->fetch();
			    $taskStatus[$classId]['inComplete'] = ($taskStatus[$classId]['inComplete'] + $incompliteStmt->num_rows()); 
			   	$incompliteStmt->close();
			   	
			   	$unopenStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? and task_stages='Unopened'");
				$unopenStmt->bind_param("s",$row['task_id']);
				$unopenStmt->execute(); 
				$unopenStmt->store_result();
			   	$unopenStmt->fetch();
			    $taskStatus[$classId]['unopened'] = ($taskStatus[$classId]['unopened'] + $unopenStmt->num_rows());
			   	$unopenStmt->close();
			   	
			   	$overdueStmt = $mysqli->prepare("SELECT  id  FROM edu_user_task where `task_id` = ? and task_stages='Overdue'");
				$overdueStmt->bind_param("s",$row['task_id']);
				$overdueStmt->execute(); 
				$overdueStmt->store_result();
			   	$overdueStmt->fetch();
			    $taskStatus[$classId]['overdue'] = ($taskStatus[$classId]['overdue'] + $overdueStmt->num_rows()); 
			   	$overdueStmt->close(); 

			   	$taskStatus[$classId]['total'] = ($taskStatus[$classId]['comploted'] + $taskStatus[$classId]['inComplete'] + $taskStatus[$classId]['unopened'] + $taskStatus[$classId]['overdue']);


				if($taskStatus[$classId]['comploted'] > 0){
				   	$artCompleted = $taskStatus[$classId]['comploted'] / $taskStatus[$classId]['total'];
					$artCompleted = $artCompleted * 100;
					$taskStatus[$classId]['total_complited'] = number_format($artCompleted, 0);
				}else{
					$taskStatus[$classId]['total_complited'] = 0;
				}
			}
		}
	}  
	$json['success'] = count($taskStatus)?true:false;
	$json['data'] = $taskStatus; 
	echo json_encode($json);
?>