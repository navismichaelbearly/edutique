<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

$actSWperformed = !empty($_POST['actSWperformed'])?$_POST['actSWperformed']:0;	
$actperformed = !empty($_POST['actperformed'])?$_POST['actperformed']:0;
		
if($actperformed > 0 )
	
{



$stmt = $mysqli->prepare("SELECT b.school_id FROM  edu_users a inner join edu_user_school_level_class b on a.user_id  = b.user_id  WHERE a.user_id = ? and a.user_status = ?");
		/* Bind parameters */
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_id);
		$stmt->fetch();
		$stmt->close();

$stmt = $mysqli->prepare("SELECT attempt,id FROM  stu_act_performed  WHERE act_id = ? and art_id = ? and mag_id=? and user_id =? order by id DESC");
		/* Bind parameters */
		$stmt->bind_param("ssss", $param_act_id,$param_art_id,$param_mag_id,$param_user_id);
		/* Set parameters */
		$param_act_id = $_POST['act_id'];
		$param_art_id = $_POST['art_id'];
		$param_mag_id = $_POST['mag_id'];
		 $param_user_id= $_SESSION['id'];
		$stmt->execute();
		$stmt->bind_result($attempt, $idn);
		$stmt->fetch();
		$stmt->close();
		
$stmt = $mysqli->prepare("SELECT SUM(mark) as totMark FROM  mag_act_ans_detail a inner join mag_act_ans b on b.id = a.mag_act_ans_id  WHERE b.act_id = ? and b.art_id = ? and b.mag_id=? ");
		/* Bind parameters */
		$stmt->bind_param("sss", $param_act_id,$param_art_id,$param_mag_id );
		/* Set parameters */
		$param_act_id = $_POST['act_id'];
		$param_art_id = $_POST['art_id'];
		$param_mag_id = $_POST['mag_id'];
		$stmt->execute();
		$stmt->bind_result($totMark);
		$stmt->fetch();
		$stmt->close();	
     
       
		$stmt = $mysqli->prepare("SELECT a.id FROM  mag_act_ans_detail a inner join mag_act_ans b on a. mag_act_ans_id =b.id  WHERE act_id = ? and art_id = ? and mag_id=? limit 1");
		/* Bind parameters */
		$stmt->bind_param("sss", $param_act_id,$param_art_id,$param_mag_id);
		/* Set parameters */
		$param_act_id = $_POST['act_id'];
		$param_art_id = $_POST['art_id'];
		$param_mag_id = $_POST['mag_id'];
		$stmt->execute();
		$stmt->bind_result($qid);
		$stmt->fetch();
		$stmt->close();
       $stmt = $mysqli->prepare("INSERT into stu_act_performed (user_id, act_id, act_comp_status, marks_obtained, art_id, mag_id, submitted_on, attempt) 
	            	values(?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssss", $param_user_id,$param_act_id,$param_act_comp_status,$param_marks_obtained ,$param_art_id ,$param_mag_id,$param_submitted_on,$param_attempt);  
 
	  $param_user_id= $_SESSION['id'];
	  $param_act_id = $_POST['act_id'];
	  $param_act_comp_status = 'Completed';
	  $param_marks_obtained =1;
	  $param_art_id = $_POST['art_id'];
	  $param_mag_id = $_POST['mag_id'];
	  $param_submitted_on=$todaysDate;
	  $param_attempt = $attempt + 1;
	  if($stmt->execute()){
	     $lastsstu_act_performed = $stmt->insert_id;
		 for($i=1; $i<=5; $i++)
     	{
		 
		   $stmt = $mysqli->prepare("SELECT a.qans1, a.qans2 FROM  mag_act_ans_detail a inner join mag_act_ans b on a. mag_act_ans_id =b.id    WHERE b.act_id = ? and b.art_id = ? and b.mag_id=? and a.qans1=? and a.qans2=?");
			/* Bind parameters */
			$stmt->bind_param("sssss", $param_act_id,$param_art_id,$param_mag_id,$param_qans1,$param_qans2);
			/* Set parameters */
			$param_act_id = $_POST['act_id'];
			$param_art_id = $_POST['art_id'];
			$param_mag_id = $_POST['mag_id'];
			$variable111 = 'ansQ'.$i.'1';
		    $variable211 = 'ansQ'.$i.'2'; 
			 $param_qans1= $_POST[$variable111];
			 $param_qans2= $_POST[$variable211];
			$stmt->execute();
			$stmt->bind_result($qans1new, $qans2new);
			$qans1new;
			$stmt->fetch();
			 $stmt->close();
			 if($qans1new == $_POST[$variable111] && $qans2new == $_POST[$variable211] ){
			   $totalMarkscount = 1;
			 }else {
			   $totalMarkscount = 0;
			 }
	     $stmt = $mysqli->prepare("INSERT into stu_act_performed_detail (ques_id, qans1, qans2, stu_act_performed_id, is_true) 
	            	values(?,?,?,?,?)");	
		  $stmt->bind_param("sssss", $param_ques_id,$param_qans1,$param_qans2,$param_astu_act_performed_id,$param_is_true);  
	      $variable1 = 'ansQ'.$i.'1';
		  $variable2 = 'ansQ'.$i.'2';
		  
		  $param_ques_id= $qid + $i - 1;
		  $param_qans1 = $_POST[$variable111];
		  $param_qans2 = $_POST[$variable211];
		  $param_astu_act_performed_id = $lastsstu_act_performed;
		  $param_is_true = $totalMarkscount;
		  if($stmt->execute()){
		    
			 $stmt = $mysqli->prepare("UPDATE edu_user_task as UE  
			INNER JOIN edu_task As ED 
				ON UE.task_id = ED.task_id SET task_stages  = ?, completed_date=? WHERE article_id = ? and school_id = ? and assigned_to = ? and mag_id = ? and activity_id=?");	
			  $stmt->bind_param("sssssss", $param_task_stages,$param_completed_date,$param_article_id,$param_school_id,$param_assigned_to, $param_mag_id, $param_activity_id);    
			  $param_task_stages = $completed;
			  $param_completed_date = $todaysDate;
			  $param_article_id = $_POST["art_id"];
			  $param_school_id = $school_id; 
			  $param_assigned_to = $_SESSION["id"];
			  $param_mag_id = $_POST["mag_id"];
			  $param_activity_id = $_POST['act_id'];
			  $stmt->execute();
			  $stmt->close();
		    echo "<script type='text/javascript'>
                        window.location='activityFeedback.php?artID=".$_POST['art_id']."&actID=".$_POST['act_id']."&magID=".$_POST['mag_id']."';
                       </script>";
		  }
		  
		  
	   
	  }
	  
	  $stmt->close();
	}
	
			
}

if($actSWperformed > 0){
  $stmt = $mysqli->prepare("INSERT into edu_activity_result (user_id, activity_id, answer) 
	            	values(?,?,?)");	
		  $stmt->bind_param("sss", $param_user_id,$param_activity_id,$param_answer);  
	      $param_user_id = $_SESSION['id'];
		  $param_activity_id = $_POST['act_id'];
		  
		  $param_answer= $_POST['situationalWrite'];
		  if($stmt->execute()){}
		  $stmt->close();
}
?>