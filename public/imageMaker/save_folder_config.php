<?php

$data = [];
$csvPath = $_POST['csvPath'];
$csv = $_POST['csv'];

$csvFilePath = "../" . $csvPath . "/folder_config.csv";

if (!is_file($csvFilePath)) {
	$data['success'] = false;
	$data['errorMessage'] = 'Invalid Path';
	echo json_encode($data);
	exit;
}

if (file_put_contents("../" . $csvPath . "/folder_config.csv",$csv)) {
	$data['success'] = true;
	echo json_encode($data);
}

