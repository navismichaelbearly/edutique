<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	session_start(); /*Session Start*/ 
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: login.php");
		exit;
	} 

	require_once "../inc/config.php";
	include "../inc/constants.php"; 

	$schoolName =  $_POST['schoolName'];
	$levelName =  $_POST['levelId'];
	$className =  $_POST['classId'];
	$countryId =  $_POST['countryId'];
	$postalcode =  $_POST['postalcode'];
	$userData = $_POST['user'];
	$skillData = $_POST['skill']; 
	$createdBy = 'Admin';
	$status = 'Active';
	$createdAt = date('Y-m-d h:i:s');
 
	$schoolStmt = $mysqli->prepare("SELECT school_id FROM edu_school where school_name=?");
	$schoolStmt->bind_param("s", $schoolName);
	$schoolStmt->execute();
	$schoolStmt->bind_result($school_id); 
	$schoolStmt->fetch();
	$schoolStmt->close();

	if(empty($school_id)){
		$insertSchoolSqls = "INSERT INTO edu_school (school_name, school_created_by,school_status,postal_code,country_id,school_created_date) 
		VALUES(?,?,?,?,?,?)";
		$stmtss = $mysqli->prepare($insertSchoolSqls);
		$stmtss->bind_param("ssssss", $schoolName,$createdBy , $status,$postalcode,$countryId,$createdAt);
		$stmtss->execute(); 
		$school_id = $stmtss->insert_id;
	}  
	$levelStmt = $mysqli->prepare("SELECT level_id FROM edu_levels where level=?");
	$levelStmt->bind_param("s", $levelName);
	$levelStmt->execute();
	$levelStmt->bind_result($level_id); 
	$levelStmt->fetch();
	$levelStmt->close();
	if(empty($level_id)){
		$insertLevelSqls = "INSERT INTO edu_levels (level, level_status,school_id) 
		VALUES(?,?,?)";
		$stmtss = $mysqli->prepare($insertLevelSqls);
		$stmtss->bind_param("sss", $levelName,$status,$school_id);
		$stmtss->execute(); 
		$level_id = $stmtss->insert_id;
	} 

	$classStmt = $mysqli->prepare("SELECT class_id FROM edu_class where class_name=?");
	$classStmt->bind_param("s", $className);
	$classStmt->execute();
	$classStmt->bind_result($class_id); 
	$classStmt->fetch();
	$classStmt->close();

	if(empty($class_id)){
		$insertClassSql = "INSERT INTO edu_class (class_name, class_status,school_id,level_id) 
		VALUES(?,?,?,?)";
		$stmtss = $mysqli->prepare($insertClassSql);
		$stmtss->bind_param("ssss", $className,$status,$school_id,$level_id);
		$stmtss->execute(); 
		$class_id = $stmtss->insert_id;
	} 

	
	$password = password_hash('Zxcv.mnbv@19', PASSWORD_DEFAULT);
	
	$firstPassword = 0;
	$tooltip = 0; 
	/*subscribeSchool($skillData,$mysqli,$school_id,'135');*/
 	if(!empty($userData)){
 		$userType = 3;
 		foreach($userData as $key=>$user){
 		 	$userName = preg_replace('/[0-9\@\.\;\" "]+/', '', $user['firstName']);
 			$insertUserSql = "INSERT INTO edu_users (user_type_id, user_email, username, user_password, first_name, last_name, user_status, user_created_date, first_time_password_change, tooltip,user_created_by) 
			VALUES(?,?,?,?,?,?,?,?,?,?,?)";
			$stmtss = $mysqli->prepare($insertUserSql);
			$stmtss->bind_param("sssssssssss", $userType,$user['email'],$userName,$password,$user['firstName'],$user['lastName'],$status,$createdAt,$firstPassword,$tooltip,$createdBy);
			$stmtss->execute(); 
			$user_id = $stmtss->insert_id;

 		 	$userName = preg_replace('/[0-9\@\.\;\" "]+/', '', $user['firstName']);
 			$insertUserSchoolSql = "INSERT INTO edu_user_school_level_class (user_id, school_id, class_id,level_id) 
			VALUES(?,?,?,?)";
			$stmtss = $mysqli->prepare($insertUserSchoolSql);
			$stmtss->bind_param("ssss", $user_id,$school_id,$class_id,$level_id);
			$stmtss->execute(); 
			$activity_id = $stmtss->insert_id;

			subscribeSchool($skillData,$mysqli,$school_id,$user_id,$userType,$class_id,$level_id);
 		}
 	}
 	if(!empty($_POST['teacher_ic_firstname']) && !empty($_POST['teacher_ic_email'])&& !empty($_POST['teacher_ic_lastname'])){
 		$userType = 4;

 		$userName = preg_replace('/[0-9\@\.\;\" "]+/', '', $_POST['teacher_ic_firstname']);
		$insertUserSql = "INSERT INTO edu_users (user_type_id, user_email, username, user_password, first_name, last_name, user_status, user_created_date, first_time_password_change, tooltip,user_created_by) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		$stmtss = $mysqli->prepare($insertUserSql);
		$stmtss->bind_param("sssssssssss", $userType,$_POST['teacher_ic_email'],$userName,$password,$_POST['teacher_ic_firstname'],$_POST['teacher_ic_lastname'],$status,$createdAt,$firstPassword,$tooltip,$createdBy);
		$stmtss->execute(); 
		$user_id = $stmtss->insert_id;

	 	
		$insertUserSchoolSql = "INSERT INTO edu_user_school_level_class (user_id, school_id, class_id,level_id) 
		VALUES(?,?,?,?)";
		$stmtss = $mysqli->prepare($insertUserSchoolSql);
		$stmtss->bind_param("ssss", $user_id,$school_id,$class_id,$level_id);
		$stmtss->execute();  

		subscribeSchool($skillData,$mysqli,$school_id,$user_id,$userType,$class_id,$level_id);
 	}
 	if(!empty($_POST['teacher_el_first_name']) && !empty($_POST['teacher_el_email']) && !empty($_POST['teacher_el_last_name'])){
 		$userType = 4;

 		$userName = preg_replace('/[0-9\@\.\;\" "]+/', '', $_POST['teacher_el_first_name']);
		$insertUserSql = "INSERT INTO edu_users (user_type_id, user_email, username, user_password, first_name, last_name, user_status, user_created_date, first_time_password_change, tooltip,user_created_by) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		$stmtss = $mysqli->prepare($insertUserSql);
		$stmtss->bind_param("sssssssssss", $userType,$_POST['teacher_el_email'],$userName,$password,$_POST['teacher_el_first_name'],$_POST['teacher_el_last_name'],$status,$createdAt,$firstPassword,$tooltip,$createdBy);
		$stmtss->execute(); 
		$user_id = $stmtss->insert_id;

	 	
		$insertUserSchoolSql = "INSERT INTO edu_user_school_level_class (user_id, school_id, class_id,level_id) 
		VALUES(?,?,?,?)";
		$stmtss = $mysqli->prepare($insertUserSchoolSql);
		$stmtss->bind_param("ssss", $user_id,$school_id,$class_id,$level_id);
		$stmtss->execute();  

		subscribeSchool($skillData,$mysqli,$school_id,$user_id,$userType,$class_id,$level_id);
 	}

 	function subscribeSchool($skillData,$mysqli,$school_id,$user_id,$userType,$class_id,$level_id){
 		foreach($skillData as $item){
 			$magType = $item['issueId'];
 			$magId = $item['issueNo'];
 			$articalName = $item['article_id'];
 			$activityName = $item['activity_id'];

 			

 			/*$eduArticalStmt = $mysqli->prepare("SELECT  mag_id  FROM edu_magazine where mag_type_id = ? AND mag_id = ?");
			$eduArticalStmt->bind_param("ss",$articalId,$magId);
			$eduArticalStmt->execute();
			$result = $eduArticalStmt->get_result();
			$eduArticalStmt->close(); 

			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()) {
				  	$articalId = $row['article_id'];
				  	$activityId = 0;
				  	subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
				}
			}else{
				$activityId = 0;
				subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
			}*/

			if(!empty($magId) && (empty($articalName) && empty($activityName))){
				$eduArticalStmt = $mysqli->prepare("SELECT  article_id  FROM edu_article where mag_id = ?");
				$eduArticalStmt->bind_param("s",$magId);
				$eduArticalStmt->execute();
				$result = $eduArticalStmt->get_result();
				$eduArticalStmt->close(); 

				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
					  	$articalId = $row['article_id'];
					  	$activityId = 0;
					  	subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
					}
				}

				$eduActivityStmt = $mysqli->prepare("SELECT  activity_id,article_id  FROM edu_activity where mag_id = ?");
				$eduActivityStmt->bind_param("s",$magId);
				$eduActivityStmt->execute();
				$result = $eduActivityStmt->get_result();
				$eduActivityStmt->close(); 
				
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
					  	$articalId = $row['article_id'];
					  	$activityId = $row['activity_id'];
					  	subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
					}
				}
			}else{			
				$articalStmt = $mysqli->prepare("SELECT essay_type_id FROM edu_essay_type where essay_type=?");
				$articalStmt->bind_param("s", $articalName);
				$articalStmt->execute();
				$articalStmt->bind_result($essay_type_id); 
				$articalStmt->fetch();
				$articalStmt->close();
				$articalId = $essay_type_id;
				if(empty($articalId)){
					$insertArticalSql = "INSERT INTO edu_essay_type (essay_type, essay_type_status) 
					VALUES(?,?)";
					$stmtss = $mysqli->prepare($insertArticalSql);
					$stmtss->bind_param("ss", $articalName,$status);
					$stmtss->execute(); 
					$articalId = $stmtss->insert_id;
				} 
				$articalStmt = $mysqli->prepare("SELECT activity_type_id FROM edu_activity_type where activity_type=?");
				$articalStmt->bind_param("s", $activityName);
				$articalStmt->execute();
				$articalStmt->bind_result($activity_type_id); 
				$articalStmt->fetch();
				$articalStmt->close();
				$activityId = $activity_type_id;
				if(empty($activityId)){
					$insertArticalSql = "INSERT INTO edu_activity_type (activity_type, activity_type_status) 
					VALUES(?,?)";
					$stmtss = $mysqli->prepare($insertArticalSql);
					$stmtss->bind_param("ss", $activityName,$status);
					$stmtss->execute(); 
					$activityId = $stmtss->insert_id;
				} 
				$result = '';
				$eduArticalStmt = $mysqli->prepare("SELECT  article_id  FROM edu_article where essay_type_id = ? AND mag_id = ?");
				$eduArticalStmt->bind_param("ss",$articalId,$magId);
				$eduArticalStmt->execute();
				$result = $eduArticalStmt->get_result();
				$eduArticalStmt->close(); 

				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
					  	$articalId = $row['article_id'];
					  	$activityId = 0;
					  	subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
					}
				}else{
					$activityId = 0;
					subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
				}



				$articalStmt = $mysqli->prepare("SELECT activity_type_id FROM edu_activity_type where activity_type=?");
				$articalStmt->bind_param("s", $activityName);
				$articalStmt->execute();
				$articalStmt->bind_result($activity_type_id); 
				$articalStmt->fetch();
				$articalStmt->close();
				$activityId = $activity_type_id;
				if(empty($activityId)){
					$insertArticalSql = "INSERT INTO edu_activity_type (activity_type, activity_type_status) 
					VALUES(?,?)";
					$stmtss = $mysqli->prepare($insertArticalSql);
					$stmtss->bind_param("ss", $activityName,$status);
					$stmtss->execute(); 
					$activityId = $stmtss->insert_id;
				} 
				$result = '';
				$eduActivityStmt = $mysqli->prepare("SELECT  activity_id,article_id  FROM edu_activity where activity_type_id = ? AND mag_id = ?");
				$eduActivityStmt->bind_param("ss",$activityId,$magId);
				$eduActivityStmt->execute();
				$result = $eduActivityStmt->get_result();
				$eduActivityStmt->close(); 
				
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
					  	$articalId = $row['article_id'];
					  	$activityId = $row['activity_id'];
					  	subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
					}
				}else{ 
					subscribeDataInsert($mysqli,$articalId,$magId,$user_id,$school_id,$activityId,$level_id,$class_id,$userType);
				}
			}
 		}
 	}
 	function subscribeDataInsert($mysqli,$articalId,$magId,$userId,$schoolId,$activityId,$levelId,$classId,$userType){
 		$startDate = $_POST['startDate'];
 		$endDate = $_POST['endDate'];
 		$status = 'Active';
 		$insertArticalSql = "INSERT INTO edu_school_subscription (mag_id, article_id,activity_id,school_id,school_subscription_status,subscription_start_date,subscription_end_date,user_id,class_id,level_id,u_type_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		$stmtss = $mysqli->prepare($insertArticalSql);
		$stmtss->bind_param("sssssssssss", $magId,$articalId,$activityId,$schoolId,$status,$startDate,$endDate,$userId,$classId,$levelId,$userType);
		$stmtss->execute(); 
		$stmtss->close();  	 
 	} 
?>
<script type='text/javascript'> 
	alert('Data Insert Successfully.');
	setTimeout(function(){
	    window.location='../subscriber-new.php';
	}, 20);
</script>