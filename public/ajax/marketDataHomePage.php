<?php

// generic market data file
// send spreadsheetName as GET variable
// display a top bar with "Market Data"


$id = $_GET['id'];

require_once('../../private/initialize.php');
//require_once('../../private/initializeBeforeLogin.php');
require_once('../vendor/autoload.php');

$marketData = MarketData::find_by_id($id);
$title = $marketData->name;

if (!$marketData) {
	echo "<h2 style='padding:0 3%;margin:10px'>Project Data Spreadsheet was not found</h2>";
	exit;
}
$spreadsheetId = $marketData->google_ss_id;
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

<div>    
    
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav navbar-dark">

        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i style="color:white" class="fas fa-bars"></i></a>
        </div>

        <div class="breadcrumb-dn mr-auto">
        <!-- <div class="breadcrumb-dn" style="margin-right:30px"> -->
            <p id="breadcrumb_name">
                <span style="color:white" class="h3"><?php echo $title; ?></span>
            </p>
        </div>

		<div>
			<div id="page_body" class="page-body">
				<div id="page_body_header" style="margin-top:100px">
					
					<div style="margin-right:auto;margin-left:20px">

						<div class="row" style="padding:0 3%;margin:10px 0">
							<h2>Project Data</h2><h2 id="projectDataTitle"><h2>
						</div>

						<div class="row" style="padding:0 3%;margin:10px 0">
							
							<!-- <h2 style="margin-right:20px">Schedules</h2> -->

							<div style="min-width:210px">
								
								<?php
									$html = '';
									$html .= '
										<select id="projectSelect" class="mdb-select colorful-select dropdown-primary" data-visible-options="10" style="margin-bottom:-10px;width:auto">
										<option disabled value="" selected>Select Project</option>';

									for ($i = 0; $i < sizeof($sheets); $i++) {
										if (substr($sheets[$i], -1) == '!') continue;
										$html .= "<option value='" . $sheets[$i] . "'>{$sheets[$i]}</option>";
									}

									$html .= "</select></div>";

									$html .= 
											'
											<div style="margin:0 20px">
												<button id="getProjectData" type="button" class="btn btn-primary btn-sm">Get Data</button>
											</div>';

									echo $html;?>
								

							<div style="margin:8px 0 0 0">
								<span>Search </span><input id="projectDataTableSearch" type="text" style="width:150px;padding:0 8px">
							</div>
						</div>
				
					</div>

				</div>

				<div id="page_body_content"></div>
			</div>
		</div>

	</nav>
	<input id="fullscreen" value="true" hidden>
</div>

<script>

	$(document).ready(function() {
		$('.mdb-select').materialSelect();
		//$('#select-options-projectSelect').css('max-height','300px');

	});
</script>


