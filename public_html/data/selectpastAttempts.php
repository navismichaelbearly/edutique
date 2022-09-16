
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

if($_POST['pAttempts'] != '')
{
/*if($_POST['mesageVal'] == 'All'){ 
    $mesageVal = '';
	$searchVar ='';
 }else {
    $mesageVal = $_POST['mesageVal'];
	$searchVar = " AND a.message_status=?";
 }*/
 
 $stmt = $mysqli->prepare("SELECT SUM(mark) as totMarkall FROM  mag_act_ans_detail a inner join mag_act_ans b on b.id = a.mag_act_ans_id");
		/* Bind parameters */
		//$stmt->bind_param("sss", $param_act_id,$param_art_id,$param_mag_id );
		/* Set parameters */
		$stmt->execute();
		$stmt->bind_result($totMarkall);
		$stmt->fetch();
		
		$stmt->close();
		

 if ($stmt = $mysqli->prepare("SELECT a.activity_title, b.attempt, b.submitted_on, b.id,b.act_id,b.art_id,b.mag_id, SUM(c.is_true) as totmark FROM edu_activity a inner join stu_act_performed b on a.activity_id = b.act_id and a.mag_id=b.mag_id and a.article_id=b.art_id inner join stu_act_performed_detail c on b.id = c.stu_act_performed_id WHERE  b.user_id=? group by c.stu_act_performed_id")) {
     
	 
	  $stmt->bind_param("s", $param_user_id);
		/* Set parameters */
		
	  $param_user_id= $_SESSION['id'];
      
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_title,$attempt,$submitted_on,$Id,$act_id,$art_id,$mag_id, $totmark);
	 $sr =1;
	 
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Download</th>
                                                <th>Attempt No.</th>
                                                <th>Score</th>
                                                <th>View Attempt</th>
												<th>Completed Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                                            
	 /* fetch values */
	 while ($stmt->fetch()) {
	      $count1 = $totmark / $totMarkall;
			 $count2 = $count1 * 100;
			 $count = number_format($count2, 0);
	      echo "<tr>";
		  $submitted_on = date("d M Y", strtotime($submitted_on));
		  
		  if($Id == 0) {$Id="";
		  
		  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
		  }	else {
		       echo "<td> " . $activity_title . "</span></td>";	   
			   echo "<td class='normaltext'><i class='material-icons-outlined md-16 annocom' id=''>download</i></td>";
			   echo "<td class='normaltext'>" . $attempt . "</td>";
		       echo "<td class='normaltext'>".$count."%</td>";
			   echo "<td class='normaltext'><input type='button' id='viewAttemp'  value='View Attempt' class='btn btn-default btn-xs' style='padding:5px 20px; ' data-id='" . $Id ."_".$act_id."_".$art_id."_".$mag_id. "'></td>";
			   echo "<td class='normaltext'>" . $submitted_on . "</td>";
		  }	
	      
		     echo "</tr>" ;
					$sr++;
	}
	
	echo "
                                        </tbody>    
                                      </table>";
 }						
 
}


?>
