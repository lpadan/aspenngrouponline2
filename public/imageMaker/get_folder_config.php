<?php

$data = [];
if (isset($_GET['csvPath']) && $_GET['csvPath']) {
	$csvPath = $_GET['csvPath'];
} else {
	$data['success'] = false;
	$data['errorMessage'] = "File path was not provided";
	echo json_encode($data);
	exit;
}

if (!is_dir("../" . $csvPath)) {
	$data['success'] = false;
	$data['errorMessage'] = "Invalid file path";
	echo json_encode($data);
	exit;
}

if (!file_exists("../" . $csvPath . "/folder_config.csv")) {
	$data['success'] = false;
	$data['errorMessage'] = 'The file "folder_config.csv" was not found';
	echo json_encode($data);
	exit;
}
$data['success'] = true;
$data['fileContents'] = file_get_contents("../" . $csvPath . "/folder_config.csv");
echo json_encode($data);
