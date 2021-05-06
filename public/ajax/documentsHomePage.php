<?php

// this file currently reads from a drive folder and returns a list of subfolders in a pulldown

// ADD
// Change. go to the database and get a list of PDF categories for the project ID
// this requires a PDF image log, and thumbnail jpg images created during file upload
// there is no carousel. click on a thumbnail and it opens the PDF in a modal or new tab

require_once('../../private/initialize.php');
require_once('../vendor/autoload.php');

//$projectId = $_SESSION['projectId'];
$projectId = 1;
$project = Project::find_by_id($projectId);
if (!$project) {
	echo "<h2 style='padding:0 3%;margin:10px'>Project was not found</h2>";
	exit;
}
$documentsFolderId = $project->documents_folder_id;

// TEST
$documentsFolderId = "1rrn9XwhxR5PoDR5xIzfyR0krLmRoijOx";

putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');


$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setSubject('lpadan@aspengroupusa.com');
$client->addScope(Google_Service_Drive::DRIVE);
$service = new Google_Service_Drive($client);
$optParams = array (
	'q' => "'$documentsFolderId' in parents and trashed=false and mimeType='application/vnd.google-apps.folder'",
	'fields' => 'files(id,name)'
);
$files = $service->files->listFiles($optParams);

$folderList = [];
foreach ($files as $file) {

	$fileId = $file->getId();
	$fileName = $file->getName();
	$temp = array($fileName,$fileId);
	$folderList[] = $temp;
}

?>
<div class="row" style="padding:0 3%;margin:10px 0">
	<h2>Documents</h2><h2 id="documentsTitle"><h2>
</div>

<div class="row" style="padding:0 3%;margin:10px 0">
	
	<!-- <h2 style="margin-right:20px">Schedules</h2> -->

	<div style="min-width:210px">
		
		<?php
			$html = '';
			$html .= '
				<select id="documentSelect" class="mdb-select colorful-select dropdown-primary" data-visible-options="10" style="margin-bottom:-10px;width:auto">
				<option disabled value="" selected>Choose Folder</option>';

	
		for ($i = 0; $i < sizeof($folderList); $i++) {
				$html .= "<option value='" . $folderList[$i][1] . "'>{$folderList[$i][0]}</option>";
			}

			$html .= "</select></div>";
			$html .= 
					'<div style="margin:0 20px">
						<button id="getDocuments" type="button" class="btn btn-primary btn-sm">Get Documents</button>
					</div>';

			echo $html;?>
		
</div>


<script>

	$(document).ready(function() {
		$('.mdb-select').materialSelect();
	});
</script>

