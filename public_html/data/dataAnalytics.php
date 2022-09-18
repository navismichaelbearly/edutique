<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

$actCompleted = !empty($_POST['actCompleted'])?$_POST['actCompleted']:0;
$artCompleted = !empty($_POST['artCompleted'])?$_POST['artCompleted']:0;
$assignments = !empty($_POST['assignments'])?$_POST['assignments']:0;
$questionAsked = !empty($_POST['questionAsked'])?$_POST['questionAsked']:0;
$wordsSaved = !empty($_POST['wordsSaved'])?$_POST['wordsSaved']:0;
$bookmarkSaved = !empty($_POST['bookmarkSaved'])?$_POST['bookmarkSaved']:0;
$trending = !empty($_POST['trending'])?$_POST['trending']:0;
$totalUsers = !empty($_POST['totalUsers'])?$_POST['totalUsers']:0;
$bulkUsers = !empty($_POST['bulkUsers'])?$_POST['bulkUsers']:0;
$countryTot = !empty($_POST['countryTot'])?$_POST['countryTot']:0;
$schoolOrgtot = !empty($_POST['schoolOrgtot'])?$_POST['schoolOrgtot']:0;
$bulkUsersind = !empty($_POST['bulkUsersind'])?$_POST['bulkUsersind']:0;
$countryTotind = !empty($_POST['countryTotind'])?$_POST['countryTotind']:0;
$userTypeChart = !empty($_POST['user_chart'])?$_POST['user_chart']:0;
$magTypeChart = !empty($_POST['mag_chart'])?$_POST['mag_chart']:0;

if($actCompleted ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(b.task_id) AS activityCompletedcount FROM edu_task a inner join  edu_user_task b on a.task_id=b.task_id  WHERE activity_id!= ? and task_stages=? and completed_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_activity_id, $param_task_stages);
	/* Set parameters */
	$param_activity_id = 0;
	$param_task_stages = $completed;
	$stmt->execute();
	$stmt->bind_result($activityCompletedcount);
	$stmt->fetch();
	echo "<span class='textCount'>".$activityCompletedcount."</span><br><div class='textCompleted'>Activities Completed this Month</div>";
	$stmt->close();
}

if($artCompleted ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(b.task_id) AS articleCompletedcount FROM edu_task a inner join  edu_user_task b on a.task_id=b.task_id  WHERE activity_id= ? and task_stages=? and completed_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_activity_id, $param_task_stages);
	/* Set parameters */
	$param_activity_id = 0;
	$param_task_stages = $completed;
	$stmt->execute();
	$stmt->bind_result($articleCompletedcount);
	$stmt->fetch();
	echo "<span class='textCount'>".$articleCompletedcount."</span><br><div class='textCompleted'>Articles Completed this Month</div>";
	$stmt->close();
}

if($assignments ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(b.task_id) AS assignments FROM edu_task a inner join  edu_user_task b on a.task_id=b.task_id  WHERE  published_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");
	/* Bind parameters */
	//$stmt->bind_param("ss", $param_activity_id, $param_task_stages);
	/* Set parameters */
	//$param_activity_id = 0;
	//$param_task_stages = $completed;
	$stmt->execute();
	$stmt->bind_result($assignments);
	$stmt->fetch();
	echo "<span class='textCount'>".$assignments."</span><br><div class='textCompleted'>Assignments Made this Month</div>";
	$stmt->close();
}

if($questionAsked ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(id) AS questionasked FROM edu_question_portal  WHERE  parent_qp_id=? and publish_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");
	/* Bind parameters */
	$stmt->bind_param("s", $param_parent_qp_id);
	/* Set parameters */
	$param_parent_qp_id = 0;
	$stmt->execute();
	$stmt->bind_result($questionasked);
	$stmt->fetch();
	echo "<span class='textCount'>".$questionasked."</span><br><div class='textCompleted'>Questions Asked this Month</div>";
	$stmt->close();
}

if($wordsSaved ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(id) AS wordsSaved FROM edu_wordbank  WHERE   added_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");
	/* Bind parameters */
	//$stmt->bind_param("s", $param_parent_qp_id);
	/* Set parameters */
	//$param_parent_qp_id = 0;
	$stmt->execute();
	$stmt->bind_result($wordsSaved);
	$stmt->fetch();
	echo "<span class='textCount'>".$wordsSaved."</span><br><div class='textCompleted'>Words Saved this Month</div>";
	$stmt->close();
}

if($bookmarkSaved ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(id) AS bookmarkSaved FROM edu_annotation_bookmark  WHERE bookmark=? and  published_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ");
	/* Bind parameters */
	$stmt->bind_param("s", $param_bkm);
	/* Set parameters */
	$param_bkm = 1;
	$stmt->execute();
	$stmt->bind_result($bookmarkSaved);
	$stmt->fetch();
	echo "<span class='textCount'>".$bookmarkSaved."</span><br><div class='textCompleted'>Bookmarks Saved this Month</div>";
	$stmt->close();
}

