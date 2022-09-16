<?php

//fetch_user.php

require_once "../inc/config.php";
include "../inc/constants.php";

session_start();
if($_SESSION["utype"]==$admintitle){
$stmt = $mysqli->prepare("SELECT a.first_name, a.last_name,a.user_id,a.username, b.user_type FROM edu_users a inner join edu_utype b on a.user_type_id =b.user_type_id  WHERE a.user_id != ?");
$stmt->bind_param("s", $param_user_id);
}elseif($_SESSION["utype"]==$studentText){
$stmt = $mysqli->prepare("SELECT a.first_name, a.last_name,a.user_id,a.username, b.user_type FROM edu_users a inner join edu_utype b on a.user_type_id =b.user_type_id inner join edu_user_school_level_class c on a.user_id=c.user_id   WHERE a.user_id != ? AND (b.utype_id=? || b.utype_id=? || b.utype_id=?) AND c.school_id=? UNION ALL SELECT a.first_name, a.last_name,a.user_id,a.username, b.user_type FROM edu_users a inner join edu_utype b on a.user_type_id =b.user_type_id WHERE a.user_id != ? AND b.utype_id=?");
$stmt->bind_param("sssssss", $param_user_id,$param_utype_id1,$param_utype_id2,$param_utype_id3,$param_school_id,$param_user_id2,$param_utype_id4);
}elseif($_SESSION["utype"]==$classteacherText || $_SESSION["utype"]==$proraminchargeText){
$stmt = $mysqli->prepare("SELECT a.first_name, a.last_name,a.user_id,a.username, b.user_type FROM edu_users a inner join edu_utype b on a.user_type_id =b.user_type_id inner join edu_user_school_level_class c on a.user_id=c.user_id   WHERE a.user_id != ? AND b.utype_id=?  AND c.school_id=? UNION ALL SELECT a.first_name, a.last_name,a.user_id,a.username, b.user_type FROM edu_users a inner join edu_utype b on a.user_type_id =b.user_type_id WHERE a.user_id != ? AND b.utype_id=?");
$stmt->bind_param("sssss", $param_user_id,$param_utype_id8,$param_school_id,$param_user_id2,$param_utype_id4);
}

    /* Bind parameters */
    
    /* Set parameters */
    $param_user_id = $_SESSION['id'];
	$param_utype_id1 = $admconst;
	$param_utype_id2 = $admtchconst;
	$param_utype_id3 = $admprogtchconst;
	$param_school_id = $_SESSION['school_id'];
	$param_user_id2 = $_SESSION['id'];
	$param_utype_id4 = $admconst;
	$param_utype_id8 = $admstdconst;
    $stmt->execute();
    $result = $stmt->get_result();
	$output = '
<table class="table table-striped table-bordered" style="width:100%" id="example">
	
	<thead>
      <tr>
          <th >Name</td>
		  <th >User Type</td>
		  <th >Status</td>
		  <th >Action</td>
     </tr>
   </thead>
   <tbody>
';
    foreach($result as $row)
	{
		$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['user_id'], $mysqli);
	if($user_last_activity > $current_timestamp)
	{
		$status = '<span class="label label-success">Online</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .= '
	<tr>
		<td class="normaltext">'.$row['last_name'].' '.$row['first_name'].' '.count_unseen_message($row['user_id'], $_SESSION['id'], $mysqli).' '.fetch_is_type_status($row['user_id'], $mysqli).'</td>
		<td class="normaltext">'.$row['user_type'].'</td>
		<td class="normaltext">'.$status.'</td>
		<td class="normaltext"><button type="button" class="btn btn-default btn-xl start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
	</tr>
	';
	}
	$output .= '</tbody></table>';

echo $output;



?>