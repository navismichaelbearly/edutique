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

$number = count($_POST["addRows"]);

/* posted variables from Ajax call */
$schoolId = $_POST['schoolId'];
$addressId = $_POST['addressId'];
$postalCodeid = $_POST['postalCodeid'];
$countryId = $_POST['countryId'];
$levelId = $_POST['levelId'];
$classId = $_POST['classId'];
$teacherId = $_POST['teacherId'];
$inchargetrId = $_POST['inchargetrId'];
$teacher_email = $_POST['email_Ic'];
$incharge_email = $_POST['email_el'];
$issueId = $_POST['issueId'];
$articleId = $_POST['articleId'];
$skillId = $_POST['skillId'];
$enddate = $_POST['enddate'];


/* Query to fetch the user details. Inner Join query on tables edu_utype and edu_users */
					     $stmt = $mysqli->prepare("SELECT a.user_type FROM edu_utype a inner join edu_users b WHERE a.user_type_id=b.user_type_id and b.user_id = ? and b.user_status = ?");
						 /* Bind parameters */
						 $stmt->bind_param("ss", $param_utypeid,$param_ustatus);
						/* Set parameters */
						$param_utypeid = $_SESSION["id"];
						$param_ustatus = $active;
						$stmt->execute();
						$stmt->bind_result($col1);
						$stmt->fetch();
						$stmt->close();
						
						
						
$number = count($_POST["name"]);

for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["name"][$i] != ''))
		{
		   
			$stmt = $mysqli->prepare("INSERT into edu_manual_user_temp (name,country_id ,school_id,address,postal_code,level_id,class_id,issue_id,issue_no,article_type_id,article_no ,activity_type_id,activity_no,class_teacher,cl_email, program_incharge,pi_email,start_date,end_date) 
	            	values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("sssssssssssssssssss", $param_name,$param_country_id ,$param_school_id,$param_address,$param_postal_code,$param_level_id,$param_class_id,$param_issue_id,$param_issue_no,$param_article_type_id,$param_article_no,$param_activity_type_id,$param_activity_no,$param_class_teacher,$param_cl_email, $param_program_incharge,$param_pi_email,$param_start_date,$param_end_date);  
	  $param_name = $_POST["name"][$i];
	  $param_country_id= $_POST["countryNamehidden"];
	  $param_school_id= $_POST["schoolName"];
	  $param_address= $_POST["address"];
	  $param_postal_code= $_POST["postalcode"];
	  $param_level_id= $_POST["levelId"];
	  $param_class_id= $_POST["classId"];
	  $param_issue_id= $_POST["issueId"];
	  $param_issue_no= $_POST["issueno"];
	  $param_article_type_id= $_POST["article_id"];
	  $param_article_no= $_POST["article_no"];
	  $param_activity_type_id= $_POST["activity_id"];
	  $param_activity_no= $_POST["activity_no"];
	  $param_class_teacher= $_POST["teacher_Ic"];
	  $param_cl_email= $_POST["email_Ic"];
	   $param_program_incharge= $_POST["el_Teacher"];
	   $param_pi_email= $_POST["email_el"];
	   $param_start_date= $_POST["startdate"];
	   $param_end_date= $_POST["enddate"];
	  $stmt->execute();
	  $stmt->close();
		}
	}						
						
						

