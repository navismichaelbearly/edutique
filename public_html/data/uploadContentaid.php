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
if(isset($_POST['ca_title'])){
   $uploadDir = '../contentaid';
   $uploadStatus = 1; 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["file"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["file"]["name"]); 
                $targetFilePath = $uploadDir .'/'. $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
               // $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
              //  if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = 'contentaid/' . $fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
               // }else{ 
                   // $uploadStatus = 0; 
                   // $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
               // } 
            }
			
		   if($uploadStatus == 1){ 
		      $stmt = $mysqli->prepare("INSERT into edu_aid (mag_id,act_id,art_id,content_aid_title,supplementary_aid,uploadded_date, uploaded_by,content_aid_file_path,status,embedvideo) 
						values(?,?,?,?,?,?,?,?,?,?)");	
		              $stmt->bind_param("ssssssssss", $param_mag_id,$param_act_id,$param_art_id,$param_content_aid,$param_supplementary_aid,$param_uploaded_date,$param_uploaded_by,$param_file_path, $param_status,$param_embedvideo);  
					  $param_mag_id = $_POST['mag_id'];
					  $param_act_id = $_POST['act_id'];
					  $param_art_id = $_POST['art_id'];
					  $param_content_aid = $_POST['ca_title'];
					  $param_supplementary_aid = '';
					  $param_uploaded_date =$todaysDate;
		              $param_file_path =$uploadedFile;
					  $param_uploaded_by =$_SESSION["id"];
					  $param_status =$active;
					  $param_embedvideo =$_POST['ca_youtube'];
					  $stmt->execute();
					  $stmt->close();
		   }	  
	
}   
?>		 