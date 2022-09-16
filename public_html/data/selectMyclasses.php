<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "inc/config.php";
include "inc/constants.php";

if($_POST['testPass'] != '')
{
 if($_POST['countryVal'] == 'All'){ 
    $countryVal = '';
	$searchVar ='';
 }else {
    $countryVal = $_POST['countryVal'];
 }
 if($countryVal != ''){ 
  $searchVar = "where b.country_name=?";
 }
 else if($countryVal != '' && $_POST['yearVal'] != ''){
   $searchVar = "where a.school_status=? c.subscription_start_date LIKE CONCAT('%',?,'%')";
 }
 else if($countryVal != '' && $_POST['subsStatus'] != ''){
   $searchVar = "where a.school_status=? and b.country_name=?";
 }
 else if($countryVal != '' && $_POST['subsStatus'] != '' && $_POST['yearVal'] != ''){
   $searchVar = "where a.school_status=? and b.country_name=? and c.subscription_start_date LIKE CONCAT('%',?,'%')";
 }
 else if($_POST['subsStatus'] != ''){
   $searchVar = "where a.school_status=?";
 }
 else if($_POST['subsStatus'] != '' && $_POST['yearVal'] != ''){
   $searchVar = "where a.school_status=? and c.subscription_start_date LIKE CONCAT('%',?,'%')";
 }
 else if($_POST['yearVal'] != ''){
   $searchVar = "where c.subscription_start_date LIKE CONCAT('%',?,'%')";
 }
 if ($stmt = $mysqli->prepare("SELECT a.school_name, b.country_name, c.subscription_start_date, c.subscription_end_date, COUNT(d.user_id) AS userCount FROM edu_school a right join edu_country b on a.country_id = b.country_id inner join edu_school_subscription c on a.school_id = c.school_id inner join edu_user_school_level_class d on a.school_id = d.school_id ".$searchVar)) {
     
	 
	 
	     if($countryVal != ''){ 
		  $stmt->bind_param("s", $param_countryname);
		  $param_countryname = $countryVal;
		 }
		 else if($countryVal != '' && $_POST['yearVal'] != ''){
		   $stmt->bind_param("ss", $param_status,$param_yearVal);
		   $param_countryname = $countryVal;
		   $param_yearVal  = $_POST['yearVal'];
		 }
		 else if($countryVal != '' && $_POST['subsStatus'] != ''){
		   $stmt->bind_param("ss", $param_status,$param_countryname);
		   $param_status = $_POST['subsStatus'];
		   $param_countryname = $countryVal;
		 }
		 else if($countryVal != '' && $_POST['subsStatus'] != '' && $_POST['yearVal'] != ''){
		   $stmt->bind_param("sss", $param_status,$param_countryname,$param_yearVal);
		   $param_status = $_POST['subsStatus'];
		   $param_countryname = $countryVal;
		   $param_yearVal  = $_POST['yearVal'];
		 }
		 else if($_POST['subsStatus'] != ''){
		  $stmt->bind_param("s", $param_status);
		  $param_status = $_POST['subsStatus'];
		 }
		 else if($_POST['subsStatus'] != '' && $_POST['yearVal'] != ''){
		   $stmt->bind_param("ss", $param_status,$param_yearVal);
		   $param_status = $_POST['subsStatus'];
		   $param_yearVal  = $_POST['yearVal'];
		 }
		 else if($_POST['yearVal'] != ''){
		   $stmt->bind_param("s", $param_yearVal);
		   $param_yearVal  = $_POST['yearVal'];
		 }
    
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($col1, $col2,$col3,$col4,$col5);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Enrolment</th>
                                                <th>Country</th>
                                                <th>Start Date</th>
                                                <th>End date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<tr>";
                                            
	 /* fetch values */
	 while ($stmt->fetch()) {
	      
		  if($col3 !=""){	
		     $newDate = date("d M Y", strtotime($col3));
		  }else {
		  	 $newDate="";
	      }
		  if($col4 !=""){	
		     $newDate1 = date("d M Y", strtotime($col4));
		  }else {
		  	 $newDate1="";
	      }
		  if($col5 == 0) {$col5="";
		  
		  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
		  }	else {
		       echo "<td> <span class='normaltext'>" . $col1 . "</span></td>";	   
			   echo "<td class='normaltext'> " . $col5 . "</td>";
			   echo "<td class='normaltext'> " . $col2 . "</td>";
		       echo "<td class='normaltext'>" . $newDate . "</td>";
			   echo "<td class='normaltext'>" . $newDate1 . "</td>";
		  }	
	      
		      
					$sr++;
	}
	
	echo "</tr>
                                        </tbody>    
                                      </table>";
 }						
 
}
?>
