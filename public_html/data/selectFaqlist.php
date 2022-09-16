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


if($_POST['faqType'] != '')
{
  $stmt = $mysqli->prepare("SELECT a.title,a.content,a.faq_id, b.faq_type from edu_faq a inner join edu_faq_type b on a.faq_type=b.id where a.status=? and a.faq_type=?");
  /* Bind parameters */
   $stmt->bind_param("ss", $param_status, $param_faq_type);
  // Set parameters 
  $param_status = $active;
  $param_faq_type = $_POST['faqType'];
	 
  $stmt->execute();
  $stmt->bind_result($col11, $col12, $col13, $col14);
  $stmt->fetch();
  $stmt->close();
  if ($stmt = $mysqli->prepare("SELECT a.title,a.content,a.faq_id, b.faq_type from edu_faq a inner join edu_faq_type b on a.faq_type=b.id where a.status=? and a.faq_type=?")) {
		
	 $stmt->bind_param("ss", $param_status, $param_faq_type);
		 // Set parameters 
	 $param_status = $active;
	 $param_faq_type = $_POST['faqType'];
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($col1, $col2, $col3, $col4);
	 $sr =1; 
	if($_SESSION["utypeid"] == $admconst) {
	 echo "<div class='pageTitlenew'>FAQs for ".$col14." <a href='editFAQ.php?faqType=".$_POST['faqType']."' style='float:right;font-size:12px; text-decoration:none'>Edit</a></div><br>";
	 }else {
	 echo "<div class='pageTitlenew'>FAQs for ".$col14."</div><br>";
	 }
	 
	 while ($stmt->fetch()) {
	     echo  "<div class='boxFAQ'><div class='faqTitle'>".$col1."</div><div class='faqContent'>";
		 echo  $col2."</div></div><br>";
		 $sr++;
	 }
        	
	}
}




?>