if($trending ==1){
    $stmt = $mysqli->prepare("SELECT wname, COUNT(wname) AS value_occurrence FROM edu_wordbank WHERE   added_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP BY wname ORDER BY value_occurrence DESC limit ?");
	/* Bind parameters */
	$stmt->bind_param("s", $param_limit);
	/* Set parameters */
	$param_limit = 3;
	$stmt->execute();
	$result = $stmt->get_result();
	$results=[];
	while ($row = $result->fetch_assoc()) {
	$results[] ="{$row['wname']}";

	}
	//$final = join(",\r\n", $results);
	if(!empty($results[0]) && empty($results[1]) && empty($results[2])){
	  echo "<span class='textCount'>".$results[0]." </span>";
	}else if(!empty($results[0]) && !empty($results[1]) & empty($results[2])){
	  echo "<span class='textCount'>".$results[0].", ".$results[1]." </span>";
	}else if(!empty($results[0]) && !empty($results[1]) && !empty($results[2])){
	  echo "<span class='textCount'>".$results[0].", ".$results[1].", ".$results[2]." </span>";
	}else{

	}
	echo "<br><div class='textCompleted'>Trending this Month</div>";
	$stmt->close();
}

if($totalUsers ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(a.user_id) AS totalUsers FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id  WHERE utype_id=? or utype_id=?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_user_type_id,$param_user_type_id2);
	/* Set parameters */
	$param_user_type_id = $admstdconst;
	$param_user_type_id2 = $admindvconst;
	$stmt->execute();
	$stmt->bind_result($totalUsers);
	$stmt->fetch();
	echo "<span class='textCount'>".$totalUsers."</span><br><div class='textCompleted'>Current Users</div>";
	$stmt->close();
}

if($bulkUsers ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(a.user_id) AS bulkUsers FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id  WHERE utype_id=? ");
	/* Bind parameters */
	$stmt->bind_param("s", $param_user_type_id);
	/* Set parameters */
	$param_user_type_id = $admstdconst;
	$stmt->execute();
	$stmt->bind_result($bulkUsers);
	$stmt->fetch();
	echo "<span class='textCount'>".$bulkUsers."</span><br><div class='textCompleted'>Bulk Users</div>";
	$stmt->close();
}

if($countryTot ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(DISTINCT(country_id)) AS countryTot FROM edu_school  group by country_id ");
	/* Bind parameters */
	//$stmt->bind_param("s", $param_user_type_id);
	/* Set parameters */
	//$param_user_type_id = $admstdconst;
	$stmt->execute();
	$stmt->bind_result($countryTot);
	$stmt->fetch();
	echo "<span class='textCount'>".$countryTot."</span><br><div class='textCompleted'>Countries</div>";
	$stmt->close();
}

if($schoolOrgtot ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(school_id) AS schoolOrgtot FROM edu_school");
	/* Bind parameters */
	//$stmt->bind_param("s", $param_user_type_id);
	/* Set parameters */
	//$param_user_type_id = $admstdconst;
	$stmt->execute();
	$stmt->bind_result($schoolOrgtot);
	$stmt->fetch();
	echo "<span class='textCount'>".$schoolOrgtot."</span><br><div class='textCompleted'>Schools/Organisations</div>";
	$stmt->close();
}

if($bulkUsersind ==1){
    $stmt = $mysqli->prepare("SELECT COUNT(a.user_id) AS bulkUsersind FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id  WHERE utype_id=?");
	/* Bind parameters */
	$stmt->bind_param("s", $param_user_type_id);
	/* Set parameters */
	$param_user_type_id = $admindvconst;
	$stmt->execute();
	$stmt->bind_result($bulkUsersind);
	$stmt->fetch();
	echo "<span class='textCount'>".$bulkUsersind."</span><br><div class='textCompleted'>Indiv Subs</div>";
	$stmt->close();
}

if($countryTotind ==1){
    /*$stmt = $mysqli->prepare("SELECT COUNT(DISTINCT(country_id)) AS countryTot FROM edu_school  group by country_id ");

	$stmt->execute();
	$stmt->bind_result($countryTot);*/
	$countryTotind =1;
	//$stmt->fetch();
	echo "<span class='textCount'>".$countryTotind."</span><br><div class='textCompleted'>Countries</div>";
	//$stmt->close();
}

