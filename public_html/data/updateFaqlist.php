
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

$number = count($_POST["questiontext"]);

for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["questiontext"][$i] != ''))
		{
			$stmt = $mysqli->prepare("UPDATE edu_faq SET title = ?, content=? WHERE faq_id = ?");	
	  $stmt->bind_param("sss", $param_title,$param_content,$param_faq_id);    
	  $param_title = $_POST["questiontext"][$i];
	  $param_content = $_POST["messagetext"][$i];
	  $param_faq_id = $_POST["faqId"][$i];
	  $stmt->execute();
	  $stmt->close();
		}
	}
//echo "Data Inserted";
?>
