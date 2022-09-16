
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
$messageinfo = !empty($_POST['messageinfo'])?$_POST['messageinfo']:0;


if($messageinfo == 1){
if ($stmt = $mysqli->prepare("SELECT a.id,a.message_title,a.message_content,a.publish_date, a.message_status, a.date_resolved, b.first_name, b.last_name,b.user_id FROM edu_messages a INNER JOIN edu_users b on a.from_id=b.user_id WHERE a.status=? AND a.message_type=? AND  parent_msg_id=? order by a.id DESC limit 2")) {
    
      $stmt->bind_param("sss", $param_status,$param_message_type,$param_parent_msg_id);
		   $param_status = $active;
		   $param_message_type  = $nontech;
		   $param_parent_msg_id = 0;
    
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($refId, $message_title,$message_content,$pubDate,$mesStatus,$dateResolved,$firstName,$lastName,$user_id);
	 $sr =1;
	 /* fetch values */
	 while ($stmt->fetch()) {
	      
		  $userName = $lastName ." ".$firstName;
		  
	      $ntitle = stripslashes($message_title);
		 	 	
	      echo "<a href='messagedetail.php?ref=".$refId."' style='text-decoration:none'><table class='tablebod'><tr>";
		       echo "<td> <span class='normaltext'>" . $userName. "</span></td>";
		  echo "</tr>";	   
		  
		  echo "<tr><td class='normaltext'>" . stripslashes($message_title) . "</td></tr></table></a><br>";
					$sr++;
	}
 }
} 

/*if($_POST['techsuplog'] == 'techsuplog')
{
if($_POST['mesageVal'] == 'All'){ 
    $mesageVal = '';
	$searchVar ='';
 }else {
    $mesageVal = $_POST['mesageVal'];
	$searchVar = " AND a.message_status=?";
 }

 if ($stmt = $mysqli->prepare("SELECT a.id,a.message_title,a.publish_date, a.message_status, a.date_resolved, b.first_name, b.last_name FROM edu_messages a INNER JOIN edu_users b on a.from_id=b.user_id WHERE a.status=? AND a.message_type=?".$searchVar)) {
     
	  if($_POST['mesageVal'] == 'All'){ 
			$stmt->bind_param("ss", $param_status,$param_message_type);
	  }else {
			$stmt->bind_param("sss", $param_status,$param_message_type,$param_message_status);
			$param_message_status  = $_POST['mesageVal'];
	  }
	  
		   $param_status = $active;
		   $param_message_type  = $tech;
    
	 
	 $stmt->execute();
	 
	 $stmt->bind_result($refId, $message_title,$pubDate,$mesStatus,$dateResolved,$firstName,$lastName);
	 $sr =1;
	 echo "<table id='example1' class='table table-striped table-bordered' style='width:100%'>
                                        <thead>
                                            <tr>
                                                <th>Ref No.</th>
                                                <th>Sent By</th>
                                                <th>Message Title</th>
                                                <th>Date Sent</th>
                                                <th>Resolved</th>
												<th>Date Resolved</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<tr>";
                                            
	
	 while ($stmt->fetch()) {
	      
		  if($pubDate !=""){	
		     $newDate = date("d M Y", strtotime($pubDate));
		  }else {
		  	 $newDate="";
	      }
		  if($dateResolved !=""){	
		     $newDate1 = date("d M Y", strtotime($dateResolved));
		  }else {
		  	 $newDate1="";
	      }
		  if($mesStatus==$unresolved){
		     $checkbox= "";
			 $disabled ="";
		  } else {
		     $checkbox= "checked";
			 $disabled ="disabled";
		  }
		  if($refId == 0) {$refId="";
		  
		  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
		  }	else {
		       echo "<td> <span class='normaltext'><a href='messagedetail.php?ref=".$refId."' class='greytext-deco'>" . $refId . "</a></span></td>";	   
			   echo "<td class='normaltext'> <a href='messagedetail.php?ref=".$refId."' class='greytext-deco'>" . $lastName . " " . $firstName."</a></td>";
			   echo "<td class='normaltext'><a href='messagedetail.php?ref=".$refId."' class='greytext-deco'> " . $message_title . "</a></td>";
		       echo "<td class='normaltext'><a href='messagedetail.php?ref=".$refId."' class='greytext-deco'>" . $newDate . "</a></td>";
			    echo "<td class='normaltext'><input type='checkbox' id='techStatuschange' ".$checkbox." ".$disabled."  ></td>";
			   echo "<td class='normaltext'>" . $newDate1 . "</td>";
		  }	
	      
		      
					$sr++;
	}
	
	echo "</tr>
                                        </tbody>    
                                      </table>";
 }						
 
}*/
?>
