<?php
// check if valid directory OR files in directory
header("Access-Control-Allow-Origin: *");
$folderPath = $_GET['folderPath'];
$root = $_SERVER['DOCUMENT_ROOT'];

if ($_SERVER['SERVER_ADDR'] == "::1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1") {
	$root .= "/aspengroup"; 
}
$fullPath = $root . "/" . $folderPath;
$data = [];
$data['folderPath'] = $folderPath;

if (!is_dir($fullPath)) {
	$data['success'] = false;
	$data['isDirectory'] = false;
	echo json_encode($data);
} elseif(!dir_is_empty($fullPath)) {
	$data['success'] = false;
	$data['isDirectory'] = true;
	$data['containsFiles'] = true;
	echo json_encode($data);
} else {
	$data['success'] = true;
	echo json_encode($data);
}


function dir_is_empty($fullPath) {
  $handle = opendir($fullPath);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      closedir($handle);
      return FALSE;
    }
  }
  closedir($handle);
  return TRUE;
}