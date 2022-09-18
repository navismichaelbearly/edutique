<?php
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
$reviewLog = !empty($_POST['reviewLog'])?$_POST['reviewLog']:0;
$rev_id = !empty($_POST['rev_id'])?$_POST['rev_id']:0;

   if($reviewLog > 0)
	{
			
			
			/*if ($stmt = $mysqli->prepare("SELECT b.article_title, a.ques, count(review_id) as review, a.mag_id, a.art_id,a.act_id FROM edu_review a inner join edu_article b on a.art_id=b.article_id GROUP BY a.ques")) {*/    
			 if ($stmt = $mysqli->prepare("SELECT review_id,b.first_name, b.last_name, b.user_type_id, a.user_rating, user_review, a.mag_id, a.art_id,a.act_id, a.status FROM edu_review a inner join edu_users b on a.user_id=b.user_id")) {
			  
			 //$stmt->bind_param("s", $param_teach_id);
			// $param_teach_id = $_SESSION['id'];	
			 
			 $stmt->execute();
			 $result = $stmt->get_result();
			 /* bind variables to prepared statement */
			// $stmt->bind_result($first_name,$last_name, $user_type_id, $user_rating, $user_review, $mag_id, $art_id, $act_id, $status);
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th>
													    <th>No.</th>
														<th>User</th>
														<th>Article</th>
														<th>Review</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			 while ($row = $result->fetch_assoc()) {
			      $stmt2 = $mysqli->prepare("Select user_type from edu_utype  where user_type_id=?");					
						$stmt2->bind_param("s", $param_user_type_id);
					    $param_user_type_id = $row['user_type_id'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
						$stmt3 = $mysqli->prepare("Select article_title from edu_article  where article_id=?");					
						$stmt3->bind_param("s", $param_article_id);
					    $param_article_id = $row['art_id'];
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();
				  echo "<tr>";
				if($_SESSION["utypeid"]==$admconst){
				  $magLink = "article-detail-admin.php?artID=".$row['art_id']."&actID=".$row['act_id']."&magID=".$row['mag_id'];
				}else{
				  $magLink = "acticle-detail.php?artID=".$row['art_id']."&actID=".$row['act_id']."&magID=".$row['mag_id'];
				 }
				// $refLoglink = "reflection-logdetail.php?artID=".$art_id."&actID=".$act_id."&magID=".$mag_id;
				  
					   
					  // echo "<td class='normaltext'><a href='".$magLink."'>" . $activity_title . "</a></td>";
					  echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $row['review_id'] . "'></td>";
					  echo "<td class='normaltext'>" .$sr."</td>";
					   echo "<td class='normaltext'>" . $row['last_name'] ." ". $row['first_name']." (".$row2['user_type'].")</td>";
					   echo "<td class='normaltext'><a href='".$magLink."'>" . $row3['article_title'] ."</a></td>";
					    echo "<td class='normaltext'>" . $row['user_review'] ."</td>";
				      echo "<td class='normaltext'>
					        <select name='rstatus'  id='rstatus' data-id='" . $row['review_id'] . "' >
					        <option   value='Active' ".(($row['status']=='Active')?'selected="selected"':"").">Active</option>
							<option   value='Inactive' ".(($row['status']=='Inactive')?'selected="selected"':"")." >Inactive</option>
					       </select></td>";
					  
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	 
	}
	
	if($rev_id > 0)
	{
	  $stmt = $mysqli->prepare("UPDATE edu_review SET status = ? WHERE review_id = ?");	
	  $stmt->bind_param("ss", $param_status,$param_review_id);    
	  $param_status = $_POST["revStatus"];
	  $param_review_id =$rev_id;
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
	}
	
	

?>
