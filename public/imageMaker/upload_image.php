<?php
header("Access-Control-Allow-Origin: *");
$imageId = $_POST['imageId'];
$imageString = $_POST['imageString'];
$folderPath = $_POST['folderPath'];
$root = $_SERVER['DOCUMENT_ROOT'];
$fullPath = $root . "/" . $folderPath;

// get image extension (jpg or png) from data URI
preg_match('/data:image\/([\w]+)/',$imageString,$matches);
$ext = $matches[1];
if ($ext === 'jpeg') $ext = 'jpg';

// this will receive a base64 string and convert it into an image file
file_put_contents($fullPath . "/image" . $imageId . "." . $ext, file_get_contents($imageString));
$imageData = [$imageId,$ext];

echo json_encode($imageData);
?>
