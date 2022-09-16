<?php
session_start();
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

/* include files */
require_once "inc/config.php";
include "inc/constants.php";
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

    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style type="text/css">
        .multi-select-container {
            display: inline-block;
            position: relative;
        }

        .multi-select-menu {
            position: absolute;
            left: 0;
            top: 23px;
            z-index: 1;
            float: left;
            min-width: 100%;
            background: #fff;
            margin: 1em 0;
            /*border: 1px solid #aaa;*/
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            display: none;
            color: #707683;
            font-weight: normal;
            font-size: 12px;
        }

        .multi-select-menuitem {
            display: block;
            font-size: 0.875em;
            padding: 0.6em 1em 0.6em 30px;
            white-space: nowrap;
        }

        .multi-select-menuitem--titled:before {
            display: block;
            font-weight: bold;
            content: attr(data-group-title);
            margin: 0 0 0.25em -20px;
        }

        .multi-select-menuitem--titledsr:before {
            display: block;
            font-weight: bold;
            content: attr(data-group-title);
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        .multi-select-menuitem+.multi-select-menuitem {
            padding-top: 0;
        }

        .multi-select-presets {
            border-bottom: 1px solid #ddd;
        }

        .multi-select-menuitem input {
            position: absolute;
            margin-top: 0.25em;
            margin-left: -20px;
        }

        .multi-select-button {
            display: inline-block;
            font-size: 0.875em;
            padding: 7px 10px;
            max-width: 16em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: -0.5em;
            background-color: #f9f9f9;
            border: 1px solid #e1e0e0;
            /*border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);*/
            cursor: default;
        }

        .multi-select-button:after {
            content: "\f107";
            /*display: inline-block;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0.4em 0.4em 0 0.4em;
    border-color: #999 transparent transparent transparent;
    margin-left: 0.4em;
    vertical-align: 0.1em;*/
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 14px;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            margin-left: 0.4em;
        }

        .multi-select-container--open .multi-select-menu {
            display: block;
        }

        .multi-select-container--open .multi-select-button:after {
            border-width: 0 0.4em 0.4em 0.4em;
            border-color: transparent transparent #999 transparent;
        }

        .multi-select-container--positioned .multi-select-menu {
            /* Avoid border/padding on menu messing with JavaScript width calculation */
            box-sizing: border-box;
        }

        .multi-select-container--positioned .multi-select-menu label {
            /* Allow labels to line wrap when menu is artificially narrowed */
            white-space: normal;
        }

        input[type=checkbox] {
            -webkit-appearance: none;
            border: 1px solid #cacece;

            padding: 6px;
            display: inline-block;
            position: relative;
        }

        input[type=checkbox]:checked {
            background-color: #3f3a60;
            border: 1px solid #3f3a60;
            /*box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);*/
            /* color:#FFFFFF;
		display: inline-block;
      transform: rotate(45deg);
      height: 5px;
      width: 2px; 
      border-bottom: 5px solid white;
      border-right: 5px solid white;
	  margin:2px;*/
            background-image: url(images/tick.png);
            background-repeat: no-repeat;
            height: 12px;
            width: 12px;
        }

        .bg-comp {
            background-color: #18ce67;
        }

        .bg-incomp {
            background-color: #ffcc00;
        }

        .bg-overdue {
            background-color: #ef7739;
        }

        .bg-unopen {
            background-color: #c2cfe0;
        }

        .progress {
            height: 4px;
            width: 200px;
            margin-bottom: 0px;
            overflow: hidden;
            background-color: #000;
            /*border-radius: 4px;*/
            /*-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	  box-shadow: inset 0 1px 2px rgba(0,0,0,.1);*/
        }

        .progress-bar {
            float: left;
            width: 0;
            height: 4px;
            font-size: 12px;
            line-height: 5px;
            color: #fff;
            text-align: center;
            -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
            -webkit-transition: width .6s ease;
            -o-transition: width .6s ease;
            transition: width .6s ease;
        }

        #your_dropdown {
            display: none
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
            <div class="row">
                <div class="col-lg-12" style="padding-left:0px; padding-right:0px;">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6">
                                    <h3 id="grid-responsive-resets" style="color:#3F3A60; font-size:24px; font-style: normal;font-weight: bold;letter-spacing: 0.1px;">My Resources Library</h3>
                                </div>
                                <div class="col-xs-6 col-sm-6" align="right">
                                    <?php
                                    if ($_SESSION["utype"] == 5) { ?>
                                        <button type="button" class="btn btn-success">Magazine Options</button>&nbsp;&nbsp;
                                        <button type="button" class="btn btn-success">Create Magazine</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <p style="font-style: normal;font-size: 13px;line-height: 18px;letter-spacing: 0.2px; color:#707683">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna</p>
                            <div class="row show-grid">
                                <div class="col-xs-6 col-sm-6" id="your_dropdown">
                                    <form>

                                        <span class="normaltext" style="vertical-align:middle !important">Sort by:&nbsp;</span>
                                        <span><select id="magTitle" name="magTitle" multiple>
                                                <option value="Asc">Alphabetically, A to Z</option><span class="geekmark"></span>
                                                <option value="Desc">Alphabetically, Z to A</option>
                                            </select></span> &nbsp;
                                        <span><select id="magDate" name="magDate" multiple>
                                                <option value="Desc">Date, newest to oldest</option>
                                                <option value="Asc">Date, oldest to newes</option>
                                            </select></span>

                                    </form>
                                </div>
                                <div class="col-xs-6 col-sm-6"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row show-grid">
                            <!--<div class="col-xs-6 col-sm-2" align="center"><img src="images/ithink.jpg" height="202" style="border:1px solid #CCCCCC"><br><br>Coming Soon</div>
                                        <div class="col-xs-6 col-sm-2" align="center">
                                            <a href="mag-detail.php">
                                              <img src="images/inspire.jpg" height="202" style="border:1px solid #CCCCCC">
                                            </a>
                                            <br>Inspire 22/23
                                        </div>-->

                            <!-- Add the extra clearfix for only the required viewport -->
                            <div class="clearfix visible-xs"></div>
                            <div id="dataTableshow"></div>
                            <!--<div class="col-xs-6 col-sm-2" align="center"><img src="images/imag1.jpg" height="202" style="border:1px solid #CCCCCC"><br><br>i12</div>
                                        <div class="col-xs-6 col-sm-2" align="center"><img src="images/imag2.jpg" height="202" style="border:1px solid #CCCCCC"><br><br>i18</div>
                                        <div class="clearfix visible-xs"></div>
                                        <div class="col-xs-6 col-sm-2"></div>
                                        <div class="col-xs-6 col-sm-2"></div>-->
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
    <script type="text/javascript" src="js/jquery.multi-select.js"></script>
    <script src=" https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).load(function() {
                // When the page has loaded

                setTimeout(function() {

                    $('#your_dropdown').css({
                        'display': 'block',
                    });
                }, 200);
            });
            $(window).on("load", function() { // onload jQuery Ajax Call in PHP Script 
                var mag = 1;
                var magTitle = '';
                var magDate = '';
                $.ajax({
                    type: 'POST',
                    url: 'data/selectMagazinelist.php',
                    data: {
                        mag: mag,
                        magTitle: magTitle,
                        magDate: magDate
                    },
                    cache: false,
                    success: function(data) {
                        $("#dataTableshow").html(data);
                        $('#example').dataTable({
                            "bPaginate": true,
                            "bLengthChange": true,
                            "bFilter": true,
                            "bInfo": true,
                            "bAutoWidth": false
                        });
                    }
                });
            });

            $('#magTitle').on('change', function() {
                var magTitle = $(this).val();
                var mag = 1;
                var magDate = '';
                $.ajax({
                    type: 'POST',
                    url: 'data/selectMagazinelist.php',
                    data: {
                        mag: mag,
                        magTitle: magTitle,
                        magDate: magDate
                    },
                    cache: false,
                    success: function(data) {
                        $("#dataTableshow").html(data);
                    }
                });
            });

            $('#magDate').on('change', function() {
                var magDate = $(this).val();
                var mag = 1;
                var magTitle = '';
                $.ajax({
                    type: 'POST',
                    url: 'data/selectMagazinelist.php',
                    data: {
                        mag: mag,
                        magTitle: magTitle,
                        magDate: magDate
                    },
                    cache: false,
                    success: function(data) {
                        $("#dataTableshow").html(data);
                    }
                });
            });
        });
        $(function() {
            //$('#magDate').multiSelect();
            $('#magDate').multiSelect({
                containerHTML: '<div class="multi-select-container">',
                menuHTML: '<div class="multi-select-menu">',
                buttonHTML: '<span class="multi-select-button">',
                menuItemHTML: '<label class="multi-select-menuitem">',
                activeClass: 'multi-select-container--open',
                noneText: 'Date Published',
                allText: undefined,
                presets: undefined
            });

            $('#magTitle').multiSelect({
                containerHTML: '<div class="multi-select-container">',
                menuHTML: '<div class="multi-select-menu">',
                buttonHTML: '<span class="multi-select-button">',
                menuItemHTML: '<label class="multi-select-menuitem">',
                activeClass: 'multi-select-container--open',
                noneText: 'Title',
                allText: undefined,
                presets: undefined
            });
            //$('#magTitle').multiSelect();
        });
    </script>

</body>

</html>