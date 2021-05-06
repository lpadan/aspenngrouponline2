<?php
require_once('../../private/initialize.php');
require_once('../vendor/autoload.php');
putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setSubject('lpadan@aspengroupusa.com');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

$spreadsheetId = "1ZUT8Nw8AsaKpFE475i2crH8u95HuzuPLmNBjnD0EFo0";
$sheetId = "1075852709"; // Miscellaneous
//$sheetId = "570085363"; // pricing study

// get sheetId from sheetName
$sheetName = "Miscellaneous";$response = $service->spreadsheets->get($spreadsheetId);
foreach($response->getSheets() as $sheet) {
    $name = $sheet['properties']['title'];
    if ($name == $sheetName) {
        $sheetId = $sheet['properties']['sheetId'];
        break;
    }
}
echo $sheetId;

// get developer metadata
$response = $service->spreadsheets_developerMetadata->get($spreadsheetId,$sheetId);
$data = json_decode($response['metadataValue'],true);
$colData = $data['colConfig'];
echo "<pre>";
print_r($colData);


// TEST to get sheet values and developerMetadata in one call.
// This returns sheets data, but I don't see that it returns "values"...not sure what Grid Data is 
// seems to be everything about the sheet, and the values are there but in a weird presentation

// $response = $service->spreadsheets->get($spreadsheetId,array('ranges'=>'Miscellaneous!A1:B10','includeGridData'=>true));
// $sheets = $response->getSheets();
// echo "<pre>" . print_r($sheets);
// exit;


// developer metadata returns an array. First column is array element [0]

// Array
// (
//     [0] => Array
//         (
//             [colName] => Description
//             [type] => standard
//             [pullDown] => Array
//                 (
//                 )

//             [width] => 237
//             [align] => general-left
//             [format] => 
//             [headerAlign] => general-left
//             [wrapStrategy] => OVERFLOW
//         )

//     [1] => Array
//         (
//             [colName] => Value
//             [type] => standard
//             [pullDown] => Array
//                 (
//                 )

//             [width] => 296
//             [align] => general-left
//             [format] => 
//             [headerAlign] => general-left
//             [wrapStrategy] => CLIP
//         )

// )