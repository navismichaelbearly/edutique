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
 
 if ($stmt = $mysqli->prepare("SELECT a.user_image_path, a.first_name, b.content, b.publish_date,a.last_name,c.user_type, b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id,d.article_path,d.article_title, d.article_published_date, e.mag_title, e.mag_issue,e.mag_published_date,e.mag_image_path, f.mag_type,d.article_image FROM edu_users a INNER JOIN edu_question_portal b ON a.user_id=b.qp_by inner join edu_utype c on a.user_type_id=c.user_type_id left join edu_article d on b.art_id = d.article_id left join edu_magazine e on d.mag_id=e.mag_id left join edu_mag_type f on e.mag_type_id = f.mag_type_id where b.status=? and b.qp_to=? or b.qp_by=?  and b.id=? or b.parent_qp_id=? order by b.publish_date Asc")) {
     
     $stmt->bind_param("sssss", $param_status, $param_user_id, $param_user_id2, $param_id, $param_parent_id);
    
       
	 // Set parameters 
	 $param_status = $active;
	 $param_user_id = $_POST['userId'];
	 $param_user_id2 = $_POST['userId'];
	 $param_id = $_POST['qpId'];
	 $param_parent_id = $_POST['qpId'];
    
	 
	 $stmt->execute();
	 // bind variables to prepared statement 
	 $stmt->bind_result($col1, $col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9,$col10,$col11,$col12,$col13,$col14,$col15,$col16,$col17,$col18,$col19,$col20);
	 $sr =1;
	 // fetch values 
	 while ($stmt->fetch()) {
	      
		  if($col6 == $admintitle){
		    $name = $col6;
		  }else {
		     $name = $col6. " " .$col5. " " .$col2 ;
		  }	
		  $newDate = date("d M Y H:i", strtotime($col4));
          
		  if($col6 == $admstdconst){
		    
			$profile = "<span class='user' style='background-image:url(upload/" . $col1 . "); margin:15px'></span>";
			 $mag ="<td class='normaltext'> " . $newDate . "<br>". $col3."</td>" ;
			 $div ="<div class='col-lg-3'></div>";
			 $divclass ="class='col-lg-8'";
			 $firstdiv ="<div class='col-lg-1'>".$profile."</div><div  ".$divclass.">";
			 $closediv ="";
		  }else {
		     $profile = "<span class='user' style='background-image:url(upload/" . $col1 . "); margin:15px'></span>";
			
			$mag ="<td class='normaltext' style='vertical-align:bottom !important'><div class='row'><div class='col-lg-4 normaltext' align='center'><table class='tablebod' align='center' style='width:230px; text-align:center'><tr><td><img src='".$col20."' width='200' height='265' style='border:1px solid #CCCCCC'><br><br>".$col13."<br>".$col19.$col16."</td></tr></table></div> <div class='col-lg-8' align='left' style='padding-top:265px;'><span style='float:right;'>" . $newDate . "</span><br>". $col3. "</div></div></td>" ;
			$div ="";
			$divclass ="class='col-lg-9'";
			$firstdiv ="<div class='col-lg-2'>".$profile."</div><div  ".$divclass.">";
			$closediv ="<div class='col-lg-1'></div>";
		  }	
		  if($col19=='i-Magazine') {$col19= 'i';}	  
	        echo "<div class='row'>".$firstdiv;
	    
		  echo "<table class='tablebod'>";
		       
         		  
		    echo "<tr>";	   
			     echo $mag ;
		  
		    echo "</tr>";
		
		  echo "</table>";
		  
		   echo "</div>".$div.$closediv."</div>";
		  
		  echo "<br>";
		  	$sr++;
	}
 }						
 
 
}



?>

