<?php

$sheetName = $_GET['sheetName'];
$critical = $_GET['critical'];
$incomplete = $_GET['incomplete'];

require_once('../../private/initialize.php');
require_once('../vendor/autoload.php');
putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setSubject('lpadan@aspengroupusa.com');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

$spreadsheetId = $_SESSION['spreadsheetId'];

// get all sheet data
// use just $sheetName to get all sheet data, otherwise specifiy a more definitive range, e.g. sheetName!A1:B10
$range = $sheetName;
$response = $service->spreadsheets_values->get($spreadsheetId, $range); 
$values = $response->getValues();

// get sheetId for $sheetName
$sheets = [];
$response = $service->spreadsheets->get($spreadsheetId);
foreach($response->getSheets() as $sheet) {
    $name = $sheet['properties']['title'];
    if ($name == $sheetName) {
        $sheetId = $sheet['properties']['sheetId'];
        break;
    }
}

// get developer metadata for sheetId - NOTE: not using at this time
// useful to set the column widths, or <th> or <td> justification
// $response = $service->spreadsheets_developerMetadata->get($spreadsheetId,$sheetId);
// $metadata = $response['metadataValue'];
// $data = json_decode($response['metadataValue'],true);
// $colData = $data['colConfig'];

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

// ADD
// create a js array of objects to insert below in columnDefs

?>

<style>

	.dt-head-left {
		text-align:left;
	}

	table.dataTable  {
		white-space: nowrap;
		overflow-x:scroll;
	}

	#scheduleTable_filter {
		display:none;
	}

</style>

<div>
	
	<table id="scheduleTable" class="table table-striped">
		<thead  class="default-color white-text">
			<tr>
				<?php
				$html = '';
				for ($i = 0; $i < sizeof($values[0]); $i++) {
					$html .= "<th>{$values[0][$i]}</th>";
				} 
				echo $html;
				?>
			</tr>
		</thead>

		<tbody>
			<?php 
			$html = '';
			for ($i = 1; $i < sizeof($values); $i++) {
				if ($values[$i][17] > 0 && $critical == 'true') continue;
				if ($values[$i][7] > 0 && $incomplete == 'true') continue;	
				$html .= "<tr>";
				for ($j = 0; $j < sizeof($values[0]); $j++) {
					if (!isset($values[$i][$j])) {
						$html .= "<td></td>";
					} else {
						$html .= "<td>{$values[$i][$j]}</td>";
					}
				}			
				$html .= "</tr>";
			}
			echo $html; ?>
		</tbody>
	</table>

</div>

<script>

$(document).ready(function () {

	// https://datatables.net/blog/2014-12-18
	// plugin that converts other date formats in the table to ISO 8601 YYYY-DD-MM so they can be sorted
	// the plugin itself is loaded in index.php. I couldn't get it to work when loading it here for some reason.
	// I had a hard time getting this to work, and believe it was due to a caching issue with DataTables itself
	// no other explanation for it. console.log statements continued to log, even after the lines were commented
	// so something weird is/was going on
	$.fn.dataTable.moment('MMM DD, YYYY'); 

	var scheduleTable = $('#scheduleTable').DataTable (
		{
			destroy:true,
			autowidth:false,
			scrollX: true,
			scrollY:550,
			paging:false,
			searching:true,
			columnDefs:[
				{targets:[3,7,17],className:"text-center"},
				{targets:[0,4,5,6,8,11,12,15,16,18],visible:false},
			],
			order: [[13,'asc']]
		}
	);

	$('#scheduleTableSearch').keyup(function(){
		scheduleTable.search($(this).val()).draw();
	});


	//columnDefs: [
		// 	{
		// 		className:"text-left", "targets": [2,5,6,7]
		// 	},{
		// 		className:"text-center","targets":[1,3,4]
		// 	},{
		// 		className:"text-right", "targets":['_all']
		// 	},{
		// 		className:"dt-head-left","targets":[1,2,5,6,7]
		// 	}, 
		// 	{
		// 		targets: [11],
		// 		visible: false,
		// 		searchable: false
		// 	}
		// ]
		
		// columnDefs: [
		// 	{targets: [11],visible:false},
		// 	{targets:[1],width:'100px'}
	// ]

});



</script>



