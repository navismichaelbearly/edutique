<?php

//submit_rating.php

error_reporting(-1);
ini_set('display_errors', true);
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

if(isset($_POST["rating_data"]))
{

	/*$data = array(
		':user_name'		=>	$_POST["user_name"],
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>	time()
	);*/

	$insertSql = "
	INSERT INTO edu_review 
	(user_id, user_rating, user_review, datetime, mag_id,art_id,act_id,user_type_id,status) 
	VALUES (?, ?, ?, ?,?,?,?,?,?)
	";

	$stmts = $mysqli->prepare($insertSql);
    $stmts->bind_param("sssssssss", $param_user_id, $param_user_rating, $param_user_review, $param_datetime, $param_mag_id, $param_art_id, $param_act_id, $param_user_type_id, $param_status);
	
				$param_user_id = $_SESSION["id"];
				$param_user_rating = $_POST["rating_data"];
				$param_user_review = $_POST["user_review"];
				$param_datetime = $todaysDate;
				$param_mag_id = $_POST["magazineID"];
				$param_art_id = $_POST["art_id"];
				$param_act_id = $_POST["act_id"];
				$param_user_type_id = $_SESSION["utypeid"];
				$param_status = $inactive;
				$stmts->execute();
				$stmts->close();

	//echo "Your Review & Rating Successfully Submitted";

}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	
    $stmt = $mysqli->prepare("SELECT user_id, user_rating, user_review, datetime, mag_id,art_id,act_id,user_type_id,status FROM edu_review where mag_id=? and art_id=? and act_id=? and status=? ORDER BY review_id DESC");
	$stmt->bind_param("ssss", $param_mag_id, $param_art_id, $param_act_id, $param_status);
	
	$param_mag_id = $_POST["magazineID"];
	$param_art_id = $_POST["art_id"];
	$param_act_id = $_POST["act_id"];
	$param_status = $active;
	$stmt->execute();
    $result = $stmt->get_result();

	foreach($result as $row)
	{   $pubdate = date("d M Y", strtotime($row["datetime"]));
	    
		$stmt2 = $mysqli->prepare("Select first_name, last_name,user_image_path from edu_users a INNER JOIN edu_review b on a.user_id=b.user_id where a.user_status=? and a.user_id=?");
						
						/* Set parameters */
						$stmt2->bind_param("ss", $param_status, $param_uid);
					    $param_status =$active;
						$param_uid = $row["user_id"];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
		$review_content[] = array(
			'user_name'		=>	$row2["last_name"]." ". $row2["first_name"],
			'user_review'	=>	$row["user_review"],
			'rating'		=>	$row["user_rating"],
			'datetime'		=>	$pubdate
		);

		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>