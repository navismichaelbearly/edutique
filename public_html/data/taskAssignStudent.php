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
include "userSchoolinfo.php";

if ($_POST['classlevelid'] != '') {


	$classid=$_POST['classlevelid']; 
	$isChecked=$_POST['isChecked'] ?? 0; 
	$level=$_POST['level'] ?? 0; 
	$artId=$_POST['art_id'] ?? 0; 
	$data = [];
	$html = "";
	$actIds = 0;
	$artIds = 0;
	if(!empty($_POST['actIds'])){
		$actIds=implode(',',$_POST['actIds']);
	}
	if(!empty($_POST['artId'])){
		$artIds=implode(',',$_POST['artId']);
	}
	 
	$sql = "Select eu.user_id, eu.first_name, eu.last_name, ed.level_id, ed.class_id from edu_users as eu  inner join
	edu_user_school_level_class as ed on eu.user_id=ed.user_id where eu.user_type_id=3 and ed.class_id=? ";
	if ($stmt = $mysqli->prepare($sql)) {
		// Set parameters 
		$stmt->bind_param("i",$classid);
		$stmt->execute();
		/* bind variables to prepared statement */
		/*$stmt->bind_result($user_id, $first_name, $last_name, $level_id, $class_id);*/
		$sr = 1;
		$result1 = $stmt->get_result();  
		$stmt->close();
		while ($row = $result1->fetch_assoc()) {

			$disabled = '';
			$checked = '';
			$className = 'allStudent';
			if($isChecked == '1'){
				$checked = 'checked="checked"';
			} 
			$usrId = $row['user_id'];
			/*$taskStmt = $mysqli->prepare("SELECT eut.task_id FROM edu_task as et LEFT JOIN edu_user_task eut on et.task_id = eut.task_id where et.article_id IN (?) AND et.class_id = ? AND eut.assigned_to = ? AND et.activity_id IN (?)"); 
			$taskStmt->bind_param("ssss",$artIds,$classid,$usrId,$actIds); 
			$taskStmt->execute(); 
			$taskStmt->store_result();
		   	$taskStmt->fetch();
		   	if($taskStmt->num_rows() > 0){ 
		   		$disabled ='checked="checked"';
		   		$className = '';
		   	}
			$taskStmt->close();*/

			$data[$sr]['userid'] = $usrId;
			$html .=  "<input type='checkbox' data-label='chkstudent' data-level=$level_id data-class=$class_id class='studentcheck chkstudent ".$className."-".$classid."' id='checkParentitem_$usrId' name='classDetail[".$level."][".$classid."][user_id][]' value=".$usrId." ".$checked."/> " . $row['first_name']." " .$row['last_name'] ."
					<br>
				  </div>"; 
			$sr++;
		}
	}

	$html .= "<br>";
	echo $html;
	
}
