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

if ($_POST['magTitle'] != "") {
	foreach ($_POST['magTitle'] as $key => $value) {
		$value;
	}
	$magVar = "order by a.mag_title " . $value;
} else if ($_POST['magDate'] != "") {
	foreach ($_POST['magDate'] as $key => $value) {
		$value;
	}
	$magVar = "order by a.mag_published_date " . $value;
} else {
	$magVar = " ";
}

if ($_POST['mag'] != '') {
	if ($stmt = $mysqli->prepare("SELECT Distinct(a.mag_id),a.mag_title, a.mag_issue,a.mag_published_date,a.mag_image_path, b.mag_type from edu_magazine a inner join edu_mag_type b on a.mag_type_id = b.mag_type_id inner join edu_school_subscription e on a.mag_id=e.mag_id inner join edu_user_school_level_class f on e.school_id = f.school_id where a.mag_status=? and b.mag_type_status= ? and f.user_id=? " . $magVar)) {

		$stmt->bind_param("sss", $param_status, $param_status2,$param_userid);
		// Set parameters 
		$param_status = $active;
		$param_status2 = $active;
		$param_userid = $_SESSION['id'];

		$stmt->execute();
		/* bind variables to prepared statement */
		$stmt->bind_result($mag_id, $mag_title, $mag_issue, $mag_published_date, $mag_image_path, $mag_type);
		$sr = 1;

		echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
		<thead>
			<tr><td>No.</td>
				<th>Magazine</th>
				<th>Issue</th>
				<th>Theme</th>
				<th>Published Date</th>
			</tr>
		</thead>
		<tbody>
		";

		$push_arr = array();

		while ($stmt->fetch()) {
			// push all data to array
			$push_arr[] = array(
				'mag_id' => $mag_id,
				'mag_title' => $mag_title,
				'mag_issue' => $mag_issue,
				'mag_published_date' => $mag_published_date,
				'mag_image_path' => $mag_image_path,
				'mag_type' => $mag_type
			);
		}
		// close sql connection
		$stmt->close();
		
		// loop thorugh array and display data
		foreach ($push_arr as $key => $value) {

			$mag_id = $value['mag_id'];
			$mag_title = $value['mag_title'];
			$mag_issue = $value['mag_issue'];
			$mag_published_date = $value['mag_published_date'];
			$mag_image_path = $value['mag_image_path'];
			$mag_type = $value['mag_type'];
			$article_id_one = get_art_id($mag_id,$mysqli);
			$new_date = date_create($mag_published_date);
			$newDate = date("d M Y", strtotime($mag_published_date));

			// if mag_id is not null
			if ($mag_id != null) {

				$stringContent = strlen($mag_title) > 50 ? substr($mag_title,0,70)."..." : $mag_title;
				echo "<tr><td style='vertical-align:middle'>".$sr."</td>";
				echo "<td class='normaltext'><a href='magDetail.php?magID=".$mag_id."&artID=".$article_id_one."&actID=0&prev=1'><img src='".$mag_image_path."' width='100' height='133' class='img__img' style='border:1px solid #CCCCCC'></a>
						<p><br>" . $mag_type ." Magazine</p></td>";
				echo "<td class='normaltext' style='vertical-align:middle'>" . $mag_type." ".$mag_issue ."</td>";
				echo "<td class='normaltext' style='vertical-align:middle'>" . $mag_title ."</td>";
				echo "<td class='normaltext' style='vertical-align:middle'>" . $newDate ."</td>";
				echo "</tr>" ;
				$sr++;
			}
		}
	}
}
