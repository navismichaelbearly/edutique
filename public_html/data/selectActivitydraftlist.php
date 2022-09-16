<?php
error_reporting(-1);
ini_set('display_errors', true);
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
$articleDraft = !empty($_POST['articleDraft']) ? $_POST['articleDraft'] : 0;
if ($_SESSION["id"] == 1) {
	if ($articleDraft  == 1) {


		if ($stmt = $mysqli->prepare("SELECT activity_title, activity_published_date, theme, difficulty_level, activity_id FROM edu_activity_dummy")) {


			//$stmt->bind_param("s", $param_teach_id);
			// $param_teach_id = $_SESSION['id'];	

			$stmt->execute();
			/* bind variables to prepared statement */
			$stmt->bind_result($activity_title, $art_year, $theme, $difficulty_level, $activity_id);
			$sr = 1;
			echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th>
													    <th>No.</th>
														<th>ActivityTitle</th>
														<th>Year</th>
														<th>Theme</th>
														<th>Difficulty Level</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												";

			/* fetch values */
			while ($stmt->fetch()) {
				echo "<tr>";

				$draftLink = "save-activity-draft.php?actID=" . $activity_id;
				$newDate = date("d M Y", strtotime($art_year));

                echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $activity_id . "'></td>";
			    echo "<td class='normaltext'>" .$sr."</td>";
				echo "<td class='normaltext'>" . $activity_title . "</td>";
				echo "<td class='normaltext'>" . $newDate . "</td>";
				echo "<td class='normaltext'>" . $theme . "</td>";
				echo "<td class='normaltext'>" . $difficulty_level . "</td>";

				echo "<td class='normaltext'><a href='" . $draftLink . "'><i class='material-icons-outlined md-16 annocom' id='editDraft'>create</i></a></td>";


				echo "</tr>";
				$sr++;
			}

			echo "
												</tbody>    
											  </table>";
		}
	}
}
