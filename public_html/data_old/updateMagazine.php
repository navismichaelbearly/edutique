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

// If form is submitted 
if(isset($_POST['mag_type']) || isset($_POST['issue_no']) || isset($_POST['mag_theme']) || isset($_POST['pub_date']) )
{ 
    // Get the submitted form data 
    $mag_type = $_POST['mag_type']; 
    $issue_no = $_POST['issue_no']; 
	$mag_theme = $_POST['mag_theme']; 
	$pub_date = $_POST['pub_date']; 
	$content = $_POST['content'];
	$newDate = date("Y-m-d", strtotime($pub_date));	
	if (!file_exists('../magazine/'.$mag_type.'/'.$issue_no)) {
    mkdir('../magazine/'.$mag_type.'/'.$issue_no, 0777, true);
	$uploadDir = '../magazine/'.$mag_type.'/'.$issue_no.'/'; 
    }else{
	 $uploadDir = '../magazine/'.$mag_type.'/'.$issue_no.'/';
	}
    
    // Check whether submitted data is not empty 
    if(!empty($mag_theme) )
	{ 
	   $stmt = $mysqli->prepare("Select mag_type_id from edu_mag_type where mag_type=?");
		/* Bind parameters */
		$stmt->bind_param("s", $param_mag_type);
		/* Set parameters */
		$param_mag_type = $mag_type;
		$stmt->execute();
		$stmt->bind_result($mag_type_idnew);
		$stmt->fetch();
		$stmt->close();
		echo $mag_type_idnew;
        $stmt = $mysqli->prepare("Select mag_id from edu_magazine where mag_type_id=? and mag_status=? and mag_issue=?");
		/* Bind parameters */
		$stmt->bind_param("sss", $param_mag_type_id,$param_mag_status,$param_mag_issue);
		/* Set parameters */
		$param_mag_type_id = $mag_type_idnew;
		$param_mag_status = $active;
		$param_mag_issue = $issue_no;
		$stmt->execute();
		$stmt->bind_result($mag_id);
		$stmt->fetch();
		$stmt->close();
		
		echo $mag_id;
		
		/*if($mag_id !='')
		{
		  
		}else{ */ 
		     $varMagid = $mag_type_idnew;
				 if($mag_type_idnew ==''){
				   $stmt = $mysqli->prepare("INSERT into edu_mag_type (mag_type,mag_type_status) 
								values(?,?)");
					$stmt->bind_param("ss", $param_mag_type, $param_mag_type_status);
					$param_mag_type = $mag_type;
					$param_mag_type_status =$active;
					$stmt->execute();
					$lastmag_id = $stmt->insert_id; 
					$varMagid = $lastmag_id;
				}
		
			   $uploadStatus = 1; 
					 
					// Upload file 
					$uploadedFile = ''; 
					if(!empty($_FILES["file"]["name"])){ 
						 
						// File path config 
						$fileName = basename($_FILES["file"]["name"]); 
						$targetFilePath = $uploadDir . $fileName; 
						$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
						 
						// Allow certain file formats 
						$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
						if(in_array($fileType, $allowTypes)){ 
							// Upload file to the server 
							if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
								$uploadedFile = 'magazine/'.$mag_type.'/'.$issue_no.'/' . $fileName; 
							}else{ 
								$uploadStatus = 0; 
								$response['message'] = 'Sorry, there was an error uploading your file.'; 
							} 
						}else{ 
							$uploadStatus = 0; 
							$response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
						} 
					} 
					
					// Upload file 
					$uploadedFiletc = ''; 
					if(!empty($_FILES["filetc"]["name"])){ 
						 
						// File path config 
						$fileNametc = basename($_FILES["filetc"]["name"]); 
						$targetFilePathtc = $uploadDir . $fileNametc; 
						$fileTypetc = pathinfo($targetFilePathtc, PATHINFO_EXTENSION); 
						 
						// Allow certain file formats 
						$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
						if(in_array($fileTypetc, $allowTypes)){ 
							// Upload file to the server 
							if(move_uploaded_file($_FILES["filetc"]["tmp_name"], $targetFilePathtc)){ 
								$uploadedFiletc = 'magazine/'.$mag_type.'/'.$issue_no.'/' . $fileNametc; 
							}else{ 
								$uploadStatus = 0; 
								$response['message'] = 'Sorry, there was an error uploading your file.'; 
							} 
						}else{ 
							$uploadStatus = 0; 
							$response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
						} 
					} 
			
					if($uploadStatus == 1){ 
						// Include the database config file 
						$stmt = $mysqli->prepare("Select b.mag_type_id, a.mag_image_path,a.tc_image from edu_magazine a inner join edu_mag_type b on a.mag_type_id=b.mag_type_id where mag_id=? and mag_status=?");
						/* Bind parameters */
						$stmt->bind_param("ss", $param_mag_id, $param_mag_status);
						/* Set parameters */
						$param_mag_id = $_POST['magazineID'];	
						$param_mag_status =$active;
						$stmt->execute();
						$stmt->bind_result($mag_type_id_VAR, $mag_image_path,$tc_image);
						$stmt->fetch();
						$stmt->close();
						 $stmt = $mysqli->prepare("UPDATE edu_mag_type SET mag_type=?,mag_type_status=? where mag_type_id=?");
						$stmt->bind_param("sss", $param_mag_type, $param_mag_type_status, $param_mag_type_id);
						$param_mag_type = $mag_type;
						$param_mag_type_status =$active;
						$param_mag_type_id = $param_mag_type_id;
						$stmt->execute();
						$stmt = $mysqli->prepare("UPDATE  edu_magazine SET mag_title=?, mag_issue=?, mag_published_date=?, mag_status=?, mag_type_id=?, mag_image_path=?,tc_image=?,editors_note=? where mag_id=?");
						$stmt->bind_param("sssssssss", $param_mag_title, $param_mag_issue, $param_mag_published_date, $param_mag_status, $param_mag_type_id, $param_mag_image_path, $param_tc_image, $param_editors_note,$param_magid);
						if($uploadedFile==''){
						  $ufimg =$mag_image_path;
						}else {
						  $ufimg =$uploadedFile;
						}
						
						if($uploadedFiletc==''){
						  $ufimgtc =$tc_image;
						}else {
						  $ufimgtc =$uploadedFiletc;
						}
						$param_mag_title = $mag_theme;
						$param_mag_issue= $issue_no;
						$param_mag_published_date =$newDate;
						$param_mag_status =$active;
						$param_mag_type_id = $varMagid;
						$param_mag_image_path=$ufimg;
						$param_tc_image = $ufimgtc;
						$param_editors_note =$content;	
						$param_magid = $_POST['magazineID'];		
						  if($stmt->execute()){
						   
						  }
						  
						  $stmt->close();        
					   /* if($stmt->execute()){ 
							$response['status'] = 1; 
							$response['message'] = 'Form data submitted successfully!'; 
						}
						 $stmt->close(); */ 
					} 
                    else {
					
					
					}
		
		
		//}
		
    } 
}	  



?>