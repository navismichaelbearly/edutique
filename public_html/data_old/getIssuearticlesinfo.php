<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
$issue_var = !empty($_POST['issue_var']) ? $_POST['issue_var'] : '';


if ($issue_var != '') {

  $issue_no = explode(" ", $_POST['issue_var']);

  $stmt = $mysqli->prepare("Select mag_type_id from edu_mag_type where mag_type=?");
  /* Bind parameters */
  $stmt->bind_param("s", $param_mag_type);
  /* Set parameters */
  $param_mag_type = $issue_no[0];
  $stmt->execute();
  $stmt->bind_result($mag_type_idnew);
  $stmt->fetch();
  $stmt->close();


  $stmt = $mysqli->prepare("Select mag_id from edu_magazine where mag_type_id=? and mag_status=? and mag_issue=?");
  /* Bind parameters */
  $stmt->bind_param("sss", $param_mag_type_id, $param_mag_status, $param_mag_issue);
  /* Set parameters */
  $param_mag_type_id = $mag_type_idnew;
  $param_mag_status = $active;
  $param_mag_issue = $issue_no[1];
  $stmt->execute();
  $stmt->bind_result($mag_id);
  $stmt->fetch();
  $stmt->close();

  $stmt = $mysqli->prepare("SELECT article_id, article_title FROM edu_article a where a.mag_id=?");
  /* Bind parameters */
  $stmt->bind_param("s", $param_mag_type_id);
  /* Set parameters */

  $param_mag_type_id = $mag_id;
  $stmt->execute();
  $stmt->bind_result($mag_issue, $mag_type);
  $sr = 1;
  //echo "<select name='bookMarktype' id='bookMarktype' class='form-control' required>";	
 // echo "<input list='article_id' id='article_id' name='article_id' class='form-control formfield' required /></label>";
  echo "<select id='article_id' name='article_id' class='form-control formfield' >";
  echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value=''>Select</option>";
  echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='0'>Nil</option>";
  // fetch values 
  while ($stmt->fetch()) {
    $mag_issue_type = $mag_type . " " . $mag_issue;
    echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='" . $mag_type . "'" . (($mag_issue_type == $issue_no) ? 'selected="selected"' : "") . ">" . $mag_type . "</option>";
    $sr++;
  }
  echo "</select>";
}
?>

