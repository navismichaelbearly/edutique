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

if ($_POST['asssignInfo'] != '') {






	if ($stmt = $mysqli->prepare("INSERT INTO edu_level_class_temp (levelname, class_name,level_id, class_id,school_id,user_id) SELECT b.level, group_concat(c.class_name),b.level_id, group_concat(c.class_id),a.school_id,a.user_id from edu_user_school_level_class a inner join edu_levels b on a.level_id=b.level_id inner join edu_class c on a.class_id = c.class_id where a.school_id= ? and a.user_id =? group by b.level_id order by c.class_name ASC")) {


		$stmt->bind_param("ss", $param_school_id, $param_user_id);
		// Set parameters 
		$param_school_id = $school_id;
		$param_user_id = $_SESSION['id'];



		$stmt->execute();
		$stmt->close();
	}

	$data = [];
	$html = "<div id='level_selection'>";
	//$sql = "SELECT levelname, class_name,level_id,class_id from edu_level_class_temp where school_id= ? and user_id =?";
	$sql = "SELECT  el.level as levelname,ec.class_name,el.level_id,ec.class_id  FROM
	edu_user_school_level_class as euslc 
	left join edu_levels el on euslc.level_id = el.level_id
	left join edu_class ec on euslc.class_id = ec.class_id
	 where ec.school_id= ? and ec.class_status = ? and el.level_status = ? and euslc.user_id = ?";
	if ($stmt = $mysqli->prepare($sql)) {

		// Set parameters 
		$param_school_id = $school_id;
		$param_user_id = $_SESSION['id'];
		$param_class_status = $active;
		$param_level_status = $active;
		$stmt->bind_param("ssss", $param_school_id, $param_class_status, $param_level_status, $param_user_id);
		$stmt->execute();
		/* bind variables to prepared statement */
		$stmt->bind_result($level_name, $class_name, $level_id, $class_id);
		$sr = 1;
		$html .=  "<label for='Send To'>Assign To:</label><br><table class='table' style='width:100%; background-color:transparent'>";
		while ($stmt->fetch()) {
			$data[$level_id]['level_name'] = $level_name;
			$data[$level_id]['classDetails'][$class_id]['class_id'] = $class_id;
			$data[$level_id]['classDetails'][$class_id]['class_name'] = $class_name;
			$data[$level_id]['level_id'] = $level_id;
			$sr++;
		}
	}
	foreach ($data as $key => $value) {
		if (isset($value['level_name']) && !empty($value['level_name'])) {
			$html .=  "<div id ='checkAllitem_$key' name='Check All'><div><input type='checkbox' id='checkParentitem_$key' value=$key name='levelname[]' onclick='levelCheckBoxAll(this)' /> " . $value['level_name'] . "</div>";
		}

		if (isset($value['classDetails']) && !empty($value['classDetails'])) {
			$html .= "<div>&nbsp;&nbsp;&nbsp";
			foreach ($value['classDetails'] as $classId => $classDetails) {
				$html .= "&nbsp;&nbsp;  <input type='checkbox' id='checkSingleItem_$classId' value='" . $classDetails['class_id'] . "' name='$key' /> " . $classDetails['class_name'];
			}
			$html .= "</div><br>";
		}

		if (isset($value['level_id']) && !empty($value['level_id'])) {
			$html .= '</div></div>';
		}
	}
	$html .= "</div><br>";
	echo $html;
	/* $stmt = $mysqli->prepare("Delete from edu_level_class_temp  where school_id= ? and user_id =?");
			 
			 
					$stmt->bind_param("ss", $param_school_id, $param_user_id);
					 // Set parameters 
				    $param_school_id = $school_id;
				    $param_user_id = $_SESSION['id'];
			 
			
			 
			 $stmt->execute();
			 $stmt->close();*/
}
