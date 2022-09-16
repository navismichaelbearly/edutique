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
$mag_type_var = !empty($_POST['mag_type_var'])?$_POST['mag_type_var']:'';
$mtype= $_POST['mag_type_var2']." ".$_POST['issueVar'];
		
if($mag_type_var !='')	{	
  $stmt = $mysqli->prepare("SELECT mag_issue, mag_type FROM edu_magazine a inner join edu_mag_type b on a.mag_type_id=b.mag_type_id where mag_status=? and a.mag_type_id=?");
                                                        /* Bind parameters */
                                                        $stmt->bind_param("ss", $param_status, $param_mag_type_id);
                                                        /* Set parameters */
                                                        
                                                        $param_status = $active;
														$param_mag_type_id = $mag_type_var;
                                                        $stmt->execute();
                                                        $stmt->bind_result($mag_issue, $mag_type);
														
                                                         $sr =1;
                                                         //echo "<select name='bookMarktype' id='bookMarktype' class='form-control' required>";	
                                                         echo "<input list='issueNo' id='issue_no' name='issue_no' class='form-control formfield' required /></label>"	;
                                                         echo "<datalist id='issueNo'>";				
                                                         // fetch values 
                                                         while ($stmt->fetch()) {
                                                              $mag_issue_type = $mag_type." ".$mag_issue;
                                                              echo "<option style='font-family: Poppins !important;' value='" . $mag_issue_type . "' ".(($mag_issue_type==$mtype)?'selected="selected"':"").">" . $mag_issue_type . "</option>";
                                                              
                                                              
                                                                $sr++;
                                                         }
                                                         echo "</datalist>"; echo $mtype;
}
?>

