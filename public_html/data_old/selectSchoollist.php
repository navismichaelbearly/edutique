<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

function get_art_id($mag_id,$mysqli){
	$article_id_one = $param_mag_id = '';
	$stmt2 = $mysqli->prepare("SELECT article_id from edu_article where mag_id = ? order by article_id asc limit 1");
	$stmt2->bind_param("i", $param_mag_id);
	$param_mag_id = $mag_id;
	$stmt2->execute();
	$stmt2->bind_result($article_id_one);
	$stmt2->fetch();
	$stmt2->close();
	return $article_id_one;
}


/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";


if ($_POST['schoolVar'] != '') {
	if ($stmt = $mysqli->prepare("SELECT school_id,school_name,country_name,school_address,school_created_date,postal_code FROM edu_school a inner join edu_country b on a.country_id=b.country_id where school_status=?")) {

		$stmt->bind_param("s", $param_school_status);
		// Set parameters 
		$param_school_status = $active;

		$stmt->execute();
		/* bind variables to prepared statement */
		$stmt->bind_result($school_id,$school_name,$country_name,$school_address,$school_created_date,$postal_code);
		$sr = 1;

		echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
		<thead>
			<tr><td>No.</td>
				<th>School</th>
				<th>Country</th>
				<th>Address</th>
				<th>Postal Code</th>
				<th>Created Date</th>
				<th>Levels</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		";

		while ($stmt->fetch()) {
  echo "<tr><td style='vertical-align:middle'>".$sr."</td>";
		       echo "<td class='normaltext'>" . $school_name ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $country_name ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $school_address ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $postal_code."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $school_created_date ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'><a href='levels.php?schoolID=" . $school_id . "'><i class='material-icons-outlined md-16 annocom' id='editSchool' data-id='" . $school_id . "'>visibility</i></a></td>";
					   echo "<td class='normaltext' style='vertical-align:middle'><a href='edit-school.php?schoolID=" . $school_id . "'><i class='material-icons-outlined md-16 annocom' id='editSchool' data-id='" . $school_id . "'>create</i></a></td>";
		  echo "</tr>" ;
		
		 $sr++;
	 }
   }	 
}
