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
	$data = [];
	$html = "";
	$sql = "SELECT a.class_id, a.class_name FROM edu_class as a  inner join
	edu_user_school_level_class as b
	on a.class_id =b.class_id
	where a.level_id=? and a.class_status='active' and b.user_id=?";
	if ($stmt = $mysqli->prepare($sql)) {
		// Set parameters 
		$param_user_id = $_SESSION['id'];
		$stmt->bind_param("ii",$classid, $param_user_id);
		$stmt->execute();
		/* bind variables to prepared statement */
		$stmt->bind_result($class_id, $class_name);
		$sr = 1;
		while ($stmt->fetch()) {
		$html .=  "<div id ='checkAllStudent_$class_id' name='Check All'>
						<input type='checkbox' class='chklevel'  id='checkParentitem_$class_id' value=$class_id  onclick='levelCheckBoxAllStudent(this)' /> " . $class_name ."
				  	<a data-id='". $class_id ."' class='btn  btn-sm btn-light bg-transparent mr-4 downarrow' onclick='showStudent(this)'>
									<i data-id='". $class_id ."' class='fa fa-chevron-down' aria-hidden='true'>
									</i>
								</a>
								 <div class='studentlist_".$class_id."'></div>
				  </div> ";
				 
		$html.="</div>";
			$sr++;
		}
	}

	$html .= "<br>";
	echo $html;
	
}


