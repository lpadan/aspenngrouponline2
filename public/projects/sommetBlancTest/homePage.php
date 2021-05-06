<?php

// Sommet Blanc Reservations

session_start();
$_SESSION['projectId'] = $_GET['id'];

include('config.php');
$customLogo = $customConfig['logo'];

$lines = explode( "\n", file_get_contents( 'folder_config.csv' ) );
$headers = str_getcsv(array_shift($lines) );
$folderConfig = [];

// create an ** associative array ** of image folder arrays from csv file
// folderConfig['architectural/renderings'] = array('tabs'=>0,'border'=>1,'containerWidth=>200',....)
foreach($lines as $line) { 
	$lineArray = str_getcsv($line);
	$folderConfig[$lineArray[0]] = [];
	$index = 0;
	foreach($lineArray as $key => $value) {
		if ($index != 0) { // skip 'architectural/renderings' in position 0
			$folderConfig[$lineArray[0]][$headers[$key]] = $value;
		}
		$index ++;
	}
}
include("../../imageMaker/display_page.php");
?>