<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location:login.php');
}

function isLocalHost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

if (isLocalHost()) {
    $root = "//localhost/aspengroup.online";
    define("ROOT", $root);
    $bareRoot =  "//localhost";
    define("BARE_ROOT", $bareRoot);
    $documentRoot = $_SERVER['DOCUMENT_ROOT'] . "/aspengroup.online"; 
    define("DOCUMENT_ROOT",$documentRoot); // local file system root: /Users/lpadan/Software/aspengroup
} else {
    $root = "https://aspengroup.online";
    define("ROOT", $root);
    $bareRoot = "https://aspengroup.online";
    define("BARE_ROOT", $bareRoot);
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    define("DOCUMENT_ROOT",$documentRoot); // webserver file system root: public_html
}

$roles = $_SESSION['roles'];
$fullName = $_SESSION['full_name'];
$projects = $_SESSION['assigned_projects'];
$reservations = $_SESSION['reservations'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    
    <!-- <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
    
    <title>Aspen Group Online</title>
    <link rel="shortcut icon" href="img/ag_favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/addons/datatables.min.css" rel="stylesheet">
    <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <?php
        $filemtime = filemtime(DOCUMENT_ROOT . "/public/css/custom.css");
        echo '<link rel="stylesheet" href=' . ROOT . '/css/custom.css?' . $filemtime . '">';
    ?>
</head>

<style>

    .white-skin .navbar .navbar-nav .nav-item a {
        font-size:14px
    }

    .side-nav .collapsible-body a {
        padding-left:38px;
    }

    #menuBtn {
        margin:20px 8px 0 8px;
        padding:0;
        height:40px;
        line-height:40px;
        font-size:1em;
    }

    .modal-btn {
        background-color:#f3f3f3;
        padding:0 !important;
        color:grey !important;
        border:1px solid grey
    }

    .card {
        background-color: rgba(0, 0, 0, 0.4 );
        width:450px;
    }

    .card .card-body h2 {
        font-weight: 300
    }
</style>

<body class="fixed-sn white-skin animated slow">

