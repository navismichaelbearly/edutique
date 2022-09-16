<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	session_start(); 
	$articalType = $_POST['artical_type'];
	if(!empty($_POST['school_id'])){
		$schollId = $_POST['school_id'];
	}else{ 
		$schollId = $_SESSION['school_id'];
	}
	$taskStatus = []; 
	if(!empty($articalType)){
		$isArticalActivity = true;
		$isActivity = false;
		if($articalType == 1){
			$classStmt = $mysqli->prepare("SELECT  el.level ,e.level_id  FROM edu_task as e left join edu_levels el on e.level_id = el.level_id where e.school_id = ? GROUP By e.level_id");
			$classStmt->bind_param("s",$schollId);
		}else if($articalType == 2){ 
			$classStmt = $mysqli->prepare("SELECT  el.level ,e.level_id  FROM edu_task as e left join edu_levels el on e.level_id = el.level_id where e.school_id = ?  AND article_id != '0' AND activity_id = '0' GROUP By e.level_id");
			$classStmt->bind_param("s",$schollId);
		}else{
			$isArticalActivity = true;
			$isActivity = true; 
			$classStmt = $mysqli->prepare("SELECT  el.level ,e.level_id  FROM edu_task as e left join edu_levels el on e.level_id = el.level_id where e.school_id = ? AND article_id != '0' AND activity_id != '0' GROUP By e.level_id");

			$classStmt->bind_param("s",$schollId);
		}
		if($isArticalActivity){
			$classStmt->execute();
			$result1 = $classStmt->get_result(); 
			 
			while($row1 = $result1->fetch_assoc()) {
				$classStmt = $mysqli->prepare("SELECT  task_id  FROM edu_task where level_id = ?");
				$classStmt->bind_param("s",$row1['level_id']);
				$classStmt->execute();
				$result = $classStmt->get_result();  
				$levelId = $row1['level_id'];
				$taskStatus[$levelId]['name'] = $row1['level'];
				$taskStatus[$levelId]['comploted'] = '0';
				$taskStatus[$levelId]['inComplete'] = '0';
				$taskStatus[$levelId]['unopened'] = '0';
				$taskStatus[$levelId]['overdue'] = '0';
				while($row = $result->fetch_assoc()) { 
				   	$compliteStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Completed'");
					$compliteStmt->bind_param("s",$row['task_id']);
					$compliteStmt->execute(); 
					$compliteStmt->store_result();
				   	$compliteStmt->fetch();
				    $taskStatus[$levelId]['comploted'] = ($taskStatus[$levelId]['comploted'] + $compliteStmt->num_rows()); 
				   	$compliteStmt->close();

				   	$incompliteStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Incomplete'");
					$incompliteStmt->bind_param("s",$row['task_id']);
					$incompliteStmt->execute(); 
					$incompliteStmt->store_result();
				   	$incompliteStmt->fetch();
				    $taskStatus[$levelId]['inComplete'] = ($taskStatus[$levelId]['inComplete'] + $incompliteStmt->num_rows()); 
				   	$incompliteStmt->close();
				   	
				   	$unopenStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Unopened'");
					$unopenStmt->bind_param("s",$row['task_id']);
					$unopenStmt->execute(); 
					$unopenStmt->store_result();
				   	$unopenStmt->fetch();
				     $taskStatus[$levelId]['unopened'] = ($taskStatus[$levelId]['unopened'] + $unopenStmt->num_rows());
				   	$unopenStmt->close();
				   	
				   	$overdueStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Overdue'");
					$overdueStmt->bind_param("s",$row['task_id']);
					$overdueStmt->execute(); 
					$overdueStmt->store_result();
				   	$overdueStmt->fetch();
				    $taskStatus[$levelId]['overdue'] = ($taskStatus[$levelId]['overdue'] + $overdueStmt->num_rows()); 
				   	$overdueStmt->close(); 

				   	$taskStatus[$levelId]['total'] = ($taskStatus[$levelId]['comploted'] + $taskStatus[$levelId]['inComplete'] + $taskStatus[$levelId]['unopened'] + $taskStatus[$levelId]['overdue']);

				   	
					if($taskStatus[$levelId]['comploted'] > 0){
					   	$artCompleted = $taskStatus[$levelId]['comploted'] / $taskStatus[$levelId]['total'];
						$artCompleted = $artCompleted * 100;
						$taskStatus[$levelId]['total_complited'] = number_format($artCompleted, 0);
					}else{
						$taskStatus[$levelId]['total_complited'] = 0;
					}
				}
			}
		}
	}else{
		$classLevelStmt = $mysqli->prepare("SELECT  el.level ,e.level_id  FROM edu_task as e left join edu_levels el on e.level_id = el.level_id where e.school_id = ? GROUP By e.level_id");
		$classLevelStmt->bind_param("s",$schollId);
		$classLevelStmt->execute();
		$result1 = $classLevelStmt->get_result();  
		
		while($row1 = $result1->fetch_assoc()) {
			$classStmt = $mysqli->prepare("SELECT  task_id  FROM edu_task where level_id = ?");
			$classStmt->bind_param("s",$row1['level_id']);
			$classStmt->execute();
			$result = $classStmt->get_result();  
			$levelId = $row1['level_id'];
			$taskStatus[$levelId]['name'] = $row1['level'];
			$taskStatus[$levelId]['comploted'] = '0';
			$taskStatus[$levelId]['inComplete'] = '0';
			$taskStatus[$levelId]['unopened'] = '0';
			$taskStatus[$levelId]['overdue'] = '0';
			while($row = $result->fetch_assoc()) {;
			   	$compliteStmt = $mysqli->prepare("SELECT id  FROM edu_user_task where `task_id` = ? AND task_stages='Completed'");
				$compliteStmt->bind_param("s",$row['task_id']);
				$compliteStmt->execute(); 
				$compliteStmt->store_result();
			   	$compliteStmt->fetch();
			    $taskStatus[$levelId]['comploted'] = ($taskStatus[$levelId]['comploted'] + $compliteStmt->num_rows()); 
			   	$compliteStmt->close();

			   	$incompliteStmt = $mysqli->prepare("SELECT id  FROM edu_user_task where `task_id` = ? AND task_stages='Incomplete'");
				$incompliteStmt->bind_param("s",$row['task_id']);
				$incompliteStmt->execute(); 
				$incompliteStmt->store_result();
			   	$incompliteStmt->fetch();
			    $taskStatus[$levelId]['inComplete'] = ($taskStatus[$levelId]['inComplete'] + $incompliteStmt->num_rows()); 
			   	$incompliteStmt->close();
			   	
			   	$unopenStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Unopened'");
				$unopenStmt->bind_param("s",$row['task_id']);
				$unopenStmt->execute(); 
				$unopenStmt->store_result();
			   	$unopenStmt->fetch();
			    $taskStatus[$levelId]['unopened'] = ($taskStatus[$levelId]['unopened'] + $unopenStmt->num_rows());  
			   	$unopenStmt->close();
			   	
			   	$overdueStmt = $mysqli->prepare("SELECT id FROM edu_user_task where `task_id` = ? AND task_stages='Overdue'");
				$overdueStmt->bind_param("s",$row['task_id']);
				$overdueStmt->execute(); 
				$overdueStmt->store_result();
			   	$overdueStmt->fetch();
			    $taskStatus[$levelId]['overdue'] = ($taskStatus[$levelId]['overdue'] + $overdueStmt->num_rows()); 
			   	$overdueStmt->close(); 

			   	$taskStatus[$levelId]['total'] = ($taskStatus[$levelId]['comploted'] + $taskStatus[$levelId]['inComplete'] + $taskStatus[$levelId]['unopened'] + $taskStatus[$levelId]['overdue']);

			   	if($taskStatus[$levelId]['comploted'] > 0){
				   	$artCompleted = $taskStatus[$levelId]['comploted'] / $taskStatus[$levelId]['total'];
					$artCompleted = $artCompleted * 100;
					$taskStatus[$levelId]['total_complited'] = number_format($artCompleted, 0);
				}else{
					$taskStatus[$levelId]['total_complited'] = 0;
				}
			}  
		}
	}     
	$json['success'] = count($taskStatus)?true:false;
	$json['data'] = $taskStatus; 
	echo json_encode($json);
?>