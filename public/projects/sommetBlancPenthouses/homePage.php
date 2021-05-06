<?php

$projectId = $_GET['id'];
require_once('../../../private/initialize.php');
$_SESSION['projectId'] = $projectId;
$project = Project::find_by_id($projectId);
$projectName = $project->name;
$projectFolderName = $project->folder_name;

$data['projectName'] = $projectName;
$data['projectFolderName'] = $projectFolderName;
$data['projectId'] = $projectId;

?>

<header>    
    
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav navbar-dark">

        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i style="color:white" class="fas fa-bars"></i></a>
        </div>

        <div class="breadcrumb-dn mr-auto">
            <p id="breadcrumb_name">
                <span style="color:white" class="h3"><?php echo $projectName;?></span>
            </p>
        </div>

        <div class="d-flex change-mode">

        	<ul class="nav navbar-nav nav-flex-icons ml-auto" style="color:white">

        		<!-- pull down -->
                <!-- <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data</a>
			  
			        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
			        	<a href="#" class="dropdown-item" data-type="database" data-databasename="' . $value . '">Marketing</a>
			        	<a href="#" class="dropdown-item" data-type="database" data-databasename="' . $value . '">Master</a>
			        	<a href="#" class="dropdown-item" data-type="database" data-databasename="' . $value . '">Sales</a>
			        </div>
			    </li> -->

			    <!-- single menu -->

			    
				<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='design'>Design</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='documents'>Documents</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='images'>Images</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='reports'>Reports</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='schedules'>Schedules</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='units'>Units</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='webcam'>Webcam</a>
		     	</li>

            </ul>

      </div>

    </nav>

</header>

<div style="margin-top:0">
	<div id="page_body">
		<div id="page_body_header"></div>
		<div id="page_body_content"></div>
	</div>
</div>

<style>
	.page-body {
		background-image:url("<?php echo ROOT . "/projects/sommetBlancSalesGallery/sommetBlanc-2200.jpg";?>");
	}
</style>

<script src="js/mdb.min.js"></script>

<script>
	$(".button-collapse").sideNav();
	var projectData = <?php echo json_encode($data);?>
</script>











