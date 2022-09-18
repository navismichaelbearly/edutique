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
if($_POST['messageId'] != '')
{
	$stmt = $mysqli->prepare("SELECT id,message_title FROM edu_messages where id=? and status=? and from_id=? and parent_msg_id=? and message_type=?");
	/* Bind parameters */
	$stmt->bind_param("sssss", $param_id,$param_status,$param_from_id,$param_parent_msg_id,$param_message_type);
	/* Set parameters */
	$param_id = $_POST['msgpId'];
	$param_status = $active;
	$param_from_id = $_SESSION["id"];
	$param_parent_msg_id = 0;
	$param_message_type = $nontech;
	$stmt->execute();
	$stmt->bind_result($id,$message_title);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
	 
                                        <thead>
                                            <tr>
                                                <th>Ref No.</th>
                                                <th>Message Title</th>
												
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>	
										";								
	 // fetch values 
	 while ($stmt->fetch()) {
	      
		  echo "<tr><td class='normaltext'>" . $id . "</td>";
		 
		  
		  echo "<td class='normaltext'>" . $message_title . "</td><td align='right'>
		  <i class='material-icons annocom' id='msgDel' data-id='" . $id . "'>delete</i></td>"; 
		  
		  	$sr++;
	 }
	 echo "</tbody></table>";
}

if($_POST['messageDltid'] != '')
{

$stmt = $mysqli->prepare("delete FROM edu_messages where status=? and (id=? or parent_msg_id=?)");

$stmt->bind_param("sss", $param_status,$param_msg_id,$param_parent_msg_id);
$param_status = $active;
$param_msg_id = $_POST['messageDltid'];
$param_parent_msg_id = $_POST['messageDltid'];
$stmt->execute();
$stmt->close();


}

if($_POST['messageDetail'] != '' && $_POST['msgpId'] != '')
{
	

	$stmt = $mysqli->prepare("SELECT a.id,a.message_content, a.publish_date,a.from_id, b.username FROM edu_messages a inner join edu_users b on b.user_id=a.from_id where status=? and (from_id=? or to_id=?) and (parent_msg_id=? or parent_msg_id=?) and message_type=?; ");
	/* Bind parameters */
	$stmt->bind_param("ssssss", $param_status,$param_from_id,$param_to_id,$param_parent_msg_id, $param_parent_msg_id2,$param_message_type);
	/* Set parameters */
	
	$param_status = $active;
	$param_from_id = $_SESSION["id"];
	$param_to_id = $_SESSION["id"];
	$param_parent_msg_id = $_POST['msgpId'];
	$param_parent_msg_id2 = 0;
	$param_message_type = $nontech;
	$stmt->execute();
	$stmt->bind_result($id,$message_content,$publish_date,$fromid1, $un);
	 $sr =1;							
	 // fetch values 
	 while ($stmt->fetch()) {
	       if($_SESSION['id']!=$fromid1) { $var1 = $un; } else { $var1 = 'You'; } 
		   $newDate = date("d M Y", strtotime($publish_date));
		 
		  
		   echo "<div class='col-lg-12' style='background-color: #ffffff; padding:10px; margin-bottom:20px;'>
		  <div >". $var1 ."</div>
		  <div class='normaltext normaltextsize'>".$newDate ."</div>
		  <div class='normaltext'>". $message_content ."</div>
		  </div>";
		  
		  	$sr++;
	 }
	
	 
}






 
?>
