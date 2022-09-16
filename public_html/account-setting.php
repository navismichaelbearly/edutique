<?php
session_start(); /*Session Start*/
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

date_default_timezone_set('Asia/Singapore');

/* include files */
require_once "inc/config.php";
include "inc/constants.php";
include 'inc/functions.php';

/* Initialise PHP variables */
$current_password = $new_password = $confirm_password = "";
$current_password_err = $new_password_err = $confirm_password_err = "";

/* Query to fetch the user details. Inner Join query on tables edu_utype and edu_users */
$stmt = $mysqli->prepare("SELECT a.utype_id, a.user_type, b.user_image_path, b.first_name, b.last_name, b.user_password, b.user_email FROM edu_utype a inner join edu_users b WHERE a.user_type_id=b.user_type_id and b.user_id = ? and b.user_status = ?");
/* Bind parameters */
$stmt->bind_param("ss", $param_uid, $param_urstatus);
/* Set parameters */
$param_uid = $_SESSION["id"];
$param_urstatus = $active;
$stmt->execute();
$stmt->bind_result($uid, $utype, $imgpath, $fname, $lname, $pass, $uemail);
$stmt->fetch();
$stmt->close();

/* Checking if form has been submitted */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* Password Validation */
    if (strlen(trim($_POST["new_password"])) < 8) {
        $new_password_err = "Password must have atleast 8 characters.";
    } elseif (!preg_match("#[0-9]+#", $_POST["new_password"])) {
        $new_password_err = "Your Password Must Contain At Least 1 Number!";
    } elseif (!preg_match("#[A-Z]+#", $_POST["new_password"])) {
        $new_password_err = "Your Password Must Contain At Least 1 Capital Letter!";
    } elseif (!preg_match("#[a-z]+#", $_POST["new_password"])) {
        $new_password_err = "Your Password Must Contain At Least 1 Lowercase Letter!";
    } elseif (!preg_match('@[^\w]@', $_POST["new_password"])) {
        $new_password_err = "Your Password Must Contain At Least 1 Special Character!";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    /* Validate confirm password */
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($new_password_err) && ($new_password != $confirm_password)) {
        $confirm_password_err = "Password did not match.";
    }

    $current_password = trim($_POST["current_password"]);
    if (password_verify($current_password, $pass)) {
    } else {
        $current_password_err =  "Current Password is not valid.";
    }

    /* Checks if variables are free from errors */
    if (empty($new_password_err) && empty($confirm_password_err) && empty($current_password_err)) {
        /* update password query */
        $stmt = $mysqli->prepare("UPDATE edu_users SET user_password = ? WHERE user_email = ?");
        /* Bind parameters */
        $stmt->bind_param("ss", $param_password, $param_useremail);
        /* Set parameters */
        $param_password = password_hash($new_password, PASSWORD_DEFAULT); /* password encryption */
        $param_useremail = $uemail;
        if ($stmt->execute()) {
            sqlLoginsert($passwordupdateLog);
            /* Redirecting to dashboard after updating the password */
            echo "<script type='text/javascript'>alert('Password has been updated successfully');
                           window.location='dashboard.php';
                       </script>";
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        /* Close statement */
        //$stmt->close();
    }

    // Close connection
    // $mysqli->close();
}

