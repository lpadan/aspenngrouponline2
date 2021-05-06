<?php

// return schedule home page with pulldown for tab names

require_once('../../private/initialize.php');
require_once('../vendor/autoload.php');

$projectId = $_SESSION['projectId'];
$query = "SELECT * from spreadsheets WHERE project_id = $projectId AND name = 'Schedules'";
$spreadsheet = Spreadsheet::find_by_sql($query);
if (!$spreadsheet) {
	echo "<h2 style='padding:0 3%;margin:10px'>Schedule Spreadsheet was not found</h2>";
	exit;
}
$spreadsheetId = $spreadsheet[0]->google_id;
$_SESSION['spreadsheetId'] = $spreadsheetId;
$sheets = array();
putenv('GOOGLE_APPLICATION_CREDENTIALS=../aspen-group-google-client.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setSubject('lpadan@aspengroupusa.com');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

$response = $service->spreadsheets->get($spreadsheetId);
foreach($response->getSheets() as $s) {
    $sheets[] = $s['properties']['title'];
}

?>

<div class="row" style="padding:0 3%;margin:10px 0">
	<h2>Schedules</h2><h2 id="scheduleTitle"><h2>
</div>

<div class="row" style="padding:0 3%;margin:10px 0">
	
	<!-- <h2 style="margin-right:20px">Schedules</h2> -->

	<div style="min-width:210px">
		
		<?php
			$html = '';
			$html .= '
				<select id="scheduleSelect" class="mdb-select colorful-select dropdown-primary" data-visible-options="10" style="margin-bottom:-10px;width:auto">
				<option disabled value="" selected>Select Schedule</option>';

			for ($i = 0; $i < sizeof($sheets); $i++) {
				if (substr($sheets[$i], -1) == '!') continue;
				$html .= "<option value='" . $sheets[$i] . "'>{$sheets[$i]}</option>";
			}

			$html .= "</select></div>";

			$html .= 
					'<div class="form-check" style="margin:10px 0 0 20px">
					    <input type="checkbox" class="form-check-input" id="scheduleIncomplete" value="incomplete" checked>
					    <label style="padding-left:25px" class="form-check-label" for="scheduleIncomplete">Incomplete</label>
					</div>

					<div class="form-check" style="margin-top:10px">
					    <input type="checkbox" class="form-check-input" id="scheduleCritical" value="critical">
					    <label style="padding-left:25px" class="form-check-label" for="scheduleCritical">Critical</label>
					</div>

					<div style="margin:0 20px">
						<button id="getSchedule" type="button" class="btn btn-primary btn-sm">Get Schedule</button>
					</div>';

			echo $html;?>
		

	<div style="margin:8px 0 0 0">
		<span>Search </span><input id="scheduleTableSearch" type="text" style="width:150px;padding:0 8px">
	</div>

</div>


<script>

	$(document).ready(function() {
		$('.mdb-select').materialSelect();
	});
</script>

