<?php

include('../private/initializeBeforeLogin.php'); // does not use a session

// config
$projectId = 5;
$subFolders = ['construction','floorPlans','videos'];

$project = Project::find_by_id($projectId);
$path = "projects/" . $project->folder_name . "/_units";

$query = "SELECT * from units where project_id = $projectId";
$units = Unit::find_by_sql($query);

foreach ($units as $unit) {
	$name = strtolower($unit->name);

	if (!file_exists($path . "/" . $name)) {
	    mkdir($path . "/" . $name);
	}

	for ($i = 0; $i < sizeof($subFolders); $i++) {
		if (!file_exists($path . "/" . $name . "/" . $subFolders[$i])) {
			mkdir($path . "/" . $name . "/" . $subFolders[$i]);
		}
	}
}

