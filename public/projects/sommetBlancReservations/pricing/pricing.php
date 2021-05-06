<?php
include('../../private/initialize.php');
$projectId = $_SESSION['projectId'];
$project = Project::find_by_id($projectId);

$query = "SELECT * FROM units WHERE type = 'residential' AND project_id = $projectId";
$units = Unit::find_by_sql($query);
$imageFileName = "all_building_image_map.jpg";
?>

<style>

	td,tr {
		font-size:1.1em!important;
	}


	h3 {
		margin:0;
	}

	.modal-header {
		background-color:#2058a5!important
	}

	.modal-header div {
		margin-top:5px;
		float:right;
		color:white!important;
		font-size:.8em;
		text-align:center;
	}

	.modal-header h3 {
		float:left;
		margin-top:15px
	}

	.modal-header p {
		font-size:1.3em;
		margin:0;
	}

	.heading-label {
		position:absolute;
		text-align:center;
		padding:0 5px;
	}

	.heading-label p {
		margin:0;
		padding:0;
		font-size:.4vw;
		line-height:105%
	}

	.heading-label p strong {
		font-weight:700;
	}

	.heading-label h3 {
		font-size:1.6vw;
		font-weight:500
	}

	.label {
		position:absolute;
		text-align:center;
		padding:0 5px;
	}

	.label p {
		margin:0;
		padding:0;
		font-size:.4vw;
		line-height:105%
	}

	.label p strong {
		font-weight:700;
	}

	.label h3 {
		font-size:1.6vw;
		font-weight:500
	}

	.legend-box {
		position:absolute;
		text-align:center;
		min-width:7vw;
		cursor:pointer;
		z-index: 1000
	}

	.legend-box>p {
		color:black;
		font-weight:500;
	} 

	@media screen and (max-width:1200px) {
		.legend-box {
			border:.1vw solid black;
			top:87%;
		}

		.legend-box>p {
			padding:5px 15px;
			font-size:.7vw;
			margin:0;
		}
	}

	@media screen and (max-width:800px) {
		.legend-box {
			border:.1vw solid black;
			top:87%;
		}

		.legend-box>p {
			padding:4px 7px;
			font-size:1vw;
			margin:0;
		}
	}


	@media screen and (min-width:1201px) {
		.legend-box {
			border:3px solid black;
			top:87%;
		}

		.legend-box>p {
			padding:8px 25px;
			font-size:.7vw;
			margin:0;
		}
	}
	
	#image {
		z-index: 999
	}

	#mastHead {
		background-image:url('projects/sommetBlancResidences/pricing/unitImageMap-2000x400.jpg');
		height:200px;
		padding-top:20px;
	}

	.select-wrapper {
		background-color:white;
		padding:0 5px;
	}

	.select-wrapper>.caret {
		padding-right:5px;
	}
</style>

<div id='mastHead'>
	
	<div style="display:inline-block;margin-top:10px;margin-left:30px;margin-bottom:15px">
		<h2 style="display:inline-block;color:white">Unit Pricing</h2>
	</div>

	<div style="background-color:white; width:400px;margin-left:30px;padding-left:30px;padding-top:15px">
		<div class="row" style="">
			
			<div style="min-width:210px">
					
				<select id="bedroomSelect" class="mdb-select colorful-select dropdown-primary" data-visible-options="10">
						<option value="all" selected>All Bedrooms</option>
						<option value="fivebed">5 Bedroom</option>
						<option value="fourbed">4 Bedroom</option>
						<option value="threebed">3 Bedroom</option>
						<option value="twobed">2 Bedroom</option>

				</select>
			</div>

			<!-- <div class="form-check" style="margin-top:10px">
			    <input id="unitsSold" type="checkbox" class="form-check-input"  value="sold" checked>
			    <label style="padding-left:25px" class="form-check-label" for="unitsSold">Sold</label>
			</div>

			<div class="form-check" style="margin-top:10px">
			    <input id="unitsAvailable" type="checkbox" class="form-check-input" value="available">
			    <label style="padding-left:25px" class="form-check-label" for="unitsAvailable">Available</label>
			</div> -->

			<div style="margin-left:20px">
				<button id="getUnits" type="button" class="btn btn-primary btn-sm">Show Units</button>
			</div>
		</div>
	</div>

