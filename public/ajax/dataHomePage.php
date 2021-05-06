<?php

// returns data home page with pulldown for tab names

require_once('../../private/initialize.php');
$projectId = $_SESSION['projectId'];
$query = "SELECT * from spreadsheets where project_id = $projectId AND name != 'Schedules' ORDER BY name ASC";
$spreadsheets = Spreadsheet::find_by_sql($query);

//$spreadsheetId = $project->$temp;
//$_SESSION['databaseSpreadsheetId'] = $spreadsheetId;

// $sheets = array();
// putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');

// $client = new Google_Client();
// $client->useApplicationDefaultCredentials();
// $client->setSubject('lpadan@aspengroupusa.com');
// $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
// $service = new Google_Service_Sheets($client);

// $response = $service->spreadsheets->get($spreadsheetId);
// foreach($response->getSheets() as $s) {
//     $sheets[] = $s['properties']['title'];
// }

?>



<div class="row" style="padding:0 3%;margin:10px 0">
	<h2>Project Data</h2><h2 id="reportTitle"><h2>
</div>

<div class="row" style="padding:0 3%;margin:10px 0">
	
	<div style="margin-right:20px">
	
	<?php

		$html = '
			<select id="spreadsheetSelect" class="mdb-select colorful-select dropdown-primary" data-visible-options="10" style="margin-bottom:-10px;width:auto">
			<option disabled value="" selected>Choose Category</option>';

		for ($i = 0; $i < sizeof($spreadsheets); $i++) {
			$html .= "<option value='" . $spreadsheets[$i]->google_id . "'>{$spreadsheets[$i]->name}</option>";
		}
		$html .= "</select></div>";
		echo $html;
	?>

		<div style="min-width:210px">
			<select id="sheetSelect" class="mdb-select colorful-select dropdown-primary" data-visible-options="10" style="margin-bottom:-10px;width:auto">
				<option disabled value="" selected>Select Report</option>
			</select>
		</div>

		<div style="margin-left:20px;margin-right:20px">
			<button id="getReportData" type="button" class="btn btn-primary btn-sm">Get Report</button>
		</div>

		<div style="margin:8px 0 0 0">
			<span>Search </span><input id="reportsTableSearch" type="text" style="width:150px;padding:0 8px">
		</div>
	</div>

</div>

<script>

	$(document).ready(function() {
		
		$('.mdb-select').materialSelect();

	});

</script>