if($userTypeChart ==1){
	$souserTypeStmt = $mysqli->prepare("
	SELECT month(a.user_created_date) as createdat, count(a.user_id) as totalusers
	FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id
	WHERE utype_id=? OR  utype_id =? OR  utype_id =?
	group by createdat
	order by createdat ASC");

	//$userTypeResult = $mysqli->query($userTypequery);
	//$userType_data = array();
        $souserTypeStmt->bind_param("sss", $param_user_type1, $param_user_type2, $param_user_type3);
		$param_user_type1=2;
		$param_user_type2=4;
	    $param_user_type3 = 3;
		$souserTypeStmt->execute();
		$souserTypeResult = $souserTypeStmt->get_result();
		$souserType_data = [];
		while($row = $souserTypeResult->fetch_assoc()) {
		  $createdMonth = date("F", mktime(0, 0, 0, $row['createdat'], 10));
		  $souserType_data[] = array(
		    'createdmonth'=>$createdMonth,
		    'users'=>$row['totalusers'],
		  );
		}

		//$souserTypeStmt->close();
$induserTypeStmt = $mysqli->prepare("
	SELECT month(a.user_created_date) as createdat, count(a.user_id) as totalusers
	FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id
	WHERE utype_id=?
	group by createdat
	order by createdat ASC");

	//$userTypeResult = $mysqli->query($userTypequery);
	//$userType_data = array();
        $induserTypeStmt->bind_param("s", $param_user_type1);
		$param_user_type1 = 6;
		$induserTypeStmt->execute();
		$induserTypeResult = $induserTypeStmt->get_result();
		$induserType_data = [];
		while($row = $induserTypeResult->fetch_assoc()) {
		  $createdMonth = date("F", mktime(0, 0, 0, $row['createdat'], 10));
		  $induserType_data[] = array(
		    'createdmonth'=>$createdMonth,
		    'users'=>$row['totalusers'],
		  );
		}
		echo JSON_encode(array($souserType_data, $induserType_data));
		//$induserTypeStmt->close();
}
if($magTypeChart ==1){
	$imuserTypeStmt = $mysqli->prepare("
	SELECT month(a.subscription_start_date) as imsubmonth, count(a.user_id) as imsubtot
	from edu_school_subscription a inner join edu_magazine b on a.mag_id=b.mag_id
	where b.mag_type_id=?
	GROUP by imsubmonth
	order by imsubmonth ASC");

	//$userTypeResult = $mysqli->query($userTypequery);
	//$userType_data = array();
        $imuserTypeStmt->bind_param("s", $param_mag1);
		$param_mag1=3;
		$imuserTypeStmt->execute();
		$imuserTypeResult = $imuserTypeStmt->get_result();
		$imuserType_data = [];
		while($row = $imuserTypeResult->fetch_assoc()) {
		  $createdMonth = date("F", mktime(0, 0, 0, $row['imsubmonth'], 10));
		  $imuserType_data[] = array(
		    'immonth'=>$createdMonth,
		    'imtot'=>$row['imsubtot'],
		  );
		}

		$imuserTypeStmt->close();
$ituserTypeStmt = $mysqli->prepare("
	SELECT month(a.subscription_start_date) as itsubmonth, count(Distinct a.user_id) as itsubtot
	from edu_school_subscription a inner join edu_magazine b on a.mag_id=b.mag_id
	where b.mag_type_id=?
	GROUP by itsubmonth
	order by itsubmonth ASC");

	//$userTypeResult = $mysqli->query($userTypequery);
	//$userType_data = array();
        $ituserTypeStmt->bind_param("s", $param_mag1);
		$param_mag1=2;
		$ituserTypeStmt->execute();
		$ituserTypeResult = $ituserTypeStmt->get_result();
		$ituserType_data = [];
		while($row = $ituserTypeResult->fetch_assoc()) {
		  $createdMonth = date("F", mktime(0, 0, 0, $row['itsubmonth'], 10));
		  $ituserType_data[] = array(
		    'itmonth'=>$createdMonth,
		    'ittot'=>$row['itsubtot'],
		  );
		}
		//echo JSON_encode(array($ituserType_data, $ituserType_data));
		$ituserTypeStmt->close();
		$inuserTypeStmt = $mysqli->prepare("
	SELECT month(a.subscription_start_date) as insubmonth, count(a.user_id) as insubtot
	from edu_school_subscription a inner join edu_magazine b on a.mag_id=b.mag_id
	where b.mag_type_id=?
	GROUP by insubmonth
	order by insubmonth ASC");

	//$userTypeResult = $mysqli->query($userTypequery);
	//$userType_data = array();
        $inuserTypeStmt->bind_param("s", $param_mag1);
		$param_mag1=1;
		$inuserTypeStmt->execute();
		$inuserTypeResult = $inuserTypeStmt->get_result();
		$inuserType_data = [];
		while($row = $inuserTypeResult->fetch_assoc()) {
		  $createdMonth = date("F", mktime(0, 0, 0, $row['insubmonth'], 10));
		  $inuserType_data[] = array(
		    'inmonth'=>$createdMonth,
		    'intot'=>$row['insubtot'],
		  );
		}

		$inuserTypeStmt->close();
		echo JSON_encode(array($imuserType_data, $ituserType_data, $inuserType_data));
}

?>