</div>

<div style="text-align:center">

	<div style="position:relative">
		<img id="image" src="projects/sommetBlancReservations/pricing/<?php echo $imageFileName;?>"  border="0" width="100%" usemap="#map" />

		<div class="heading-label" style="top:4%;left:37%">
			<h3>Alpine Villas</h3>
		</div>

		<div class="heading-label" style="top:41%;left:17%">
			<h3>Building A</h3>
		</div>

		<div class="heading-label" style="top:35%;left:55%">
			<h3>Building B</h3>
		</div>

		<div class="heading-label" style="top:30%;left:85%">
			<h3>Building C</h3>
		</div>

		<!-- legend -->
		<div class="legend-box" data-bedrooms="all" style="background-color:white;color:black;left:5%">
			<p>All bedrooms</p>
		</div>

		<div class="legend-box" data-bedrooms="fivebed" style="background-color:#76b0de;left:15%">
			<p>5 bedrooms</p>
		</div>

		<div class="legend-box" data-bedrooms="fourbed" style="background-color:#a3cae9;left:25%">
			<p>4 bedrooms</p>
		</div>

		<div class="legend-box" data-bedrooms="threebed"style="background-color:#c6dcf1;left:35%">
			<p>3 bedrooms</p>
		</div>

		<div class="legend-box" data-bedrooms="twobed" style="background-color:#e2eff8;left:45%">
			<p>2 bedrooms</p>
		</div>

		<div class="legend-box" data-bedrooms="withheld" style="cursor:default;background-color:#999;left:55%">
			<p>Withheld</p>
		</div>

	<?php

	$bedroomsArray = ['','','twobed','threebed','fourbed','fivebed'];
	$html = '';
	
	// generate map labels
	foreach ($units as $unit) {
		$unitId = $unit->id;
		$query = "SELECT * FROM image_maps WHERE unit_id = '{$unitId}' AND image_file_name = '{$imageFileName}'";
		$imageMaps = ImageMap::find_by_sql($query);
		$imageMap = $imageMaps[0];
		$labelPercentageArray = explode(',',$imageMap->label_percentages);
		$class = $bedroomsArray[$unit->bedrooms];
		$price = '$' . number_format($unit->current_price);
		//$id = str_replace("AV", "VILLA ", $unit->id);
		$id = $unit->display_name;
		$sf = number_format($unit->sf);
		$html .= 
			'<div class="label ' . $class . '" style="top:' . $labelPercentageArray[0] . '%;left:' . $labelPercentageArray[1] . '%">' .'<p><strong>' . $id . '</strong></p>' .
			'<p>' . $sf . ' SF - ' . $unit->bedrooms . 'B/' . $unit->baths . 'B';  
		if ($unit->den) {
			$html .= '/Den';
		}
		$html .= 
			'</p>' .
			'<p><strong>' . $price . '</strong></p>' .
			'</div>';
	}
	echo $html; 
	?>

	</div>

	<map name="map">

	<?php
	// generate area tags
	$html = '';
	foreach ($units as $unit) {
		$unitId = $unit->id;
		$query = "SELECT * FROM image_maps WHERE unit_id = '{$unitId}' AND image_file_name = '{$imageFileName}'";
		$imageMaps = ImageMap::find_by_sql($query);
		$imageMap = $imageMaps[0];
		$id = $unit->id;
		$bedrooms = $bedroomsArray[$unit->bedrooms];
		$coords = $imageMap->poly_coordinates;
		$unitData = json_encode([
			'id' => $id,
			'displayName' => $unit->display_name,
			'name' => $unit->name,
			'price' => '$' . number_format($unit->current_price),
			'sf' => number_format($unit->sf),
			'bedrooms' => $unit->bedrooms,
			'baths' => $unit->baths,
			'den' => $unit->den,
			'status' => $unit->status,
			'projectFolder' => $project->folder_name,
			'levels' => $unit->levels
		]);
		if ($unit->status == 'Withheld') {
			$html .= '<area data-bedrooms="' . $bedrooms . '" data-unitdata="' . htmlspecialchars($unitData) . '" data-key="' . $bedrooms . ',withheld" shape="poly" coords="' . $coords . '" href="#"/>';
		} else {
			$html .= '<area data-bedrooms="' . $bedrooms .'" data-unitdata="' . htmlspecialchars($unitData) .'" data-key="' . $bedrooms . '" shape="poly" coords="' . $coords . '" href="#"/>';
		}

		// if ($unit->status == 'Withheld') {
		// 	$html .= '<area data-status="withheld" data-bedrooms="' . $bedrooms . '" data-unitdata="' . htmlspecialchars($unitData) . '" data-key="' . $bedrooms . '" shape="poly" coords="' . $coords . '" href="#"/>';
		// } else {
		// 	$html .= '<area data-bedrooms="' . $bedrooms .'" data-unitdata="' . htmlspecialchars($unitData) .'" data-key="' . $bedrooms . '" shape="poly" coords="' . $coords . '" href="#"/>';
		// }
	}
	echo $html;
	?>
		
	</map>
