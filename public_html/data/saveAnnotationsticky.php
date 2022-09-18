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
include '../inc/functions.php';

/* posted variables from Ajax call */
$anno_sticky = $_POST['anno_sticky'];
$art_id = $_POST['art_id'];
$act_id = $_POST['act_id'];
$sticky_id = $_POST['sticky_id'];
$sticky_id_view = $_POST['sticky_id_view'];
$annoColor = $_POST['annoColor'];
$mag_id = $_POST['mag_id'];
if($anno_sticky != '')
{
 

	
	  $stmt = $mysqli->prepare("INSERT into edu_annotation_sticky (sticky,status,anno_by,published_date,art_id, act_id,sticky_color,mag_id) 
	            	values(?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssss", $param_comments,$param_status,$param_anno_by,$param_published_date,$param_art_id,$param_act_id,$param_sticky_color,$param_mag_id);  
	  $param_comments = $anno_sticky;	
	  $param_status = $active;	  
	  $param_anno_by = $_SESSION['id'];
	  $param_published_date = $todaysDate;
	  $param_art_id = $art_id;
	  $param_act_id = $act_id;
	  $param_mag_id = $mag_id;
	  $param_sticky_color = $annoColor;
	  $stmt->execute();
	  $stmt->close();
 
				
}
else{
     if ($stmt = $mysqli->prepare("SELECT sticky,id,sticky_color,published_date from edu_annotation_sticky where status=? and anno_by= ? and art_id=? and act_id=? and mag_id=?")) {
		
	        $stmt->bind_param("sssss", $param_status, $param_anno_by, $param_art_id, $param_act_id,$param_mag_id);
		    // Set parameters 
	        $param_status = $active;
	        $param_anno_by = $_SESSION['id'];
			$param_art_id = $art_id;
	        $param_act_id =$act_id;
			$param_mag_id = $mag_id;
	        $stmt->execute();
		    /* bind variables to prepared statement */
	        $stmt->bind_result($sticky,$id,$sticky_color,$published_date);
	        $sr =1;
			$stmt->store_result();
			if($stmt->num_rows != 0){
                    echo "<span class='pageTitlenew'>Sticky Notes</span>";
                }
	 
	        while ($stmt->fetch()) {
			    $newDate = date("d M Y H:i A", strtotime($published_date));	
				/* echo "<div class='sticky-container' 'background-color:".$sticky_color."'>
					  <div class='sticky-outer'>
						<div class='sticky'>
						  <svg width='0' height='0'>
							<defs>
							  <clipPath id='stickyClip' clipPathUnits='objectBoundingBox'>
								<path
								  d='M 0 0 Q 0 0.69, 0.03 0.96 0.03 0.96, 1 0.96 Q 0.96 0.69, 0.96 0 0.96 0, 0 0'
								  stroke-linejoin='round'
								  stroke-linecap='square'
								/>
							  </clipPath>
							</defs>
						  </svg><div style='vertical-align:top;' align='right'><button type='button' class='close'  style='color:#000000' id='stickyDel' data-id='" . $id . "'>&times;</button></div><br>
						  <div class='sticky-content' style='background-color:".$sticky_color."'>
						    
							".$sticky."
						  </div>
						</div>
					  </div>
					</div>";*/
					 echo "
						  <div class='sticky-content' style='background-color:".$sticky_color."' title='".$newDate."'>
						    <div style='vertical-align:top;' align='right'><button type='button' class='close'  style='color:#000000' id='stickyDel' data-id='" . $id . "'>&times;</button></div><br>
							".$sticky."
						  </div>
						";
		
		
		        $sr++;
	        }
        	
	    }
}

if($sticky_id != '')
{
 	
$stmt = $mysqli->prepare("delete FROM edu_annotation_sticky where id=?");
$stmt->bind_param("s", $param_sticky_id);
$param_sticky_id = $sticky_id;
$stmt->execute();
$stmt->close();				
}

/*if($com_id_view != '')
{
 	
$stmt = $mysqli->prepare("SELECT comments FROM  edu_annotation_comments  WHERE id = ?");

$stmt->bind_param("s", $param_com_id);
$param_com_id = $com_id_view;
$stmt->execute();
$stmt->bind_result($comments);
$stmt->fetch();
echo $comments;
$stmt->close();				
}*/

?>
