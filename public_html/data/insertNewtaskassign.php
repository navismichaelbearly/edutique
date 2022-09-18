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
        $number = count($_GET["art_id"]);
        $actIdCount = count($_GET["act_id"]);
 

$postClassData = $_GET['classDetail'];
$todaysDate = date("Y-m-d h:i:sa");
for($i=0; $i<$number; $i++){
	if(!empty($_GET["art_id"][$i])){
		foreach ($postClassData as $studLevel) {
			foreach($studLevel['class'] as $classId){  
			   	$insertSql = "INSERT INTO edu_task (article_id, activity_id, mag_id, published_date, due_date, assigned_by, school_id, level_id, class_id, task_status, peer_id, lockitem,contentaid,receivequestions) 
							VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmts = $mysqli->prepare($insertSql);

				$stmts->bind_param("ssssssssssssss", $param_article_id,$param_activity_id,$param_mag_id,$param_published_date,$param_due_date,$param_assigned_by,$param_school_id,$param_level_id,$param_class_id,$param_task_status,$param_peer_id,$param_lock,$param_contentaid,$param_receivequestions);  
				$param_article_id = $_GET["art_id"][$i];	  
				$param_activity_id = 0;
				$param_mag_id = $_GET["magid"][$i] ?? 0;
				$param_published_date = $todaysDate;
				$param_due_date = $_POST["dueon"];
				$param_assigned_by =  $_SESSION["id"];
				$param_school_id = $school_id;
				$param_level_id = $studLevel['levelname'];
				$param_class_id = $classId;
				$param_task_status = $active;
				$param_peer_id = '';
				$param_lock = $_POST["lock"];
				$param_contentaid = $_POST["contentaid"];
				$param_receivequestions = $_POST["receivequestions"];
				$stmts->execute();
				$lasttask_id = $stmts->insert_id;		
				$isInsert = true;
				if($lasttask_id){
					foreach($studLevel[$classId]['user_id'] as $userId){
						$assignTask = $mysqli->prepare("SELECT id FROM edu_user_task where article_ids = ? and assigned_to= ? and class_ids = ? and activity_ids=0");
						$assignTask->bind_param("sss",$_GET["art_id"][$i],$userId,$classId);
						$assignTask->execute(); 
						$assignTask->store_result();
					   	$assignTask->fetch();
					   	$notAssignTask = $assignTask->num_rows(); 
					   	$assignTask->close();
					   	 
					   	if($notAssignTask == 0){
						   	$insertSqls = "INSERT INTO edu_user_task (assigned_to, task_stages,task_id,activity_ids,article_ids,class_ids) 
							VALUES(?,?,?,?,?,?)";
							$stmtss = $mysqli->prepare($insertSqls); 
							$param_assigned_to = $userId;
							$param_task_stages = $unopened;
							$param_task_id = $lasttask_id;
							$param_class_id = $classId;
							$artZero = '0';
							$stmtss->bind_param("ssssss", $param_assigned_to, $param_task_stages, $param_task_id,$artZero,$_GET["art_id"][$i],$param_class_id);
							$stmtss->execute(); 
							if($isInsert){
								$isInsert = false;
							}
						}
				   	} 
					
					if($isInsert){
						$tsskDelete = $mysqli->prepare("Delete FROM edu_task where `task_id` = ?");
						$tsskDelete->bind_param("s",$lasttask_id);
						$tsskDelete->execute(); 
						$tsskDelete->store_result(); 
					   	$tsskDelete->close(); 
					}
				}
			}
		}
	}
}
for($i=0; $i<$actIdCount; $i++){   
	if(!empty($_GET["act_id"][$i])){
		$artId = $_GET["act_id"][$i]; 
		$artStatement = $mysqli->prepare("Select article_id,mag_id  from edu_activity where activity_id=?");
		/* Bind parameters */
		$artStatement->bind_param("s", $artId);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$artStatement->execute(); 
		$result = $artStatement->get_result();
		$rowResult  = $result->fetch_assoc(); 
		foreach ($postClassData as $studLevel) {
			foreach($studLevel['class'] as $classId){ 
			   	$insertSql = "INSERT INTO edu_task (article_id, activity_id, mag_id, published_date, due_date, assigned_by, school_id, level_id, class_id, task_status, peer_id) 
							VALUES(?,?,?,?,?,?,?,?,?,?,?)";
				$stmts = $mysqli->prepare($insertSql);

				$stmts->bind_param("sssssssssss", $param_article_id,$param_activity_id,$param_mag_id,$param_published_date,$param_due_date,$param_assigned_by,$param_school_id,$param_level_id,$param_class_id,$param_task_status,$param_peer_id);  
				$param_article_id = $rowResult['article_id'] ?? 0;	  
				$param_activity_id = $artId;
				$param_mag_id = $rowResult['mag_id'] ?? 0;
				$param_published_date = $todaysDate;
				$param_due_date = $_POST["dueon"];
				$param_assigned_by =  $_SESSION["id"];
				$param_school_id = $school_id;
				$param_level_id = $studLevel['levelname'];
				$param_class_id = $classId;
				$param_task_status = $active;
				$param_peer_id = '';
				$stmts->execute();
				$lasttask_id = $stmts->insert_id;
				$isInsert = true;
				if($lasttask_id){
					foreach($studLevel[$classId]['user_id'] as $userId){
						$assignTask = $mysqli->prepare("SELECT id FROM edu_user_task where article_ids = ? and assigned_to=? and activity_ids=? and class_ids = ?");
						$assignTask->bind_param("ssss",$rowResult['article_id'],$userId,$artId,$classId);
						$assignTask->execute(); 
						$assignTask->store_result();
					   	$assignTask->fetch();
					   	$notAssignTask = $assignTask->num_rows(); 
					   	$assignTask->close(); 
					   	if($notAssignTask == 0){
						   	$insertSqls = "INSERT INTO edu_user_task (assigned_to, task_stages,task_id,activity_ids,article_ids,class_ids) 
							VALUES(?,?,?,?,?,?)";
							$stmtss = $mysqli->prepare($insertSqls); 
							$param_assigned_to = $userId;
							$param_task_stages = $unopened;
							$param_task_id = $lasttask_id;
							$param_class_id = $classId;
							$stmtss->bind_param("ssssss", $param_assigned_to, $param_task_stages, $param_task_id,$artId,$rowResult['article_id'],$param_class_id);
							$stmtss->execute();
							if($isInsert){
								$isInsert = false;
							}
						}
				   	} 
					if($isInsert){
						$tsskDelete = $mysqli->prepare("Delete FROM edu_task where `task_id` = ?");
						$tsskDelete->bind_param("s",$lasttask_id);
						$tsskDelete->execute(); 
						$tsskDelete->store_result(); 
					   	$tsskDelete->close(); 
					}
				}
			}
		}
	}
}
?>
