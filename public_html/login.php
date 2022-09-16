<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Initialize the session
session_start(); /*Session Start*/

date_default_timezone_set('Asia/Singapore');
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
}
 
// Include config file
require_once "inc/config.php";
include "inc/constants.php";
 
// Define variables and initialize with empty values
$username = $password = $rememberme="";
$username_err = $password_err = "";
	

//if($myIp == $ipAdd){ 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
  } 
  else{
      $username = trim($_POST["username"]);
  }
    
  // Check if password is empty
  if(empty(trim($_POST["password"]))){
     $password_err = "Please enter your password.";
  } 
  else{
      $password = trim($_POST["password"]);
  }
  
  if(isset($_POST['remember'])){
    $rememberme = trim($_POST["remember"]);  
  }
 
    
  // Validate credentials
  if(empty($username_err) && empty($password_err)){
    // Prepare a select statement
    $sql = "SELECT a.user_id, a.username, a.user_password, a.first_name, a.user_email, b.user_type,b.utype_id FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id  WHERE (a.username = ? or a.user_email = ?) and a.user_status = ? and b.user_type_status=?";
        
    if($stmt = $mysqli->prepare($sql)){
       // Bind variables to the prepared statement as parameters
       $stmt->bind_param("ssss", $param_username,$param_useremail,$param_ustatus,$param_user_type_status);
            
       // Set parameters
       $param_username = $username;
	   $param_useremail = $username;
	   $param_ustatus = $active;
	   $param_user_type_status = $active;
            
       // Attempt to execute the prepared statement
       if($stmt->execute()){
          // Store result
          $stmt->store_result();
                
          // Check if username exists, if yes then verify password
          if($stmt->num_rows == 1){                    
            // Bind result variables
            $stmt->bind_result($user_id, $username, $hashed_password, $fname, $email, $utype,$utypeid);
            if($stmt->fetch()){
              if(password_verify($password, $hashed_password)){
                // Password is correct, so start a new session
                #session_start();
				if($rememberme==true) {
					setcookie ("username",$_POST["username"],time() + 3600 * 24 * 30);
					setcookie ("password",$_POST["password"],time() + 3600 * 24 * 30);
				} /*else {
					setcookie("username","");
					setcookie("password","");
				}*/
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user_id;
                $_SESSION["username"] = $username; 
			    $_SESSION["fname"] = $fname;
				$_SESSION["email"] = $email;  
			    $_SESSION["utype"] = $utype;
				$_SESSION["utypeid"] = $utypeid;                         
                 
				$stmt2 = $mysqli->prepare("INSERT INTO edu_log (log_entry, log_entry_date, log_entry_status, user_id) VALUES (?, ?, ?, ?)");
	            $stmt2->bind_param("ssss", $param_log_entry, $param_log_entry_date, $param_log_entry_status, $param_user_id);
                $param_log_entry = $loginLog;
	            $param_log_entry_date = $todaysDate;
	            $param_log_entry_status = $active;
	            $param_user_id = $_SESSION["id"];
	            $stmt2->execute();  
				
				$stmt3 = $mysqli->prepare("INSERT INTO edu_login_details (user_id) VALUES (?)");
	            $stmt3->bind_param("s", $param_user_id1);
	            $param_user_id1 = $user_id;
	            $stmt3->execute();
				$_SESSION['login_details_id']=$stmt3->insert_id; 
				if($utypeid !=6){
				$stmt4 = $mysqli->prepare("SELECT school_id FROM edu_user_school_level_class where user_id=?");
	            $stmt4->bind_param("s", $param_user_id2);
	            $param_user_id2 = $user_id;
	            $stmt4->execute(); 
				$stmt4->bind_result($school_id);
				$stmt4->fetch();
				$_SESSION['school_id']=$school_id;  
				}        
                // Redirect user to welcome page
				header("location: dashboard.php");
               } 
			   else{
                    // Display an error message if password is not valid
                    $password_err = "The password you entered was not valid.";
              }
            }
          } 
		  else{
               // Display an error message if username doesn't exist
               $username_err = "Username not found OR Account is Inactive";
          }
        } 
		else{
             // echo "Oops! Something went wrong. Please try again later.";
        }
		// Close statement
        $stmt->close();
      }
        
        
  }
    
    // Close connection
    $mysqli->close();
}
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

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <div class="row login-panel">
              <div class="col-lg-6 col-md-6"><img src="images/Edutique-Logo-big.png" width="100%" style="padding:60px 0px">
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="col-md-offset-4">
                    <div>
                        <div>
                            <h6 class="panel-title ">Welcome Back</h6>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <fieldset>
                                    <label>Username/Email</label>
                                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <input class="form-control" placeholder="Username/Email" name="username" type="text" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } else { echo $username;} ?>" required>
                                        <span class="help-block"><?php echo $username_err; ?></span>
                                    </div>
                                    <label>Password</label>
                                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" required>
                                        <span class="help-block"><?php echo $password_err; ?></span>
                                    </div>
                                    <table width="100%">
                                      <tr>
                                          <td>
                                              <div class="checkbox">
                                                  <label>
                                                     <input name="remember" type="checkbox"  >Remember Me
                                                  </label>
                                              </div>
                                          </td>
                                          <td>
                                              <div ><a href="forgot_password.php">Forgot Password?</a></div>
                                          </td>
                                       </tr> 
                                     </table>     
                                    
                                    <!-- Change this to a button or input when using this as a form -->
                                    
                                    <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                  </div> 
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>

    </body>
</html>

