<?php

$data = [];
$folderPath = $_GET['folderPath'];
$root = $_SERVER['DOCUMENT_ROOT'];
$fullPath = $root . "/" . $folderPath;
if (!is_dir($fullPath)) {
	$data['success'] = false;
	$data['errorMessage'] = "The provided path is not a valid directory";
	echo json_encode($data);
	exit;
}

$files = glob($fullPath . "/*{jpg,jpeg,png}",GLOB_BRACE); // list of file paths that end in JPG, JPEG or PNG

if (!$files) {
	$data['success'] = false;
	$data['errorMessage'] = "No image files were found";
	echo json_encode($data);
	exit;
}

$fileNames = [];

foreach($files as $file) {
	$pathParts = pathinfo($file);
	$fileName = $pathParts['basename'];
	$fileNames[] = $fileName;
}

$fileNames = advancedSort($fileNames,$folderPath);
$data['success'] = true;
$data['fileNames'] = $fileNames;
echo json_encode($data);

function advancedSort($fileNames,$folderPath) {

	// sorts file names that may or may not end in digits, and the names may or may not be the same
	// if name does not end in digits, then sort by name, else sort by digits.

	$newArray = [];
	
	foreach ($fileNames as $name) {
		$digitsOnly = '';
		$portionToRemove = '';
		$extension = '';

		$pathParts = pathinfo($name);
		$fileName = $pathParts['filename'];
		$ext = $pathParts['extension'];

	    preg_match('/(?![-|_])[0-9]+/',$fileName,$matches);
	    if ($matches) $digitsOnly = $matches[0];
		preg_match('/[0-9]+/',$fileName,$matches);
		if ($matches) $portionToRemove = $matches[0];
		$newName = str_replace($portionToRemove,'',$fileName); // get the values that precede the digits, if digits exist

	    $temp = [$newName, $digitsOnly, $ext];
	    $new2dArray[] = $temp;
	}

	usort($new2dArray,'fileNameCompare');
	$finalArray = [];
	
	foreach($new2dArray as $value) {
		$tempName = $value[0];
		$tempDigits = $value[1];
		$ext = $value[2];
		$fileName = $folderPath . "/" . $tempName . $tempDigits . "." . $ext;
		$finalArray[] = $fileName;
	}
	return $finalArray;
}

function fileNameCompare($array1,$array2) {
	$name1 = $array1[0];
	$digits1 = $array1[1];

	$name2 = $array2[0];
	$digits2 = $array2[1];

	if ($name1 != $name2) {
		// sort by name
		return $name1 > $name2;
	} elseif ($name1 == $name2) {
		// sort by digits
		return $digits1 > $digits2;
	}
}