$stmt = $mysqli->prepare("SELECT assigned_article_notify from edu_users  where user_id =?");
/* Bind parameters */
$stmt->bind_param("s", $param_user_id);
// Set parameters 
$param_user_id = $_SESSION['id'];
$stmt->execute();
$stmt->bind_result($assigned_article_notify);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("SELECT assigned_activity_notify from edu_users  where user_id =?");
/* Bind parameters */
$stmt->bind_param("s", $param_user_id);
// Set parameters 
$param_user_id = $_SESSION['id'];
$stmt->execute();
$stmt->bind_result($assigned_activity_notify);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("SELECT assigned_activity_review_notify from edu_users  where user_id =?");
/* Bind parameters */
$stmt->bind_param("s", $param_user_id);
// Set parameters 
$param_user_id = $_SESSION['id'];
$stmt->execute();
$stmt->bind_result($assigned_activity_review_notify);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edutique System</title>

    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    <style>
        td {
            padding: 10px;
        }

        .form_limit {

            max-width: 150px;
        }

        input[class="checkbox1"] {
            -webkit-appearance: initial;
            appearance: initial;
            background: gray;
            width: 40px;
            height: 40px;
            border: none;
            position: relative;
        }

        input[class="checkbox1"]:checked {
            background: red;
        }

        input[class="checkbox1"]:checked:after {
            /* Heres your symbol replacement */
            content: "X";
            color: #fff;
            /* The following positions my tick in the center, 
     * but you could just overlay the entire box
     * with a full after element with a background if you want to */
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            /*
     * If you want to fully change the check appearance, use the following:
     * content: " ";
     * width: 100%;
     * height: 100%;
     * background: blue;
     * top: 0;
     * left: 0;
     */
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar-inverse navbar-fixed-top" role="navigation">

            <!-- toggle menu in mobile and tablet view -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


            <!-- /.navbar-top-links -->

            <?php include 'inc/sidebar.php'; ?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <?php include 'inc/gsearch.php'; ?>
                <!-- /.col-lg-12 -->
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h3 id="grid-responsive-resets" class="headertext">Account Setting</h3>
                        
                        <div class="col-lg-12" align="right"><input type="button" id="cancel" value="Back" class="btn btn-success" style="font-weight:bold"></div>
                        <br>
                        <h5 class="themecolor">Avatar</h5>
                        <table border="0" class="tablewidth" style="background-color:transparent">
                            <tr>
                                <td><span id="uploaded_image1" class="logoprofile" style="background-image:url(upload/<?php echo $imgpath; ?>)"></span></td>
                                <td>
                                    <button style="margin:0px 0px" onClick="document.getElementById('file').click()" class="custbutton">Upload</button>
                                    <input type="file" name="file" id="file" value="Upload" style="display:none" />
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $imgpath; ?>" name="delete_file" id="delete_file" />
                                    <input type="button" value="Remove" onClick="delete_image()" class="custbutton" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="normaltext">Upload only png, jpg or jpeg file and File Size should be less than 100KB.</td>
                            </tr>
                        </table>
                        <br>
                        <h5 class="themecolor">Name</h5>
                        <div class="normaltext"><?php echo $fname . " " . $lname; ?></div><br>
                        <h5 class="themecolor">Change password</h5>
                        <div class="normaltext">
                            <?php echo $passwordStrengthtext; ?><br>
                            <?php echo $passwordText; ?><br><br>
                        </div>
                        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <fieldset>
                                <label>Current Password</label>
                                <div class="form-group <?php echo (!empty($current_password_err)) ? 'has-error' : ''; ?>">
                                    <input class="form-control formfield" placeholder="Current Password" name="current_password" type="password">
                                    <span class="help-block"><?php echo $current_password_err; ?></span>
                                </div>
                                <label>New Password</label>
                                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                    <input class="form-control formfield" placeholder="New Password" name="new_password" type="password">
                                    <span class="help-block"><?php echo $new_password_err; ?></span>
                                </div>
                                <label>Confirm New Password</label>
                                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                    <input class="form-control formfield" placeholder="Confirm Password" name="confirm_password" type="password">
                                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block formfield" value="Change Password">
                            </fieldset>
                        </form>
                        <?php if ($_SESSION["utypeid"] == $admtchconst || $_SESSION["utypeid"] == $admprogtchconst) { ?>
                            <br><br>
                            <h5 class="themecolor">Notification Settings</h5>
                            <label>Notify Me:</label><br>
                            <input type="checkbox" id="assignedReading" name="assignedReading" <?php if ($assigned_article_notify == 1) {
                                                                                                    echo "checked";
                                                                                                } ?>>&nbsp;&nbsp;<span class="normaltext">When students complete the assigned readings</span><br>
                            <input type="checkbox" name="assignedActivity" id="assignedActivity" <?php if ($assigned_activity_notify == 1) {
                                                                                                        echo "checked";
                                                                                                    } ?>>&nbsp;&nbsp;<span class="normaltext">When students complete assigned activities &nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input type="checkbox" name="reviewActivity" id="reviewActivity" <?php if ($assigned_activity_review_notify == 1) {
                                                                                                    echo "checked";
                                                                                                } ?>>&nbsp;&nbsp;<span class="normaltext">Only when students complete actvities that need to be reviewed</span>
                        <?php } ?>
                        <br><br>
                        <?php
                         if ($_SESSION["utypeid"] == $admconst) { 
                        ?>
                        <h2>Control Settings</h2>
                        <h3>Enable/Disable Features </h3>
                        <p> The following features can be enabled/disabled for Teachers. For example: if locking is disabled, Teachers
                            will not be given option to lock the articles or activities.
                        </p>
                        <br>
                        <div class="container row col-lg-11">
                            <div class="form-group col-lg-3">
                                <label for="exampleSelect1">Show Schools</label>
                                <select class="form-control form_limit" id="show_school" name="show_school">
                                    <?php
                                    // select school_id, school_name from edu_schools
                                    $sql = "SELECT school_id, school_name FROM edu_school";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["school_id"] . "'>" . $row["school_name"] . "</option>";
                                        }
                                    }

                                    ?>
                                    <!-- <option value="1">Lock Articles</option>
                                    <option value="2">Lock Activities</option>
                                    <option value="3">Lock Assignments</option> -->
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleSelect1">Start Date</label>
                                <input type="date" class="form-control form_limit" id="start_date" name="start_date">

                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleSelect1">End Date</label>
                                <input type="date" class="form-control form_limit" id="end_date" name="end_date">
                            </div>

                            <table class="onofftable ">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>Enable</td>
                                        <td>Disable</td>
                                        <td>Remarks</td>
                                    </tr>
                                </thead>

                                <tr>
                                    <td>Lock</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="rad1" id="inlineCheckbox1" value="1" checked>
                                    </td>
                                    <td><input class="form-check-input" type="checkbox" name="rad1" id="inlineCheckbox2" value="0"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Content Aid</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad2" id="inlineCheckbox3" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad2" id="inlineCheckbox4" value="0"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Receive Questions</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad3" id="inlineCheckbox5" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad3" id="inlineCheckbox6" value="0"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Allow Unlimited Attempts</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad4" id="inlineCheckbox7" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad4" id="inlineCheckbox8" value="0"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>No. of Attempts:</td>
                                    <td>
                                        <input type="number" class="form-control form_limit" id="no_of_attempts" name="no_of_attempts" value="0">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Hide Suggested Answers</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad5" id="inlineCheckbox9" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad5" id="inlineCheckbox10" value="0"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Peer Review</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad6" id="inlineCheckbox11" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad6" id="inlineCheckbox12" value="0"></td>
                                    <td></td>
                                </tr>

                                <br><br>

                                <br><br>
                                <br><br>
                            </table>
                            <div class="">
                                <div class="col-lg-3 ">
                                    <h4 class="themecolor1"><a href="#" style="color:#3f3a60" onClick="submit_onoff();">Submit Changes</a></h4>
                                </div>
                            </div>

                            </table>
                        </div>
                        <!-- /.col-lg-12 -->


                        <br>
                        <br>
                        <br>
                        <p> The following features can be enabled/disabled for Bulk Users under Schools/Organisations.
                        </p>
                        <div class="container row col-lg-11" >
                            <div class="form-group col-lg-3">
                                <label for="exampleSelect1">Show Schools</label>
                                <select class="form-control form_limit" id="show_school1" name="show_school1">
                                    <?php
                                    // select school_id, school_name from edu_schools
                                    $sql = "SELECT school_id, school_name FROM edu_school";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["school_id"] . "'>" . $row["school_name"] . "</option>";
                                        }
                                    }

                                    ?>

                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleSelect1">Start Date</label>
                                <input type="date" class="form-control form_limit" id="start_date1" name="start_date1">

                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleSelect1">End Date</label>
                                <input type="date" class="form-control form_limit" id="end_date1" name="end_date1">
                            </div>

                            <table class="onofftable">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>Enable</td>
                                        <td>Disable</td>
                                    </tr>
                                </thead>

                                <tr>
                                    <td>Dashboard</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="rad01" id="inlineCheckbox01" value="1" checked>
                                    </td>
                                    <td><input class="form-check-input" type="checkbox" name="rad01" id="inlineCheckbox02" value="0"></td>
                                </tr>
                                <tr>
                                    <td>To Do List</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad02" id="inlineCheckbox03" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad02" id="inlineCheckbox04" value="0"></td>
                                </tr>
                                <tr>
                                    <td>Calendar</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad03" id="inlineCheckbox05" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad03" id="inlineCheckbox06" value="0"></td>
                                </tr>
                                <tr>
                                    <td>Bookmarks</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad04" id="inlineCheckbox07" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad04" id="inlineCheckbox08" value="0"></td>
                                </tr>
                                <tr>
                                    <td>Word Bank</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad05" id="inlineCheckbox09" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad05" id="inlineCheckbox010" value="0"></td>
                                </tr>
                                <tr>
                                    <td>Resources</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad06" id="inlineCheckbox011" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad06" id="inlineCheckbox012" value="0"></td>
                                </tr>
                                <tr>
                                    <td>Progress</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad07" id="inlineCheckbox013" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad07" id="inlineCheckbox014" value="0"></td>
                                </tr>
                                <tr>
                                    <td>Logs</td>
                                    <td><input class="form-check-input" type="checkbox" name="rad08" id="inlineCheckbox015" value="1" checked></td>
                                    <td><input class="form-check-input" type="checkbox" name="rad08" id="inlineCheckbox016" value="0"></td>
                                </tr>

                                <br><br>

                                <br><br>
                                <br><br>
                            </table>
                            <div class="">
                                <div class="col-lg-3 ">
                                    <h4 class="themecolor1"><a href="#" style="color:#3f3a60" onClick="submit_onoff1();">Submit Changes</a></h4>
                                </div>
                            </div>

                            </table>
                        </div>
                        <?php } ?>

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>


        <!-- /#wrapper -->
        <!-- Modal popup form for success -->
        <div class="modal fade" id="successAll" role="dialog" align="center">
            <div class="modal-dialog" style="margin-top:150px;">

                <!-- Modal content-->
                <div class="modal-content1">

                    <div class="modal-body1">

                        <img src="images/tick-icon.png" width="100" height="100" style="width:100px; height:100px;">
                    </div>
                    <!--<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         </div>-->
                </div>

            </div>
        </div>


        <div class="container row">
            <div class="col-lg-9 text-center">
                <h4 class="themecolor1"><a href="logout.php" style="color:#3f3a60">Logout</a></h4>
            </div>
        </div>


        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <!-- <script src="js/raphael.min.js"></script>
        <script src="js/morris.min.js"></script>
        <script src="js/morris-data.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>
        <script>
            function setonOff(data) {
                var sentData = data;
                var jsonData = JSON.parse(sentData);
                // if jsonData contains error, show error message
                if (jsonData.data) {
                    // alert(jsonData.error);
                } else {

                    if (jsonData.start_date) {
                        var date = new Date(jsonData.start_date);
                        // change date format to yyyy-MM-dd
                        // check if date is valid
                        if (date.getTime() == date.getTime()) {
                            var newDate = date.toISOString().slice(0, 10);
                            $('#start_date').val(newDate);
                        } else {
                            $('#start_date').val('');
                        }
                    }
                    if (jsonData.end_date) {
                        var date = new Date(jsonData.end_date);
                        if (date.getTime() == date.getTime()) {
                            var newDate = date.toISOString().slice(0, 10);
                            $('#end_date').val(newDate);
                        } else {
                            $('#end_date').val('');
                        }
                    }
                    if (jsonData.attempts) {
                        $('#no_of_attempts').val(jsonData.attempts);
                    }
                    if (jsonData.lock_enable) {
                        if (jsonData.lock_enable == 1) {
                            $('#inlineCheckbox1').prop('checked', true);
                            $('#inlineCheckbox2').prop('checked', false);
                        } else {
                            $('#inlineCheckbox1').prop('checked', false);
                            $('#inlineCheckbox2').prop('checked', true);
                        }
                    }
                    if (jsonData.receive_questions) {
                        if (jsonData.receive_questions == 1) {
                            $('#inlineCheckbox5').prop('checked', true);
                            $('#inlineCheckbox6').prop('checked', false);
                        } else {
                            $('#inlineCheckbox5').prop('checked', false);
                            $('#inlineCheckbox6').prop('checked', true);
                        }
                    }
                    if (jsonData.unlimited_attempts) {
                        if (jsonData.unlimited_attempts == 1) {
                            $('#inlineCheckbox7').prop('checked', true);
                            $('#inlineCheckbox8').prop('checked', false);
                        } else {
                            $('#inlineCheckbox7').prop('checked', false);
                            $('#inlineCheckbox8').prop('checked', true);
                        }
                    }
                    if (jsonData.hide_suggested_answers) {
                        if (jsonData.hide_suggested_answers == 1) {
                            $('#inlineCheckbox9').prop('checked', true);
                            $('#inlineCheckbox10').prop('checked', false);
                        } else {
                            $('#inlineCheckbox9').prop('checked', false);
                            $('#inlineCheckbox10').prop('checked', true);
                        }
                    }
                    if (jsonData.peer_review) {
                        if (jsonData.peer_review == 1) {
                            $('#inlineCheckbox11').prop('checked', true);
                            $('#inlineCheckbox12').prop('checked', false);
                        } else {
                            $('#inlineCheckbox11').prop('checked', false);
                            $('#inlineCheckbox12').prop('checked', true);
                        }
                    }
                    if (jsonData.content_aid) {
                        if (jsonData.content_aid == 1) {
                            $('#inlineCheckbox3').prop('checked', true);
                            $('#inlineCheckbox4').prop('checked', false);
                        } else {
                            $('#inlineCheckbox3').prop('checked', false);
                            $('#inlineCheckbox4').prop('checked', true);
                        }
                    }
                }
                check_attempts();
            }

            function setonOff1(data) {
                var sentData = data;
                var jsonData = JSON.parse(sentData);
                // if jsonData contains error, show error message
                if (jsonData.data) {
                    // alert(jsonData.error);
                } else {

                    if (jsonData.start_date) {
                        var date = new Date(jsonData.start_date);
                        // change date format to yyyy-MM-dd
                        // check if date is valid
                        if (date.getTime() == date.getTime()) {
                            var newDate = date.toISOString().slice(0, 10);
                            $('#start_date1').val(newDate);
                        } else {
                            $('#start_date1').val('');
                        }

                    }
                    if (jsonData.end_date) {
                        var date = new Date(jsonData.end_date);
                        // change date format to yyyy-MM-dd
                        // check if date is valid
                        if (date.getTime() == date.getTime()) {
                            var newDate = date.toISOString().slice(0, 10);
                            $('#end_date1').val(newDate);
                        } else {
                            $('#end_date1').val('');
                        }

                    }
                    // ``, ``, ``, ``, ``, ``, `` 
                    //"dashboard":"0","todolist":"1","calendar":"1","bookmarks":"1","wordbank":"1","resources":"1","progress":"1"}
                    if (jsonData.dashboard) {
                        if (jsonData.dashboard == 1) {
                            $('#inlineCheckbox01').prop('checked', true);
                            $('#inlineCheckbox02').prop('checked', false);
                        } else {
                            $('#inlineCheckbox01').prop('checked', false);
                            $('#inlineCheckbox02').prop('checked', true);
                        }
                    }
                    if (jsonData.todolist) {
                        if (jsonData.todolist == 1) {
                            $('#inlineCheckbox03').prop('checked', true);
                            $('#inlineCheckbox04').prop('checked', false);
                        } else {
                            $('#inlineCheckbox03').prop('checked', false);
                            $('#inlineCheckbox04').prop('checked', true);
                        }
                    }
                    if (jsonData.calendar) {
                        if (jsonData.calendar == 1) {
                            $('#inlineCheckbox05').prop('checked', true);
                            $('#inlineCheckbox06').prop('checked', false);
                        } else {
                            $('#inlineCheckbox05').prop('checked', false);
                            $('#inlineCheckbox06').prop('checked', true);
                        }
                    }
                    if (jsonData.bookmarks) {
                        if (jsonData.bookmarks == 1) {
                            $('#inlineCheckbox07').prop('checked', true);
                            $('#inlineCheckbox08').prop('checked', false);
                        } else {
                            $('#inlineCheckbox07').prop('checked', false);
                            $('#inlineCheckbox08').prop('checked', true);
                        }
                    }
                    if (jsonData.wordbank) {
                        if (jsonData.wordbank == 1) {
                            $('#inlineCheckbox09').prop('checked', true);
                            $('#inlineCheckbox010').prop('checked', false);
                        } else {
                            $('#inlineCheckbox09').prop('checked', false);
                            $('#inlineCheckbox010').prop('checked', true);
                        }
                    }
                    if (jsonData.resources) {
                        if (jsonData.resources == 1) {
                            $('#inlineCheckbox011').prop('checked', true);
                            $('#inlineCheckbox012').prop('checked', false);
                        } else {
                            $('#inlineCheckbox011').prop('checked', false);
                            $('#inlineCheckbox012').prop('checked', true);
                        }
                    }
                    if (jsonData.progress) {
                        if (jsonData.progress == 1) {
                            $('#inlineCheckbox013').prop('checked', true);
                            $('#inlineCheckbox014').prop('checked', false);
                        } else {
                            $('#inlineCheckbox013').prop('checked', false);
                            $('#inlineCheckbox014').prop('checked', true);
                        }
                    }
					
					if (jsonData.logs) {
                        if (jsonData.logs == 1) {
                            $('#inlineCheckbox015').prop('checked', true);
                            $('#inlineCheckbox016').prop('checked', false);
                        } else {
                            $('#inlineCheckbox015').prop('checked', false);
                            $('#inlineCheckbox016').prop('checked', true);
                        }
                    }
                }
                //check_attempts();
            }

            function submit_onoff() {
                // fetch radio button status of inlineCheckbox1 to inlineCheckbox12
                var data = {}
                for (i = 2; i <= 12; i += 2) {
                    var rad = document.getElementById("inlineCheckbox" + (i - 1));
                    // data[rad.name] = rad.checked;
                    // 
                    data[rad.name] = rad.checked ? 1 : 0;
                }
                var select = document.getElementById("no_of_attempts");
                data[select.name] = select.value;
                // get data from show_school, start_date, end_date
                var show_school = document.getElementById("show_school");
                data[show_school.name] = $('#show_school').val();
                // get data from show_school select

                var start_date = document.getElementById("start_date");
                data[start_date.name] = start_date.value;
                var end_date = document.getElementById("end_date");
                data[end_date.name] = end_date.value;
                
                //if startdate or enddate is empty, show error message
                if (start_date.value == '' || end_date.value == '') {
                    alert('Please select start date and end date');
                    return;
                } 

                $.ajax({
                    type: 'POST',
                    url: 'data/updateOnOff.php',
                    data: data,
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        $('#successAll').modal({
                            backdrop: 'static',
                            keyboard: true,
                            show: true
                        });
                        setTimeout(function() {
                            $('#successAll').modal('hide');
                        }, 2000);
                        setTimeout(function() {
                            //window.location = 'account-setting.php';
                        }, 2000);
                    }
                });

            }

            function submit_onoff1() { 
                // fetch radio button status of inlineCheckbox1 to inlineCheckbox12
                var data = {}
                for (i = 2; i <= 16; i += 2) {
                    var rad = document.getElementById("inlineCheckbox0" + (i - 1));
                    data[rad.name] = rad.checked ? 1 : 0;
                }
                // get data from show_school, start_date, end_date
                var show_school = document.getElementById("show_school1");
                data[show_school.name] = $('#show_school1').val();
                // get data from show_school select

                var start_date = document.getElementById("start_date1");
                data[start_date.name] = start_date.value;
                var end_date = document.getElementById("end_date1");
                data[end_date.name] = end_date.value;
                
                //if startdate or enddate is empty, show error message
                if (start_date.value == '' || end_date.value == '') {
                    alert('Please select start date and end date');
                    return;
                }

               $.ajax({
                    type: 'POST',
                    url: 'data/updateOnOffBulk.php',
                    data: data,
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        $('#successAll').modal({
                            backdrop: 'static',
                            keyboard: true,
                            show: true
                        });
                        setTimeout(function() {
                            $('#successAll').modal('hide');
                        }, 2000);
                        setTimeout(function() {
                            //window.location = 'account-setting.php';
                        }, 2000);
                    }
                });

            }

            // if inlineCheckbox8 is checked, then make input with id no_of_attempts visible
            function check_attempts() {

                if ($('#inlineCheckbox8').is(':checked')) {
                    $('#no_of_attempts').show();
                } else {
                    $('#no_of_attempts').hide();
                }

                $('#inlineCheckbox8').click(function() {
                    if ($(this).is(':checked')) {
                        $('#no_of_attempts').show();
                    } else {
                        $('#no_of_attempts').hide();
                    }
                });

                $('#inlineCheckbox7').click(function() {
                    if ($(this).is(':checked')) {
                        $('#no_of_attempts').hide();
                    } else {
                        $('#no_of_attempts').show();
                        // set inlineCheckbox8 as selected
                        $('#inlineCheckbox8').prop('checked', true);
                    }
                });

                $('input[type=checkbox]').change(function() {
                    if (this.checked) {
                        $(this).closest('tr')
                            .find('input[type=checkbox]').not(this)
                            .prop('checked', false);
                    }
                });
            }

            var school_id = $('#show_school').val();
            $.ajax({
                type: 'POST',
                url: 'data/getOnOff.php',
                data: {
                    school_id: school_id
                },
                cache: false,
                success: function(data) {
                    //console.log(data);
                    setonOff(data);
                }
            });

            var school_id = $('#show_school1').val();
            $.ajax({
                type: 'POST',
                url: 'data/getOnOffBulk.php',
                data: {
                    school_id: school_id
                },
                cache: false,
                success: function(data) {
                    //console.log(data);
                    setonOff1(data);
                }
            });


            $(document).ready(function() {
                check_attempts();

                // when show_school is selected, call ajax function to populate the check boxes
                $('#show_school').change(function() {
                    var school_id = $('#show_school').val();
                    $.ajax({
                        type: 'POST',
                        url: 'data/getOnOff.php',
                        data: {
                            school_id: school_id
                        },
                        cache: false,
                        success: function(data) {
                            //console.log(data);
                            setonOff(data);
                        }
                    });
                });

                if ($('#inlineCheckbox8').is(':checked')) {
                    $('#no_of_attempts').show();
                } else {
                    $('#no_of_attempts').hide();
                }


                $(document).on('change', '#file', function() {
                    var name = document.getElementById("file").files[0].name;
                    var form_data = new FormData();
                    var ext = name.split('.').pop().toLowerCase();
                    /*Image Validation - checks for the type and size*/
                    if (jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                        alert("Invalid Image File. Upload only png, jpg or jpeg file");
                    }
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("file").files[0]);
                    var f = document.getElementById("file").files[0];
                    var fsize = f.size || f.fileSize;
                    // if((fsize > 100000) || (fsize < 60000)){
                    if (fsize > 100000) {
                        alert("Image File Size should be less than 100KB");
                    } else {
                        form_data.append("file", document.getElementById('file').files[0]);
                        /* jQuery Ajax Call in PHP Script */
                        $.ajax({
                            url: "upload.php",
                            method: "POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function() {
                                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                            },
                            success: function(data) {
                                $('#uploaded_image').html(data);
                                $('#successAll').modal({
                                    backdrop: 'static',
                                    keyboard: true,
                                    show: true
                                });
                                setTimeout(function() {
                                    $('#successAll').modal('hide');
                                }, 2000);
                                setTimeout(function() {
                                    window.location = 'account-setting.php';
                                }, 2000);

                            }
                        });
                    }
                });
            });

            /* Function to delete uploaded image */
            function delete_image() {
                var status = confirm("Are you sure you want to delete ?");
                if (status == true) {
                    var file = $("#delete_file").val();
                    /* jQuery Ajax Call in PHP Script */
                    $.ajax({
                        type: "POST",
                        url: "image-delete.php",
                        data: {
                            file: file
                        },
                        success(html) {
                            $('#successAll').modal({
                                backdrop: 'static',
                                keyboard: true,
                                show: true
                            });
                            setTimeout(function() {
                                $('#successAll').modal('hide');
                            }, 2000);
                            setTimeout(function() {
                                window.location = 'account-setting.php';
                            }, 2000);
                        }
                    });
                }
            }

            $(document).ready(function() {

                $('#assignedReading').on('change', function() {
                    var checkedassignedReading = '';
                    var checkedassignedActivity = '';
                    var checkedreviewActivity = '';
                    if ($('input[name="assignedReading"]').is(':checked')) {
                        checkedassignedReading = 1;
                    } else {
                        checkedassignedReading = 0;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'data/updateUser.php',
                        data: {
                            checkedassignedReading: checkedassignedReading,
                            checkedassignedActivity: checkedassignedActivity,
                            checkedreviewActivity: checkedreviewActivity
                        },
                        cache: false,
                        success: function(data) {
                            $('#successAll').modal({
                                backdrop: 'static',
                                keyboard: true,
                                show: true
                            });
                            setTimeout(function() {
                                $('#successAll').modal('hide');
                            }, 2000);
                            setTimeout(function() {
                                window.location = 'account-setting.php';
                            }, 2000);
                        }
                    });
                });

                $('#assignedActivity').on('change', function() {
                    var checkedassignedReading = '';
                    var checkedassignedActivity = '';
                    var checkedreviewActivity = '';
                    if ($('input[name="assignedActivity"]').is(':checked')) {
                        checkedassignedActivity = 1;
                    } else {
                        checkedassignedActivity = 0;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'data/updateUser.php',
                        data: {
                            checkedassignedReading: checkedassignedReading,
                            checkedassignedActivity: checkedassignedActivity,
                            checkedreviewActivity: checkedreviewActivity
                        },
                        cache: false,
                        success: function(data) {
                            $('#successAll').modal({
                                backdrop: 'static',
                                keyboard: true,
                                show: true
                            });
                            setTimeout(function() {
                                $('#successAll').modal('hide');
                            }, 2000);
                            setTimeout(function() {
                                window.location = 'account-setting.php';
                            }, 2000);
                        }
                    });
                });

                $('#reviewActivity').on('change', function() {
                    var checkedassignedReading = '';
                    var checkedassignedActivity = '';
                    var checkedreviewActivity = '';
                    if ($('input[name="reviewActivity"]').is(':checked')) {
                        checkedreviewActivity = 1;
                    } else {
                        checkedreviewActivity = 0;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'data/updateUser.php',
                        data: {
                            checkedassignedReading: checkedassignedReading,
                            checkedassignedActivity: checkedassignedActivity,
                            checkedreviewActivity: checkedreviewActivity
                        },
                        cache: false,
                        success: function(data) {
                            $('#successAll').modal({
                                backdrop: 'static',
                                keyboard: true,
                                show: true
                            });
                            setTimeout(function() {
                                $('#successAll').modal('hide');
                            }, 2000);
                            setTimeout(function() {
                                window.location = 'account-setting.php';
                            }, 2000);
                        }
                    });
                });
				
				$('#cancel').on('click', function(e){
				e.preventDefault();
				window.history.back();
			    });

            });
        </script>

</body>

</html>