/*if($schoolId != '')
{
 
$stmt = $mysqli->prepare("INSERT into edu_users (user_type_id,user_email,username,user_password,first_name,last_name,user_status,user_created_by,user_created_date,user_image_path,user_modified_by,user_modified_date,first_time_password_change,tooltip) 
	            	values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssssssssss",$param_user_type_id,$param_user_email,$param_username,$param_user_password,$param_first_name,$param_last_name,$param_user_status,$param_user_created_by,$param_user_created_date,$param_user_image_path,$param_user_modified_by,$param_user_modified_date,$param_first_time_password_change,$param_tooltip); 
	  $param_user_type_id= 2;
	  $param_user_email =  $_POST['teacher_email'];
	  $param_username = "niyati";
	  $new_password = "Test@12345";
	  $param_user_password = password_hash($new_password, PASSWORD_DEFAULT);
	  $param_first_name = "nihar";
	  $param_last_name = "ferns";
	  $param_user_status  = $active;
	  $param_user_created_by = $admintitle;
	  $param_user_created_date = $todaysDate;
	  $param_user_image_path = "";
	  $param_user_modified_by = "";
	  $param_user_modified_date = "";
	  $param_first_time_password_change = 0;
	  $param_tooltip = 0;
	  $stmt->execute();
	 for($i=0; $i<$number; $i++)
	 {
		 
		 
		$stmt = $mysqli->prepare("INSERT into edu_school (school_name,country_id,school_address,school_created_date,school_status,postal_code,school_created_by) 
	            	values(?,?,?,?,?,?,?)");	
	  $stmt->bind_param("sssssss", $param_school_name,$param_country_id,$param_school_address,$param_school_created_date,$param_school_status,$param_postal_code,$school_created_by);  
	  $param_school_name = $schoolId;	  
	  $$param_school_address = $addressId;
	  $param_postal_code = $postalCodeid;
	  $param_country_id = $countryId;
	  $param_school_created_date = $todaysDate;
	  $param_school_status = $active;
	  $school_created_by = $col1;
	  $stmt->execute();
	  $lastschool_id = $stmt->insert_id;
	  $stmt->close();
	  
	  $stmt = $mysqli->prepare("INSERT into edu_levels (level,level_status,school_id) 
	            	values(?,?,?)");	
	  $stmt->bind_param("sss",$param_level,$param_level_status,$param_school_id); 
	  $param_level = 7;	  
	  $param_level_status = "active";
	  $param_school_id = 1;
	  $stmt->execute();
	  $lastlevel_id = $stmt->insert_id;
	  $stmt->close()
	  
	  
	  
	   $stmt = $mysqli->prepare("INSERT into edu_class (class_name,school_id,level_id,class_status) 
	            	values(?,?,?,?)");	
	  $stmt->bind_param("ssss", $param_class_name,$param_school_id,$param_level_id,$param_class_status); 
	  $param_class_name = 1;
	  $param_school_id = 2;  
	  $param_level_id =  3;	
	  $param_class_status = "active";
	  $stmt->execute();
	  $stmt->close();
   
	  }
	  
	  $stmt = $mysqli->prepare("INSERT into edu_subscription_info (user_school_lvl_class_id,school_subscription_id,usr_sch_cls_sch_subs_status ) 
	            	values(?,?,?)");	
	  $stmt->bind_param("sss" ,$param_user_school_lvl_class_id,$param_school_subscription_id,$param_usr_sch_cls_sch_subs_status); 
	  $param_user_school_lvl_class_id =1; 
	  $param_school_subscription_id =  	2;
	  $param_usr_sch_cls_sch_subs_status = "active";
	  $stmt->execute();
	  $lastsubscription_info_id = $stmt->insert_id;
	  $stmt->close();
	  }
	  
	   $stmt = $mysqli->prepare("INSERT into edu_subscription_info (user_school_lvl_class_id,school_subscription_id,usr_sch_cls_sch_subs_status ) 
	            	values(?,?,?)");	
	  $stmt->bind_param("sss" ,$param_user_school_lvl_class_id,$param_school_subscription_id,$param_usr_sch_cls_sch_subs_status); 
	  $param_user_school_lvl_class_id =1; 
	  $param_school_subscription_id =  	2;
	  $param_usr_sch_cls_sch_subs_status = "active";
	  $stmt->execute();
	  $lastsubscription_info_id = $stmt->insert_id;
	  $stmt->close();
	  }
	  
	  
	   $stmt = $mysqli->prepare("INSERT into edu_school_subscription(mag_id,article_id,activity_id,school_id,school_subscription_status,subscription_start_date,subscription_end_date ) 
	            	values(?,?,?,?,?,?,?)");	
	  $stmt->bind_param("sssssss", $param_mag_id,$param_article_id,$param_activity_id,$param_school_id,$param_school_subscription_status,$param_subscription_start_date,$param_subscription_end_date); 
	  $param_mag_id =3;
	  $param_activity_id = 2;
	  $param_artcile_id =  1;	
	  $param_school_id = 1;
	  $param_school_subscription_status = $active;
	  $param_subscription_start_date = $todaysDate;
	  $param_subscription_end_date = "";
	  $lastschool_subscription_id = $stmt->insert_id;
	  $stmt->execute();
	  $stmt->close();
	  }
	  
	  $stmt = $mysqli->prepare("INSERT into edu_user_school_level_class(user_id,school_id,class_id,level_id ) 
	            	values(?,?,?,?)");	
	  $stmt->bind_param("ssss", $param_user_id,$param_school_id,$param_class_id,$param_level_id); 
	  $param_user_id = 1;
	  $param_school_id =2 ;
	  $param_class_id =   3;	
	  $param_level_id = 4;	
	  $stmt->execute();
	  $lastuser_school_level_class_id = $stmt->insert_id;
	  $stmt->close();
	  }
	  
	  
	  
	  
	  $stmt->close();

	   }
	  
	  
	  
	  
	
	
	  
	   
	  
}
 */
    //echo "Data Inserted"; 


?>
