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
		
if($_POST['langG'] !='' )
	
{
       
		$stmt = $mysqli->prepare("SELECT a.mark,a.question,a.suggested_ans, c.qans1, c.qans2 FROM  mag_act_ans_detail a inner join mag_act_ans b on a. mag_act_ans_id =b.id inner join stu_act_performed_detail c on c.ques_id=a.id inner join stu_act_performed d on d.id = c.stu_act_performed_id   WHERE b.act_id = ? and b.art_id = ? and b.mag_id=? and d.user_id=? GROUP by a.question order by d.attempt DESC");
		/* Bind parameters */
		$stmt->bind_param("ssss", $param_act_id,$param_art_id,$param_mag_id, $param_user_id);
		/* Set parameters */
		$param_act_id = $_POST['act_id'];
		$param_art_id = $_POST['art_id'];
		$param_mag_id = $_POST['mag_id'];
		$param_user_id= $_SESSION['id'];
		$stmt->execute();
		$stmt->bind_result($mark, $question, $suggested_ans, $qans1, $qans2);
		$sr =1;
	    
		 while ($stmt->fetch()) {
			
			 echo  "<div class='col-md-12 normaltext' style='padding-bottom:25px;'>
			        <div align='left'>".$sr.". ".$question."<span style='float:right'>[".$mark."]</span></div><br> 
					<div class='row'>
					     <div class='col-md-6'>
					        <input type='text' value='".$qans1."' readonly class='form-control'>
						</div>
						
						<div class='col-md-6'>	
						   <input type='text' value='".$qans2."' readonly class='form-control'>
					    </div>
					</div><br>
					<div>
					     <textarea readonly class='form-control' style='border:1px solid #22ba9b; color: #22ba9b; background-color: #dff3ea'>".$suggested_ans."</textarea>
					</div>
			 
			 
			       </div>";
			
			 $sr++;
		 }
		$stmt->close();
        
 
	  
				
}

if($_POST['totMarks'] !='' )
	
{
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
		echo "<div>[".$totMark." marks]</div>";
		$stmt->close();
}
?>