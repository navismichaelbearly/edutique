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
   /* Select Query to get FAQ Type */
	$stmt = $mysqli->prepare("SELECT faq_type,id FROM edu_faq_type where status=? and id = ?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_status,$param_faq_id);
	/* Set parameters */
	$param_faq_id = $_POST['faqType'];
	$param_status = $active;
	$stmt->execute();
	$stmt->bind_result($faq_type, $faq_typeid);
	$stmt->fetch();
	$stmt->close();
  if ($stmt = $mysqli->prepare("SELECT title,content,faq_id from edu_faq where status=? and faq_type=?")) {
		
	 $stmt->bind_param("ss", $param_status, $param_faq_type);
		 // Set parameters 
	 $param_status = $active;
	 $param_faq_type = $_POST['faqType'];
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($col1, $col2, $col3);
	 $sr =1;
	 echo "<div ><table style='background-color:transparent'><tr><td class='pageTitlenew'>FAQs for &nbsp;&nbsp;</td><td><input type='text' name='faqfor[]'  class='form-control' placeholder='Stakeholder' required='required' id='faqfor' value='".$faq_type."' readonly='readonly'></td></tr></table> </div><br>";
	 while ($stmt->fetch()) {
	     /*echo  "<div class='boxFAQ'><div class='faqTitle'>".$col1."</div><div class='faqContent'>";
		 echo  $col2."</div></div><br>";*/
		 echo "
                            <div id='dynamic_field'>
                               <p>
                                  <input type='text' name='questiontext[]'   class='form-control' placeholder='Question' required='required' value='".$col1."'>
                                  <input type='hidden' name='faqId[]'  value='".$col3."'>
                               </p>
					           <textarea class='form-control' rows='1'   name='messagetext[]'  placeholder='Answer' required>".strip_tags($col2)."</textarea><br>
                              
					         </div>";
		 $sr++;
	 }
        	
	}
}




?>