<div id="container" class="view">

    <!--********************* sideBar nav ********************-->
   
    <div id="slide-out" class="side-nav sn-bg-4 fixed animated">

        <ul class="custom-scrollbar">

            <li class="logo-sn waves-effect">
                <div class="text-center" style="background-color:black;height:67px">
                    <a href="index.php" class="pl-0"><img style="padding-top:7px" src="img/ag-logo-blue-200.png"></a>
                </div>
            </li>
                
            <ul class="collapsible collapsible-accordion" style="margin-top:8px">
                    
                <?php
                
                // if ($role == 'admin' || $role == 'staff' || $role == 'investor') { 
                if (in_array('admin',$roles) || in_array('staff',$roles) || in_array('investor',$roles)) { ?>

                    <li> <!-- Image Galleries -->
                        <a class="collapsible-header waves-effect arrow-r">
                            Image Galleries<i class="fa fa-angle-down rotate-icon"></i>
                        </a>

                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a class="waves-effect " data-type="imagegalleryhome" data-filepath="imageGalleries/deerValleyCondos">Deer Valley Condos</a>
                                </li>

                            </ul>
                        </div>

                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a class="waves-effect " data-type="imagegalleryhome" data-filepath="imageGalleries/martisCamp">Martis Camp</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li> <!-- Market Data -->
                        <a class="collapsible-header waves-effect arrow-r">
                            Market Data<i class="fa fa-angle-down rotate-icon"></i>
                        </a>

                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a class="waves-effect " data-type="marketdatahome" data-id="1">Deer Valley Condo Specs</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li> <!-- Offerings -->
                        <a class="collapsible-header waves-effect arrow-r">
                            Offerings<i class="fa fa-angle-down rotate-icon"></i>
                        </a>

                        <div class="collapsible-body">
                            <ul>

                                <li>
                                    <a class="waves-effect" data-type="offeringhome" data-filepath="offerings/sommetBlancResidences">Sommet Blanc - Residences</a>
                                </li>
                            </ul>
                        </div>
                    </li> 

                    <li> <!-- Proforma Wizard -->
                        <a class="collapsible-header waves-effect">
                            Proforma Wizard
                        </a>
                    </li>

                    <li> <!-- Projects -->
                        <a class="collapsible-header waves-effect arrow-r">
                            Projects<i class="fa fa-angle-down rotate-icon"></i>
                        </a>

                        <div class="collapsible-body">
                            <ul>
                                <?php 

                                $html = '';
                                foreach ($projects as $project) { 

                                    $html .= 
                                    '<li>' .
                                        '<a class="waves-effect" data-type="projecthome" data-projectid=' . $project['id'] . ' data-foldername="' . $project['projectFolder'] . '">' . $project['name'] . '</a>' .
                                        '</li>';

                                } 
                                echo $html; ?>

                            </ul>
                        </div>
                    </li> 

                    <hr>

                <?php

                } else if (in_array('guest',$roles)) { 

                ?>
                    
                    <li> <!-- Projects -->
                        <a class="collapsible-header waves-effect arrow-r">
                            Projects<i class="fa fa-angle-down rotate-icon"></i>
                        </a>

                        <div class="collapsible-body">
                            <ul>
                                <?php 

                                $html = '';
                                foreach ($projects as $project) { 

                                    $html .= 
                                    '<li>' .
                                        '<a class="waves-effect" data-type="projecthome" data-projectid=' . $project['id'] . ' data-foldername="' . $project['projectFolder'] . '">' . $project['name'] . '</a>' .
                                    '</li>';

                                } 
                                echo $html; ?>

                            </ul>
                        </div>
                    </li> <?php
                }

                if (in_array('admin',$roles)) { 
                ?>
                    <li>
                        <a class="collapsible-header waves-effect">
                            Admin
                        </a>
                    </li><?php 
                    
                } 
                
                if (sizeof($reservations)) { ?>
                    <!-- reservations -->
                    <li> 
                        <a class="collapsible-header waves-effect arrow-r">
                            Reservations<i class="fa fa-angle-down rotate-icon"></i>
                        </a>

                        <div class="collapsible-body">
                            <ul>
                                <?php 

                                $html = '';
                                foreach ($reservations as $reservation) { 
                                    if ($reservation['projectId'] == 1 || $reservation['projectId'] == 3) {
                                        $html .= 
                                    
                                            '<li>' .
                                                '<a style="line-height:20px;height:auto;padding:6px 0 6px 40px" class="waves-effect" data-type="projecthome" data-projectid=5 data-foldername="sommetBlancReservations">' . $reservation['projectName'] . '<br><i>&nbsp;&nbsp;- ' . $reservation['owner'] . '</i></a>' .
                                            '</li>';

                                    } else {
                                        $html .= 

                                        '<li>' .
                                            '<a style="line-height:20px;height:auto;padding:6px 0 6px 40px" class="waves-effect" data-type="projecthome" data-projectid=' . $reservation['projectId'] . ' data-foldername="' . $reservation['projectFolder'] . '">' . $reservation['projectName'] . '<br><i>&nbsp;&nbsp;- ' . $reservation['owner'] . '</i></a>' .
                                        '</li>';
                                    }
                                    

                                } 
                                echo $html; ?>

                            </ul>
                        </div>
                    </li><?php 
                } ?>

                <!-- <li>
                    <a class="collapsible-header waves-effect arrow-r">
                        <i class="w-fa fas fa-user"></i><?=$fullName?><i class="fas fa-angle-down rotate-icon"></i>
                        <i class="w-fa fas fa-user"></i>Profile<i class="fas fa-angle-down rotate-icon"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a class="waves-effect" data-toggle="modal" data-target="#changePasswordModal">Change Password</a>
                            </li>
                            <li>
                                <a id="logout" class="waves-effect">Logout</a>
                            </li>
            
                        </ul>
                    </div>
                </li> -->

            </ul>
        </ul>
          
        <!-- <div class="sidenav-bg mask-strong"></div> -->
        <div class="mask-strong sidenav-bg"></div>
    </div>
    
    <!--******************* snow div *********************-->
    <div class="snow wow fadeIn animated slow" count="1000"></div>

    <!--*********************** topBar nav *****************************-->

    <main id="main" class="animated faster" >
        <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav navbar-dark">

          <!-- SideNav slide-out button -->
          <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i style="color:white" class="fas fa-bars"></i></a>
          </div>

          <div class="breadcrumb-dn mr-auto " style="max-width:100%;justify-content:space-between;">
            <p id="breadcrumb_name">
                <span style="color:white" class="h3">Dashboard</span>
            </p>

          </div>

        </nav>
    </main>
    <!--**************************************************************-->

</div>

<?php include('modals.html')?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/addons/datatables.min.js"></script>
<script src="js/shader.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.24/sorting/datetime-moment.js"></script>

<?php
    $filemtime = filemtime(DOCUMENT_ROOT . "/public/js/custom.js");
    echo '<script src=' . ROOT . '/js/custom.js?' . $filemtime . '"></script>'; 
?>


</body>

</html>
