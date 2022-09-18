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
	$stmt = $mysqli->prepare("SELECT id,message_title FROM edu_messages where status=? and from_id=? and parent_msg_id=? and message_type=?");
	/* Bind parameters */
	$stmt->bind_param("ssss", $param_status,$param_from_id,$param_parent_msg_id,$param_message_type);
	/* Set parameters */
	
	$param_status = $active;
	$param_from_id = $_SESSION["id"];
	$param_parent_msg_id = 0;
	$param_message_type = $nontech;
	$stmt->execute();
	$stmt->bind_result($id,$message_title);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
	 
                                        <thead>
                                            <tr><th><input type='checkbox' id='select_all'> Select </th><th>No.</th>
                                                <th>Ref No.</th>
                                                <th>Message Title</th>
												
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>	
										";								
	 // fetch values 
	 while ($stmt->fetch()) {
	       echo "<tr><td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $id . "'></td><td>" . $sr . "</td>";
		  echo "<td class='normaltext'>" . $id . "</td>";
		 
		  
		  echo "<td class='normaltext'>" . $message_title . "</td><td><a href='detailmessagelog.php?mId=$id'><i class='material-icons annocom' >visibility</i></a>
		  &nbsp;&nbsp;&nbsp;&nbsp;
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
?>
