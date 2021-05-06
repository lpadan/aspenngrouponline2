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

        <div class="breadcrumb-dn" style="margin-right:30px">
            <p id="breadcrumb_name" style="margin-top:5px">
                <span style="color:white" class="h4">SOMMET BLANC</span>
            </p>
        </div>

        <div style="margin-right:30px">

        	<ul class="nav navbar-nav nav-flex-icons" style="color:white;margin-left:20px">

        		<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='ajax/data'>Data</a>
		     	</li>

				<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='design'>Design</a>
		     	</li>

		     	<!-- <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Documents</a>
			        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
			        	<a href="#" class="dropdown-item" data-type="projectmenu" data-filename='documents' data-foldername="hoa">HOA</a>
			        	<a href="#" class="dropdown-item" data-type="projectmenu" data-filename='documents' data-foldername="sellerdisclosures">Seller Disclosures</a>
			        </div>
			    </li> -->

			    <li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='ajax/documents'>Documents</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='marketing'>Marketing</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='pricing'>Pricing</a>
		     	</li>

		     	<li class="nav-item">
			        <a class="nav-link" data-type="projectmenu" data-filename='ajax/schedules'>Schedules</a>
		     	</li>

		     	<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Units</a>
			        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
			        	<a href="#" class="dropdown-item" data-type="projectmenu" data-filename='unitspecs'>Data</a>
			        	<a href="#" class="dropdown-item" data-type="projectmenu" data-filename='selectunit' >Select Unit</a>
			        </div>
			    </li>

            </ul>

      </div>

    </nav>

</header>

<div style="margin-top:0">
	<div id="page_body" class="page-body">
		<div id="page_body_header"></div>
		<div id="page_body_content"></div>
	</div>
</div>

<style>
	.page-body {
		background-image:url("<?php echo ROOT . "/projects/sommetBlancResidences/images/sommetBlanc-2200.jpg";?>");
	}
</style>

<script src="js/mdb.min.js"></script>

<script>
	$(".button-collapse").sideNav();
	var projectData = <?php echo json_encode($data);?>
</script>













