<?php

// ADD
// determine from $_GET if this is called from a spreadsheet with the word "Schedules" in it
// if so, then display incomplete and critical path check boxes next to the select drop down
// also hide pre-specified columns for schedules

$sheetName = $_GET['sheetName'];
$spreadsheetId = $_GET['spreadsheetId'];
require_once('../../private/initialize.php');
require_once('../vendor/autoload.php');
putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setSubject('lpadan@aspengroupusa.com');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

// get all sheet data
// use just $sheetName to get all sheet data, otherwise specifiy a more definitive range, e.g. sheetName!A1:B10
$response = $service->spreadsheets_values->get($spreadsheetId, $sheetName); 
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

// get developer metadata for sheetId
$response = $service->spreadsheets_developerMetadata->get($spreadsheetId,$sheetId);
$metadata = $response['metadataValue'];
//$data = json_decode($response['metadataValue'],true);
//$colData = $data['colConfig'];

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

	#reportsTable_filter {
		display:none;
	}
	
</style>

<div>
	
	<table id="reportsTable" class="table table-striped">
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

var columnDefs = [];
var sheetName = "<?php echo $sheetName;?>";
var metadata = <?php echo $metadata;?>; // returns array of objects
var colConfigData = metadata['colConfig'];

if (sheetName == "Reservations") {
	columnDefs = [
		{targets:[0,2,9,10,11,12],visible:false}
	]
}

// add search to bottom of every column
// https://datatables.net/examples/api/multi_filter.html

// and this
// https://datatables.net/reference/api/column().search()

var reportsTable = $('#reportsTable').DataTable ({
	destroy:true,
	autowidth:true,
	scrollX: true,
	scrollY:550,
	paging:false,
	searching:true,
	columnDefs:columnDefs
});

if (sheetName == 'Reservations') {
	// remove rows where col 1 = '999'
	reportsTable
		.rows(function (idx, data, node) {
	        return data[1] == '999';
	    })
	    .remove()
	    .draw();
}

$('#reportsTableSearch').keyup(function(){
	reportsTable.search($(this).val()).draw();
});

</script>



