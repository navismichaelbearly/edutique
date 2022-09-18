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

if($_POST['vAttemptsmarks'] != '')
{
/*if($_POST['mesageVal'] == 'All'){ 
    $mesageVal = '';
	$searchVar ='';
 }else {
    $mesageVal = $_POST['mesageVal'];
	$searchVar = " AND a.message_status=?";
 }*/
 
 $stmt = $mysqli->prepare("SELECT SUM(mark) as totMarkall, COUNT(mark) as markcounts FROM  mag_act_ans_detail a inner join mag_act_ans b on b.id = a.mag_act_ans_id");
		/* Bind parameters */
		//$stmt->bind_param("sss", $param_act_id,$param_art_id,$param_mag_id );
		/* Set parameters */
		$stmt->execute();
		$stmt->bind_result($totMarkall,$markcounts);
		$stmt->fetch();
		
		$stmt->close();
		

 if ($stmt = $mysqli->prepare("SELECT a.activity_title, b.attempt, b.submitted_on, b.id,b.act_id,b.art_id,b.mag_id, SUM(c.is_true) as totmark FROM edu_activity a inner join stu_act_performed b on a.activity_id = b.act_id and a.mag_id=b.mag_id and a.article_id=b.art_id inner join stu_act_performed_detail c on b.id = c.stu_act_performed_id WHERE  b.user_id=? and b.mag_id=? and b.art_id=? and b.act_id=? and b.id=? group by c.stu_act_performed_id")) {
     
	 
	  $stmt->bind_param("sssss", $param_user_id,$param_act_id,$param_art_id,$param_mag_id,$param_attempt_id);
	  $param_act_id = $_POST['act_id'];
		$param_art_id = $_POST['art_id'];
		$param_mag_id = $_POST['mag_id'];
		$param_attempt_id = $_POST['attmt_id'];
		/* Set parameters */
		
	  $param_user_id= $_SESSION['id'];
      
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_title,$attempt,$submitted_on,$Id,$act_id,$art_id,$mag_id, $totmark);
	 $sr =1;
	 
	 
                                            
	 /* fetch values */
	 while ($stmt->fetch()) {
	      $count1 = $totmark / $totMarkall;
			 $count2 = $count1 * 100;
			 $count = number_format($count2, 0);
	      
		  $submitted_on = date("d M Y", strtotime($submitted_on));
		  
		  
		       echo "<div style='color:#3f3a60; font-size:30px; margin-bottom:10px;'> ".$count."%</div>";	   
			  
			   echo "<div>You got ".$totmark." out of " . $markcounts . " questions correct</div>";
		 if($totmark !=$markcounts){
	          echo "<div>(Try again?)</div>";
		 }	  
		    
					$sr++;
	}
	
	
 }						
 
}


?>
