                <?php 
                $dashboard = $calendar = $bookmarks = $wordbank = $resources = $progress = $logs = $todolist = '';
                $school_id = '';
                $q = $_SESSION["id"];
                $sql = "SELECT school_id FROM edu_user_school_level_class WHERE `user_id` = ?";
				
                // prepare query for execution
                $stmt = $mysqli->prepare($sql);
				 $stmt->bind_param("s", $param_user_id);
				 $param_user_id =$q;
                // execute the query
                $stmt->execute();
                $stmt->bind_result($school_id);
                $stmt->fetch();
                $stmt->close();
				
				 $sql = "SELECT * FROM edu_onoff_bulk WHERE school_id = ?";
                // prepare query for execution
               $stmt = $mysqli->prepare($sql);
                 $stmt->bind_param("s", $param_school_id);
				 $param_school_id =$school_id;
                $dashboard = '';
				$stmt->execute();
                $result = $stmt->get_result();
                //if ($stmt->num_rows > 0) {

                   while ($row = $result->fetch_assoc()) {

                   $dashboard = $row['dashboard'];
                    $calendar = $row['calendar'];
                    $bookmarks = $row['bookmarks'];
                    $wordbank = $row['wordbank'];
                    $resources = $row['resources'];
                    $progress = $row['progress'];
					$logs = $row['logs'];
					$todolist = $row['todolist'];
					}
					
					/* $sql = "SELECT dashboard,calendar,bookmarks,wordbank,resources,progress,logs,todolist FROM edu_onoff_bulk WHERE school_id = ?";
                // prepare query for execution
               $stmt = $mysqli->prepare($sql);
                 $stmt->bind_param("s", $param_school_id);
				 $param_school_id =$school_id;
                $dashboard = '';
				$stmt->execute();
				$stmt->bind_result($dashboard,$calendar,$bookmarks,$wordbank,$resources,$progress,$logs,$todolist);
                $stmt->fetch();*/
               // }
                ?>
