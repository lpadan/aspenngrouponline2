<?php

header("Access-Control-Allow-Origin: *");
$data = [];

$allowedPaths = [
	'sommetblanc',
	'parkcity'
];

// TESTING
// $_POST['keepFolder'] = 'no';
// $_POST['folderPath'] = "parkcity/data";

$keepFolder = $_POST['keepFolder'];
$folderPath = $_POST['folderPath'];
$folderPath = trim($folderPath,'/');
$rootFolderPath = "../" . $folderPath;

if (!$folderPath) {
	$data['success'] = false;
	$data['errorMessage'] = 'A folder path was not provided';
	echo json_encode($data);
	exit;
}

if (!is_dir($rootFolderPath)) {
	$data['success'] = false;
	$data['errorMessage'] = 'The folder<br><span style="display:block;margin:7px 10px 7px 0;overflow-wrap:break-word;color:#4285f4"><em><strong>' . $folderPath . '</strong></em></span>could not be found on the server.';
	echo json_encode($data);
	exit;
}

$explodedPath = explode("/", $folderPath);

if (sizeof($explodedPath) < 3) {
	$data['success'] = false;
	$data['errorMessage'] = "The provided folder path is not authorized for deletion.";
	echo json_encode($data);
	exit;
}

$first = $explodedPath[0];
$second = $explodedPath[1];

if (!in_array($explodedPath[0],$allowedPaths)) {
	$data['success'] = false;
	$data['errorMessage'] = "The provided folder path is not authorized for deletion.";
	echo json_encode($data);
	exit;
}

if ($keepFolder == 'yes') {
	$files = array_diff(scandir($rootFolderPath), array('.','..'));
	foreach ($files as $file) {
		(is_dir("$rootFolderPath/$file")) ? recurseRmdir("$rootFolderPath/$file") : unlink("$rootFolderPath/$file");
	}
	$data['success'] = true;
	$data['message'] = "All Contents of the folder were successfully deleted.";
	echo json_encode($data);
	exit;

} elseif ($keepFolder == 'no') {
	
	recurseRmdir($rootFolderPath);
	
	// find path to folder_config.csv, either first or second folder down
	$folderConfigPath = '../' . $explodedPath[0];
	for ($i = 1; $i < sizeof($explodedPath); $i++) {
		if (is_file($folderConfigPath . "/folder_config.csv")) break;
		$folderConfigPath .= "/" . $explodedPath[$i];
	}
	$folderConfigPath .= "/folder_config.csv";

	// determine path to delete from csv file e.g. design/landscape from sommetblanc/salesgallery/design/landscape
	// depends on if the folder_config.csv file is in sommetblanc or in salesgallery
	$tempPath = $explodedPath[$i];
	for ($j = $i+1; $j < sizeof($explodedPath); $j++) {
		$tempPath .= "/" . $explodedPath[$j];
	}

	// remove the entry in the csv file if csv file found and entry exists
	// folder_config.csv could be in either the "first" or "second" folder down from the root e.g. sommetblanc/salesgallery/folder_config.csv
	// OR if found in the first folder e.g. parkcity/folder_config.csv
	if (is_file($folderConfigPath)) {
		$fileHandle = fopen($folderConfigPath,'r');
		$new = '';
		while (!feof($fileHandle)) {
		    $line_of_text = fgetcsv($fileHandle, 1024);    
		    if ($tempPath != $line_of_text[0]) {
		         $new .= implode(',',$line_of_text) . PHP_EOL;
		    }
		}
		file_put_contents($folderConfigPath,$new);
	}

	$data['success'] = true;
	$data['message'] = "The specified folder was successfully deleted.";
	echo json_encode($data);
	exit;
}

function recurseRmdir($dir) {
	$files = array_diff(scandir($dir), array('.','..'));
	foreach ($files as $file) {
		(is_dir("$dir/$file")) ? recurseRmdir("$dir/$file") : unlink("$dir/$file");
	}
	return rmdir($dir);
}