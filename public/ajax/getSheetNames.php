<?php

// returns Magic Viewer sheet names for a given spreadsheetId

require_once('../../private/initialize.php');
require_once('../vendor/autoload.php');

$spreadsheetId = $_GET['googleId'];
//$spreadsheetId = "1ZUT8Nw8AsaKpFE475i2crH8u95HuzuPLmNBjnD0EFo0";
$sheets = array();
putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setSubject('lpadan@aspengroupusa.com');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

// returns all of the sheet names in a spreadsheet
// $response = $service->spreadsheets->get($spreadsheetId);
// foreach($response->getSheets() as $s) {
//     $sheets[] = $s['properties']['title'];
// }
// sort($sheets);
// echo json_encode($sheets); // returns all sheet names from the spreadsheet


// returns only the Magic Viewer registered sheet names in a spreadsheet
$postBody = new Google_Service_Sheets_SearchDeveloperMetadataRequest;
$postBody->setDataFilters(["developerMetadataLookup"=>["metadataKey"=>"sheetConfig"]]); // uses Magic Viewer's metadataKey = "sheetConfig"
$data = [];

try {
	$metaData = $service->spreadsheets_developerMetadata->search($spreadsheetId,$postBody);
} catch (Exception $e) {
    $data['success'] = false;
    $data['errorMessage'] = 'Could not retrieve spreadsheet configuration data.'; // or $e->getMessage()
    echo json_encode($data);
    exit;
}

$sheetNameArray = [];
$data = [];
$tidy = tidyMatched($metaData);

if (sizeof($tidy) == 0) {
    $data['success'] = false;
    $data['errorMessage'] = "No spreadsheet data was found";
    echo json_encode($data);
    exit;
}

for ($i = 0; $i < sizeof($tidy); $i++) {
    $temp = $tidy[$i]['value']['sheetName'];
    $sheetNameArray[] = $temp;
}

sort($sheetNameArray);
$data['success'] = true;
$data['sheetNames'] = $sheetNameArray;
echo json_encode($data);



function tidyMatched ($matched) {
    if (!$matched || !$matched['matchedDeveloperMetadata']) return [];

    return array_map(function($d) {
    	$dm = $d['developerMetadata'];
    	$v = json_decode($dm['metadataValue'],true);
    	return [
            'id'=>$dm['metadataId'],
            'key'=>$dm['metadataKey'],
            'visibility'=>$dm['visibility'],
            'value'=>$v,
            'location'=>$dm['location'],
            'locationType'=>$dm['locationType']
        ];
    },$matched['matchedDeveloperMetadata']);
}


?>