<div class="navbar-default sidebar toppad" role="navigation" id="mySidebar" >
    <div class="sidebar-nav navbar-collapse" id="testsidemenu" >
       <ul class="nav" id="side-menu">
          <li class="logo_li"><a href="dashboard.php" style="padding:0px"><img src="images/Edutique-Logo-big.png" width="196"  height="50" ></a></li>
          <li class="logo_li">
              <table width="100%" cellpadding="0" cellspacing="0">
                     <?php
					     /* Query to fetch the user details. Inner Join query on tables edu_utype and edu_users */
					     $stmt = $mysqli->prepare("SELECT a.utype_id, a.user_type, b.user_image_path, b.first_name, b.last_name FROM edu_utype a inner join edu_users b WHERE a.user_type_id=b.user_type_id and b.user_id = ? and b.user_status = ?");
						 /* Bind parameters */
						 $stmt->bind_param("ss", $param_utypeid,$param_ustatus);
						/* Set parameters */
						$param_utypeid = $_SESSION["id"];
						$param_ustatus = $active;
						$stmt->execute();
						$stmt->bind_result($col1, $col2, $col3, $col4, $col5);
						$stmt->fetch();
						$stmt->close();
					?>
                    <tr>
                        <td width="30%">
                           <a href='account-setting.php'><span class="user" style="background-image:url(upload/<?php echo $col3;?>)"></span></a>
                                     
                        </td>
                        <td>
                            <span>
								 <?php
                                      /* Counts no of characters in the Name and replaces with dots if it exceeds 10 */								 
									  $uname = $col4." ".$col5;
									  $count = strlen($uname);
									  if($count > 10){
										 $uname = substr($uname,0,10);
										 echo "<a href='account-setting.php'>".$uname."....</a>";
									  }
									  else {
											 echo "<a href='account-setting.php'>".$uname."</a>";
									  }
								?>
                           </span>
                           <br />
                           <span>
                                 <?php echo "<a href='account-setting.php'>".$col2."</a>";?>
						   </span>
                        </td>
                    </tr>
              </table>
           </li>
           <?php if($col1== $admconst){  /* checks if logged in user is Admin and displays menu for Admin */ ?>
                    <li>
                        <a href="dashboard.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Your main page"><i class="material-icons-outlined md-16">dashboard</i> Dashboard</a>
                    </li>
                    <li>
                        <a href="main-calendar-admin.php?studId=0" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Keep track of events"><i class="material-icons-outlined md-16">view_column</i> Calendar</a>
                    </li>
                    <li>
                        <a href="all-bookmarks-admin.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Save articles & activities for later"><i class="material-icons-outlined md-16">star_outline</i> Bookmarks</a>
                    </li>
                    <li>
                        <a href="wordbank.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Save words you like"><i class="material-icons-outlined md-16">folder_open</i> Word Bank</a>
                    </li>
                    <li>
                        <a href="magazines.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Library of articles &activities"><i class="material-icons-outlined md-16">import_contacts</i> Resources<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="magazines.php">Magazines</a>
                            </li>
                            <li>
                                <a href="articles.php">Articles</a>
                            </li>
                            <li>
                                <a href="activities.php">Activities</a>
                            </li>
                            
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                      <li>
                        <a href="#" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Track users' data & performance"><i class="material-icons-outlined md-16">groups</i> User Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="users.php?scID=0&lvId=0&clId=0">Users</a>
                            </li>
                            <li>
                                <a href="users-subscription.php">Subscription Management</a>
                            </li>
                            <li>
                                <a href="subscriber-list.php">School / Organisations</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="View records of all users, reviews & reflections"><i class="material-icons-outlined md-16">view_agenda</i> Logs<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            
                            <li>
                                <a href="task-log-admin.php">Task Log</a>
                            </li>
                            <li>
                                <a href="reflection-log.php">Reflection Log</a>
                            </li>
                            <li>
                                <a href="review-log.php">Review Log</a>
                            </li>
                            <li>
                                <a href="announcement-log.php" >Announcement Log</a>
                            </li>
                            <li>
                                <a href="question-portal-log.php" >Question Portal Log</a>
                            </li>
                            <li>
                                <a href="aids-log.php">Aids Log</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Track users' data & performance"><i class="material-icons-outlined md-16">insert_chart_outlined</i> Analytics<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="data-analytics.php">Data</a>
                            </li>
                            <li>
                                <a href="progress-admin.php">Progress</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
            <?php } elseif($col1== $admstdconst){ /* checks if logged in user is Student and displays menu for Student */ ?>
            
					<?php if ($dashboard == 1) { ?>
                    <li>
                        <a href="dashboard.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Your main page"><i class="material-icons-outlined md-16">dashboard</i> Dashboard</a>
                    </li>
                    <?php } if($todolist == 1){ ?>
                    <li>
                          <a href="to-do-list.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Get Started on Your Assignments"><i class="material-icons-outlined md-16">view_agenda</i> To-Do List</a>
                    </li>
                    <?php }  if($calendar == 1){ ?>
                    <li>
                        <a href="mainCalendar.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="See what's due & when"><i class="material-icons-outlined md-16">view_column</i> Calendar</a>
                    </li>
                    <?php }  if($bookmarks == 1){ ?>
                    <li>
                        <a href="all-bookmarks.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Save articles & activities for later"><i class="material-icons-outlined md-16">star_outline</i> Bookmarks</a>
                    </li>
                     <?php }  if($wordbank == 1){ ?>
                    <li>
                        <a href="wordbank.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Save words you like"><i class="material-icons-outlined md-16">folder_open</i> Word Bank</a>
                    </li>
                    <?php }  if($resources == 1){ ?>
                    <li>
                        <a href="magazines.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="View your available reads & activities"><i class="material-icons-outlined md-16">import_contacts</i> Resources<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="magazines.php">Magazines</a>
                            </li>
                            <li>
                                <a href="articles.php">Articles</a>
                            </li>
                            <li>
							    <a href="activities.php">Activities</a>
                            </li>
                         </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <?php }  if($progress == 1){ ?>
                    <li>
                        <a href="#" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Track your improvement"><i class="material-icons-outlined md-16">insert_chart_outlined</i> Progress<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="my_progress.php">Progress Report</a>
                            </li>
                            <li>
                                <a href="pastAttempts.php">Past Attempts</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <?php }?>
                            
			<?php } elseif($col1==$admtchconst || $col1== $admprogtchconst){ /* checks if logged in user is Teacher and displays menu for Teacher */?>
            
            <?php if ($dashboard == 1) { ?>
                    <li>
                        <a href="dashboard.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Your main page"><i class="material-icons-outlined md-16">dashboard</i> Dashboard</a>
                    </li>
                     <?php }  if($calendar == 1){ ?>
                    <li>
                        <a href="main-tcalendar.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="See what's due & when"><i class="material-icons-outlined md-16">view_column</i> Calendar</a>
                    </li>
                     <?php }  if($bookmarks == 1){ ?>
                    <li>
                        <a href="all-bookmarks.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Save articles & activities for later"><i class="material-icons-outlined md-16">star_outline</i> Bookmarks</a>
                    </li>
                     <?php }  if($wordbank == 1){ ?>
                    <li>
                        <a href="wordbank.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Save words you like"><i class="material-icons-outlined md-16">folder_open</i> Word Bank</a>
                    </li>
                    <?php }  if($resources == 1){ ?>
                    <li>
                        <a href="magazines.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="View your available reads & activities"><i class="material-icons-outlined md-16">import_contacts</i> Resources<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="magazines.php">Magazines</a>
                            </li>
                            <li>
                                <a href="articles.php">Articles</a>
                            </li>
                            <li>
                                <a href="activities.php">Activities</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <?php }  if($logs == 1){ ?>
                    <li>
                        <a href="#" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="View records of all tasks & your classes"><i class="material-icons-outlined md-16">view_agenda</i> Logs<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="my_classes.php">Classes</a>
                            </li>
                            <li>
                                <a href="task-log.php">Task Log</a>
                            </li>
                            <li>
                                <a href="reflection-log.php">Reflection Log</a>
                            </li>
                             <li>
                                <a href="other-notifications.php">Other Notifications</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <?php }  if($progress == 1){ ?>
                    <li>
                        <a href="progress.php" class="tooltipcls" data-toggle="tooltip" data-placement="right" title="Track students' improvement"><i class="material-icons-outlined md-16">insert_chart_outlined</i> Progress</a>
                    </li>
                   <?php }?>
                            
            <?php }?>
                    <li><a>&nbsp;</a></li>
                    <li><a>&nbsp;</a></li>
                    <li><a>&nbsp;</a></li>
                    <!--<li class="menutop">-->
                     <?php if($col1== $admconst){?>
                            <li >
                                <a href="need-help-admin.php"><i class="material-icons-outlined md-16">more_horiz</i> Need Help?</a>
                            </li>
                     <?php } elseif($col1== $admstdconst){ /* checks if logged in user is Student and displays menu for Student */ ?> 
                            <li >
                                <a href="need-help.php"><i class="material-icons-outlined md-16">more_horiz</i> Need Help?</a>
                            </li>
                     <?php } elseif($col1== $admtchconst){ /* checks if logged in user is Teacher and displays menu for Teacher */?> 
                            <li >
                                <a href="need-help.php"><i class="material-icons-outlined md-16">more_horiz</i> Need Help?</a>
                            </li>
                     <?php }?>            
                    <li >
                        <a href="account-setting.php"><i class="material-icons-outlined md-16">settings</i> Settings</a>
                    </li>
        </ul>
    </div>
</div>