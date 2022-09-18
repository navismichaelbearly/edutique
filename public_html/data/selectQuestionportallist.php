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

if($_POST['userId'] != '')
{
 /*if($_POST['qpId'] != ''){
    $qry = " and b.id=? or b.parent_qp_id=?";
 }else{
    $qry = " and b.id=? or b.parent_qp_id=?  limit ?,?";
 }*/
  
 /*if ($stmt = $mysqli->prepare("SELECT a.user_image_path, a.first_name,  b.content, b.publish_date,a.last_name,c.user_type, b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id, b.id FROM edu_users a
INNER JOIN edu_question_portal b ON a.user_id=b.qp_by inner join edu_utype c on a.user_type_id=c.user_type_id where b.status=? and b.qp_to=? ".$qry)) {*/
    /* if($_POST['qpId'] != ''){
        $stmt->bind_param("ssss", $param_status, $param_user_id, $param_id, $param_parent_id);
     }else{
        $stmt->bind_param("ssssss", $param_status, $param_user_id, $param_id, $param_parent_id, $param_calPage, $param_totPages);
     }*/
	 
	 if ($stmt = $mysqli->prepare("SELECT a.user_image_path, a.first_name,  b.content, b.publish_date,a.last_name,c.user_type, b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id, b.id FROM edu_users a
INNER JOIN edu_question_portal b ON a.user_id=b.qp_by inner join edu_utype c on a.user_type_id=c.user_type_id where b.status=? and b.qp_to=? limit 2")) {
     $stmt->bind_param("ss", $param_status, $param_user_id);  
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_POST['userId'];
	 $param_totPages = $_POST['totPages'];
	 $param_calPage = $_POST['calPage'];
	 $param_id = $_POST['qpId'];
	 $param_parent_id = $_POST['qpId'];
    
	 
	 $stmt->execute();
	 // bind variables to prepared statement 
	 $stmt->bind_result($col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9,$col10,$col11, $qpid);
	 $sr =1;
	 // fetch values 
	 while ($stmt->fetch()) {
	      
		  if($col6 == $admintitle){
		    $name = $col6;
		  }else {
		     $name = $col6. " " .$col5. " " .$col2 ;
		  }	
		  $newDate = date("d M Y H:i", strtotime($col4));
		  echo "<a href='question-portal.php?qpId=".$qpid."&qp_to=".$col8."&qp_by=".$col9."&art_id=".$col10."&act_id=".$col11."' style='color:#323c47; text-decoration:none'>";
          if($_POST['dashVar'] == 2) {		  
	        echo "<div class='row'><div class='col-lg-1'><span class='user' style='background-image:url(upload/" . $col1 . "); margin:15px'></span></div><div  class='col-lg-11'>";
	     }
		  echo "<table class='tablebod'><tr>";
		       echo "<td> <span class=''>" . $name . "</span></td>";
		  echo "</tr>";
         if($_POST['dashVar'] == 2) {		  
		    echo "<tr>";	   
			     echo "<td class='normaltext'> " . $newDate . "</td>";
		  
		    echo "</tr>";
		 }
		  echo "<tr><td class='normaltext'>" . $col3 . "</td></tr></table>";
		  if($_POST['dashVar'] == 2) {
		   echo "</div></div>";
		  } 
		  echo "</a><br>";
		  	$sr++;
	}
 }						
 
 
}

$sendMessage = $_POST['sendMessage'];


if($sendMessage != '')
{
 

	
	  $stmt = $mysqli->prepare("INSERT into edu_question_portal (content,status,qp_to,qp_by,publish_date,parent_qp_id,art_id, act_id) 
	            	values(?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssss", $param_content,$param_status,$param_qp_to,$param_qp_by,$param_publish_date,$param_parent_qp_id,$param_art_id,$param_act_id);  
	  $param_content = $sendMessage;
	  $param_status = $active;	  
	  $param_qp_to = $_POST['qpBy'];
	  $param_qp_by = $_POST['userId'];
	  $param_publish_date = $todaysDate;
	  $param_parent_qp_id = $_POST['qpId'];
	  $param_art_id = $_POST['artId'];
	  $param_act_id = $_POST['actId'];
	  if($stmt->execute()){
			      $lastqp_id = $stmt->insert_id;
	  
	  $stmt = $mysqli->prepare("UPDATE edu_question_portal 
SET qp_answered = ?
WHERE id = ?");	
	  $stmt->bind_param("ss", $param_qp_answered,$param_qpid); 
	  if($_SESSION["utypeid"]== $admstdconst){   
	  $param_qp_answered = 0;
	  }else if($_SESSION["utypeid"]==$admtchconst || $_SESSION["utypeid"]== $admprogtchconst){
	  $param_qp_answered = 1; 
	  }
	  $param_qpid =$_POST['qpId'];
	  $stmt->execute();
	     
	  
	  $stmt->close();
     }
				
}

?>
