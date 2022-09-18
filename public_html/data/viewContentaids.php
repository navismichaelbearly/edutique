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
$aidsLog = !empty($_POST['aidsLog'])?$_POST['aidsLog']:0;
$caID = !empty($_POST['caID'])?$_POST['caID']:0;
$extVal = !empty($_POST['extVal'])?$_POST['extVal']:'';


   if($aidsLog == 1)
	{
			
			
			if ($stmt = $mysqli->prepare("SELECT content_aid_title,content_aid_file_path,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_article c on a.art_id=c.article_id and a.mag_id=c.mag_id   where status=? and uploaded_by !=? and act_id =? and a.art_id=? and a.mag_id=?")) {    
			 
			  
			 $stmt->bind_param("sssss", $param_noti_status, $param_added_by, $param_act_id, $param_art_id, $param_mag_id);
			 $param_noti_status = $active;	
			 $param_added_by = 1;
			 $param_act_id = 0;
			 $param_art_id = $_POST['art_id'];	
			 $param_mag_id = $_POST['mag_id'];
			 $stmt->execute();
			 /* bind variables to prepared statement */
			 $stmt->bind_result($content_aid_title,$content_aid_file_path, $embedvideo, $caID );
			 $sr =1;
			 echo "<br><div class='pageTitlenew'>Content Aid</div>";
													
			 /* fetch values */
			 while ($stmt->fetch()) { 
			      
			  
			  if($content_aid_file_path !="" || $embedvideo !=""){
			    $ext = pathinfo($content_aid_file_path, PATHINFO_EXTENSION);
			    if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'xls' || $ext == 'xlsx'){
				   $cap="<a href='".$content_aid_file_path."' target='_blank'>".$content_aid_title."</a>";
				}else if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mpeg' || $ext == 'mp3' || $ext == 'mpeg'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mov' || $ext == 'mp4'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($embedvideo !=""){ 
				   $ext ="";
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}
			  }
				  echo "<div>";
					    echo $cap;
				 
					 echo "</div>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	 
	}
	
	
	if($caID > 0){
	   $stmt = $mysqli->prepare("Select content_aid_file_path,embedvideo from edu_aid where id=?");
			/* Bind parameters */
			$stmt->bind_param("s", $param_ca_id);
			/* Set parameters */
			$param_ca_id = $caID;
			$stmt->execute();
			$stmt->bind_result($content_aid_file_path,$embedvideo);
			$stmt->fetch();
			$stmt->close();
	   if($extVal == 'jpg' || $extVal == 'jpeg' || $extVal == 'png'){
	      
	      echo "<img src='".$content_aid_file_path."' width='100%' height='100%'>";
	   }else if($extVal == 'mpeg' || $extVal == 'mp3' || $extVal == 'mpeg'){
	      echo "<div style='background:#FFFFFF; padding:10px' id='rLoud1'>
                            
                            <audio  preload='auto' controls style='width: 100%;'>
	                             <source src='".$content_aid_file_path."' type='audio/mpeg'>
	                        </audio>
                            </div>";
	   }else if($extVal == 'mov' || $extVal == 'mp4' ){
	      echo "<div style='background:#FFFFFF; padding:10px' id='rLoud1'>
                            
                           <video style='width: 100%;' controls>
							  <source src='".$content_aid_file_path."' type='video/mp4'>
							  <source src='".$content_aid_file_path."' type='video/mov'>
							  Your browser does not support HTML video.
							</video>
                            </div>";
	   }
	
	}



?>