</div>

<input id="fullscreen" value="true" hidden>
<script src="js/imagemapster.js"></script>

<script>

$(document).ready(function() {


	$('.legend-box').click(function() {
		var bedrooms = $(this).data('bedrooms');
		if (bedrooms == 'withheld') return;
		getUnits(bedrooms);
	});

	$('#getUnits').click(function() {
		var bedrooms = $('#bedroomSelect').val();
		getUnits(bedrooms);
	});

	$('area').click(function() {
		var html;
		var unitData = $(this).data('unitdata');
		var unitId = unitData.id;
		var levels = unitData.levels;
		var name = unitData.name;
		name = name.toLowerCase();

		if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
			var ROOT = "//localhost/aspengroup.online";
		} else {
			var ROOT = "https://aspengroup.online";
		}

		if (levels == 1) {
			var fileName800 = name + "_floorplan_main-800.jpg";
			var fileName2000 = name + "_floorplan_main-2000.jpg";
			html = 
				'<a href="' + 
				ROOT + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileName2000 + 
			 	'" target="_blank"><img src="' +  
			 	ROOT  + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileName800 + 
			 	'" style="height:100%"></a>';
		}
		
		if (levels == 3) {
			var fileNameLower800 = name + "_floorplan_lower-800.jpg";
			var fileNameLower2000 = name + "_floorplan_lower-2000.jpg";
			var fileNameMain800 = name + "_floorplan_main-800.jpg";
			var fileNameMain2000 = name + "_floorplan_main-2000.jpg";
			var fileNameUpper800 = name + "_floorplan_upper-800.jpg";
			var fileNameUpper2000 = name + "_floorplan_upper-2000.jpg";

			html =  
				'<a href="' + 
				ROOT + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileNameMain2000 + 
			 	'" target="_blank"><img src="' +  
			 	ROOT + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileNameMain800 + 
			 	'" style="height:100%"></a>';	

			html +=  
				'<a href="' + 
				ROOT + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileNameUpper2000 + 
			 	'" target="_blank"><img src="' +  
			 	ROOT + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileNameUpper800 + 
			 	'" style="height:100%"></a>';	

			html += 
				'<a href="' + 
				ROOT + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileNameLower2000 + 
			 	'" target="_blank"><img src="' +  
			 	ROOT + '/projects/' + unitData.projectFolder + '/_units/' + name + '/floorPlans/' + fileNameLower800 + 
			 	'" style="height:100%"></a>'; 	

			html += 
				'<a class="down-arrow"></a><a style="display:none" class="up-arrow"></a>';	 	
		}

		$('#unitFloorPlan').html(html);
		$('#unitModal .unit-summary').click(); // activate summary tab
		
		if (unitData.den) unitData.den = 'Yes';
		else unitData.den = 'No';
		var title = '<h3>' + unitData.displayName + '</h3>'; // +
		$('#unitModalTitle').html(title);
		$('#unitNumber').text(unitData.name);	
		$('#unitPrice').text(unitData.price);
		$('#unitStatus').text(unitData.status);	
		$('#unitSf').text(unitData.sf);	
		$('#unitBedrooms').text(unitData.bedrooms);	
		$('#unitBathrooms').text(unitData.baths);	
		$('#unitDen').text(unitData.den);
		$('#unitModal').modal('show');
	});

    $('#unitModal').on('hide.bs.modal',function() {
    	$('area').mapster('deselect');
    });

    $(document).ready(function() {
		
		$('.mdb-select').materialSelect();
	});

    /******************************* Mapster Code ***********************************/

    var initialOptions = {

	    staticState:true,
	    mapKey: 'data-key',
	    areas: [
	    	{
		        key: 'withheld',
		       	render_select: {
            		fillOpacity: 1,
            		fillColor: '999999'
            	}
        	},
	    	{
	    		key: 'twobed',
	    		render_select: {
            		fillOpacity: 1,
            		fillColor: 'e2eff8'
            	}
	    	},
	    	{
	    		key: 'threebed',
	    		render_select: {
            		fillOpacity: 1,
            		fillColor: 'c6dcf1'
            	}
	    	},
	    	{
	    		key: 'fourbed',
	    		render_select: {
            		fillOpacity: 1,
            		fillColor: 'a3cae9'
            	}
	    	},
	    	{
		        key: 'fivebed',
		       	render_select: {
            		fillOpacity: 1,
            		fillColor: '76b0de'
            	}
        	}
	
	    ]
	};

	realOptions = {
		fillColor:'ffffff',
		fillOpacity:0.5
	}

	map = $('#image');
    map.mapster(initialOptions).mapster('snapshot').mapster('rebind',realOptions,true);

    // this code uses the resize() method, causes the labels to move but the colors don't flash
    // in order for this method to work properly, it must subtract the width of the sidebar IF it is open
    // $(windw).width() is the entire with of the browser window.  Maybe get just the width of the "container"
	// $(window).resize(function() {
	//     setTimeout(function(){
	//     	newWidth = $(window).width();
	//     	map.mapster('resize',newWidth);
	//     }, 300);
	// });

	// this code reinitializes the entire map, prevents the labels from moving but the colors flash
	// $(window).resize(function() {
	//     map.mapster('unbind');
	//     setTimeout(function(){
	//     	map.mapster(initialOptions).mapster('snapshot').mapster('rebind',realOptions,true);
	//     }, 1000);
	// });

	// ************************************* more verbose resize code from github ************************************ //

		// this code yields the same result as the code above using the resize() method

		var resizeTime = 100;     // total duration of the resize effect, 0 is instant
		var resizeDelay = 100;    // time to wait before checking the window size again
	 
		function resize(maxWidth,maxHeight) { // Resize the map to fit within the boundaries provided
		    
		    var imgWidth = map.width(),
		    imgHeight = map.height(),
		    newWidth = 0,
		    newHeight = 0;

		    if (imgWidth / maxWidth > imgHeight / maxHeight) {
		        newWidth = maxWidth;
		    } else {
		        newHeight = maxHeight;
		    }
		    map.mapster('resize',newWidth,newHeight,resizeTime);   
		}

		//Track window resizing events, but only actually call the map resize when the window isn't being resized any more

		function onWindowResize() {
		    var curWidth = $(window).width(),
		        curHeight = $(window).height(),
		        checking = false;
		    if (checking) {
		        return;
		    }
		    checking = true;
		    setTimeout(function() {
		        var newWidth = $(window).width();
		        var newHeight = $(window).height();
		        if (newWidth === curWidth && newHeight === curHeight) {
		        	if (newWidth > 1440) {
		        		newWidth = newWidth - 240; // test for sidebar closed
		        	}
		            resize(newWidth,newHeight); 
		        }
		        checking = false;
		    },resizeDelay );
		}

		// this code prevent a resize of the map if the veritcal width does not change, only if horizontal changes
		var width = $(window).width();
		$(window).on('resize', function() {
		  if ($(this).width() !== width) {
		    width = $(this).width();
		    onWindowResize();
		  }
		});

		// this code triggers a resize on either horizontal or vertical size change
		//$(window).bind('resize',onWindowResize);

	// WORKING CODE


	function getUnits(bedrooms) {
		var options;
		var fillColors = {
			'twobed': 'e2eff8',
			'threebed': 'c6dcf1',
			'fourbed': 'a3cae9',
			'fivebed': '76b0de'
		}

		if (bedrooms == 'all') {
			options = initialOptions;
		}

		else {
			options = {
			    mapKey: 'data-key',
			    areas: [
			    	{
				        staticState:true,
				        key: bedrooms,
				       	render_select: {
		            		fillOpacity: 1,
		            		fillColor: fillColors[bedrooms]
		            	}
		        	}
			    	,{
			    		staticState:true,
			    		key: 'withheld',
			    		render_select: {
		            		fillOpacity: 1,
		            		fillColor: '999999'
		            	}
			    	}
			    ]
			}
		}

		$('.label').hide();
		if (bedrooms == 'all') $('.label').show();
		else $('.' + bedrooms).show();

		map.mapster(options).mapster('snapshot').mapster('rebind',realOptions,true);
		if (bedrooms == 'all') return;
		
		setTimeout(function() { 
			$('area[data-bedrooms!="' + bedrooms + '"]').mapster('set',true,{fillOpacity:1,fillColor:'ffffff'});
			map.mapster('snapshot').mapster('rebind',realOptions,true);
		}, 100);
	}


// TEST CODE

	// $('#getUnits').click(function() {
	// 	var options;
	// 	var bedrooms = $('#bedroomSelect').val();

	// 	var fillColors = {
	// 		'twobed': 'e2eff8',
	// 		'threebed': 'c6dcf1',
	// 		'fourbed': 'a3cae9',
	// 		'fivebed': '76b0de'
	// 	}

	// 	if (bedrooms == 'all') {
	// 		options = initialOptions;
	// 	}

	// 	else {
	// 		options = {
	// 		    mapKey: 'data-key',
	// 		    areas: [
	// 		    	{
	// 			        staticState:true,
	// 			        key: bedrooms,
	// 			       	render_select: {
	// 	            		fillOpacity: 1,
	// 	            		fillColor: fillColors[bedrooms]
	// 	            	}
	// 	        	}
	// 		    	,{
	// 		    		staticState:true,
	// 		    		key: 'withheld',
	// 		    		render_select: {
	// 	            		fillOpacity: 1,
	// 	            		fillColor: '999999'
	// 	            	}
	// 		    	}
	// 		    ]
	// 		}
	// 	}


	// 	$('.label').hide();
	// 	if (bedrooms == 'all') $('.label').show();
	// 	else $('.' + bedrooms).show();

	// 	map.mapster(options).mapster('snapshot').mapster('rebind',realOptions,true);
	// 	if (bedrooms == 'all') return;
		
	// 	setTimeout(function() { 
	// 		$('area[data-bedrooms!="' + bedrooms + '"]').mapster('set',true,{fillOpacity:1,fillColor:'ffffff'});
	// 		map.mapster('snapshot').mapster('rebind',realOptions,true);
	// 	}, 100);
		
	// });


});

</script>
