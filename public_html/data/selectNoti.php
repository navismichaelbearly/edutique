
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
 if($_SESSION["utypeid"]==$admtchconst || $_SESSION["utypeid"]== $admprogtchconst  || $_SESSION["utypeid"]== $admconst){
   $uid ='user_id';
   $var = 'GROUP BY noti_title';
   
   
 }else{
   $uid ='user_id';
   $var = '';
 } 
 if ($stmt = $mysqli->prepare("SELECT noti_title,noti_published_date,noti_content,noti_id,article_id,activity_id,mag_id,added_by FROM edu_noti where noti_status=? and ".$uid."=? ".$var." limit ?,?")) {
    
       $stmt->bind_param("ssss", $param_status, $param_user_id, $param_calPage, $param_totPages);
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_POST['userId'];
	 $param_totPages = $_POST['totPages'];
	 $param_calPage = $_POST['calPage'];
    
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($col1, $col2,$col3, $noti_id, $article_id,$activity_id,$mag_id, $added_by);
	 $sr =1;
	 /* fetch values */
	 while ($stmt->fetch()) {
	      $ntitle = stripslashes($col1);
		 	 if($_SESSION["utypeid"]==$admtchconst || $_SESSION["utypeid"]== $admprogtchconst){
			   
			   $linkannounce = "marking.php?noti_id=".$noti_id."&article_id=".$article_id."&activity_id=".$activity_id."&mag_id=".$mag_id."&addedBy=".$added_by;
			   
			 }
		  $newDate = date("d M Y", strtotime($col2));	
		   //$stringContent = mb_strimwidth($col3, 0, 150, '...');
		   //$pos=strpos($col3, ' ', 150);
		   //$stringContent=substr($col3,0,$pos );
		   $stringContent = strlen($col3) > 50 ? substr($col3,0,150)."..." : $col3;	
	      echo "<table class='tablebod'><tr>";
		       echo "<td> <span class='normaltext'><a class='normaltext' href='".$linkannounce."'>" . stripslashes($col1) . "</a></span></td>";
		  echo "</tr>";	   
		  echo "<tr>";	   
			   echo "<td class='normaltext'> " . $newDate . "</td>";
		  
		  echo "</tr>";
		  echo "</table><br>";
					$sr++;
	}
 }						
 
}
?>
