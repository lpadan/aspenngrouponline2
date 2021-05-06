<?php

$sheetName = $_GET['sheetName'];
// require_once('../../private/initializeBeforeLogin.php');
require_once('../../private/initialize.php');
require_once('../vendor/autoload.php');
putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');
$spreadsheetId = $_SESSION['spreadsheetId'];
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setSubject('lpadan@aspengroupusa.com');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

// get all sheet data
// use just $sheetName to get all sheet data, otherwise specifiy a more definitive range, e.g. sheetName!A1:B10
$response = $service->spreadsheets_values->get($spreadsheetId, $sheetName); 
$values = $response->getValues();

$avgSF = $values[2][1];
$medianSF = $values[3][1];
$grossSF = $values[2][3];
$totalUnits = $values[3][3];
$values = array_splice($values,5); // remove first 5 rows

?>

<style>

	.dt-head-left {
		text-align:left;
	}

	table.dataTable  {
		white-space: nowrap;
		overflow-x:scroll;
	}

	#projectDataTable_filter {
		display:none;
	}

	#statsTableDiv {
		width:600px;
		background-color:#f3f3f3;
		margin:20px 0;
	}

	#statsTable td {
		padding:3px 10px;
		font-size:1.2rem;
	}

	
</style>

<div>

	<div id="statsTableDiv">
		<table id="statsTable">
			<tr>
				<td>Average Square Feet:</td>
				<td style="text-align:right"><?php echo $avgSF;?></td>
			</tr>

			<tr>
				<td>Median Square Feet:</td>
				<td style="text-align:right"><?php echo $medianSF;?></td>
			</tr>

			<tr>
				<td>Gross Square Feet:</td>
				<td style="text-align:right"><?php echo $grossSF;?></td>
			</tr>

			<tr>
				<td>Total Units:</td>
				<td style="text-align:right"><?php echo $totalUnits;?></td>
			</tr>
		</table>
	</div>
	
	<table id="projectDataTable" class="table table-striped" style="min-width:600px">
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

var columnDefs = [{targets:['_all'],className:"text-center"},];

var projectDataTable = $('#projectDataTable').DataTable ({
	destroy:true,
	autowidth:true,
	scrollX: true,
	scrollY:400,
	paging:false,
	searching:true,
	columnDefs:columnDefs,
	order: [[0, "asc" ]]
});


$('#projectDataTableSearch').keyup(function(){
	projectDataTable.search($(this).val()).draw();
});

</script>



