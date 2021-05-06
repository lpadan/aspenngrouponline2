<?php
	require_once('../../../../private/initialize.php');
?>

<style>

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
	
	<div style="display:inline-block;margin-top:10px;margin-left:30px">
		<h2 style="display:inline-block;color:white">Unit Pricing</h2>
	</div>

	<div style="background-color:white; width:600px;margin-left:30px;padding-left:30px;padding-top:15px">
		<div class="row" style="">
			
			<div style="min-width:210px">
					
				<select id="bedroomSelect" class="mdb-select colorful-select dropdown-primary" data-visible-options="10" style="margin-top:20px;width:auto">
						<option value="all" selected>All Bedrooms</option>
						<option value="fivebed">5 Bedroom</option>
						<option value="fourbed">4 Bedroom</option>
						<option value="threebed">3 Bedroom</option>
						<option value="twobed">2 Bedroom</option>

				</select>
			</div>


			<div class="form-check" style="margin-top:10px">
			    <input id="unitsSold" type="checkbox" class="form-check-input"  value="sold" checked>
			    <label style="padding-left:25px" class="form-check-label" for="unitsSold">Sold</label>
			</div>

			<div class="form-check" style="margin-top:10px">
			    <input id="unitsAvailable" type="checkbox" class="form-check-input" value="available">
			    <label style="padding-left:25px" class="form-check-label" for="unitsAvailable">Available</label>
			</div>

			<div style="margin-left:20px">
				<button id="getUnits" type="button" class="btn btn-primary btn-sm">Show Units</button>
			</div>
		</div>

	</div>

</div>

<div style="text-align:center">

	<div style="position:relative">
		<img id="image" src="projects/sommetBlancResidences/pricing/all_building_image_map.jpg" width="100%"  border="0" usemap="#map" />

	<!-- 2 bedroom -->
		<div class='label twobed' style="top:72.2%;left:15.5%">
			<p><strong>A202</strong></p>
			<p>2,000 SF - 2B/3B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label twobed' style="top:72.2%;left:23%">
			<p><strong>A203</strong></p>
			<p>2,000 SF - 2B/3B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label twobed' style="top:66.25%;left:52.75%">
			<p><strong>B202</strong></p>
			<p>2,000 SF - 2B/3B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label twobed' style="top:66.25%;left:60.5%">
			<p><strong>B203</strong></p>
			<p>2,000 SF - 2B/3B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

	<!-- 3 bedroom building a -->
		<div class='label threebed' style="top:58.5%;left:15.5%">
			<p><strong>A503</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:63%;left:15.5%">
			<p><strong>A403</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:67.5%;left:15.5%">
			<p><strong>A303</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:58.5%;left:23%">
			<p><strong>A502</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:63%;left:23%">
			<p><strong>A402</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:67.5%;left:23%">
			<p><strong>A302</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:58.5%;left:30%">
			<p><strong>A501</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:63%;left:30%">
			<p><strong>A401</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:67.5%;left:30%">
			<p><strong>A301</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

	<!-- 3 bedroom building b -->
		<div class='label threebed' style="top:52.5%;left:52.75%">
			<p><strong>B502</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:57.25%;left:52.75%">
			<p><strong>B402</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:61.75%;left:52.75%">
			<p><strong>B302</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>


		<div class='label threebed' style="top:52.5%;left:60.3%">
			<p><strong>B503</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:57.25%;left:60.3%">
			<p><strong>B403</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:61.75%;left:60.3%">
			<p><strong>B303</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>
		


		<div class='label threebed' style="top:52.5%;left:46%">
			<p><strong>B501</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:57.25%;left:46%">
			<p><strong>B401</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>

		<div class='label threebed' style="top:61.75%;left:46%">
			<p><strong>B301</strong></p>
			<p>3,000 SF - 3B/4B/Den</p>
			<p><strong>$4,200,000</strong></p>
		</div>
	
	<!-- 4 bedroom building a -->
		<div class='label fourbed' style="top:58.5%;left:6.5%">
			<p><strong>A504</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:63%;left:6.5%">
			<p><strong>A404</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:67.5%;left:6.5%">
			<p><strong>A304</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:72%;left:6.5%">
			<p><strong>A204</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

	<!-- 4 bedroom building b -->
		<div class='label fourbed' style="top:52.4%;left:69.5%">
			<p><strong>B504</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:57%;left:69.5%">
			<p><strong>B404</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:61.6%;left:69.5%">
			<p><strong>B304</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:66.4%;left:69.5%">
			<p><strong>B204</strong></p>
			<p>3,000 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

	<!-- 4 bedroom building C -->
		<div class='label fourbed' style="top:47.7%;left:84.5%">
			<p><strong>C501</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:52.2%;left:84.5%">
			<p><strong>C401</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:56.7%;left:84.5%">
			<p><strong>C301</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:61.5%;left:84.5%">
			<p><strong>C201</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:47.7%;left:91%">
			<p><strong>C502</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:52.2%;left:91%">
			<p><strong>C402</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:56.7%;left:91%">
			<p><strong>C302</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

		<div class='label fourbed' style="top:61.5%;left:91%">
			<p><strong>C202</strong></p>
			<p>4,200 SF - 4B/5B/Den</p>
			<p><strong>$3,200,000</strong></p>
		</div>

	<!-- penthouse -->
		<div class='label fivebed' style="top:53.5%;left:13%">
			<p><strong>A603</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:53.5%;left:28%">
			<p><strong>A602</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:47.5%;left:48%">
			<p><strong>B602</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:47.5%;left:63%">
			<p><strong>B603</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:42.5%;left:87.5%">
			<p><strong>C601</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

	<!-- villas -->
		<div class='label fivebed' style="top:22%;left:10%">
			<p><strong>VILLA 1</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:22%;left:21%">
			<p><strong>VILLA 2</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:22%;left:32%">
			<p><strong>VILLA 3</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:22%;left:47.5%">
			<p><strong>VILLA 4</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

		<div class='label fivebed' style="top:22%;left:59%">
			<p><strong>VILLA 5</strong></p>
			<p>5,000 SF - 5B/6B/Den</p>
			<p><strong>$8,200,000</strong></p>
		</div>

	</div>

	<map name="map">
		
		<!-- 2 bedroom -->
			<area data-title="A201" data-key="twobed" shape="poly" coords="274,580,443,581,443,615,274,615" href="#" />
			<area data-title="A202" data-key="twobed" shape="poly" coords="446,581,569,581,569,615,446,615" href="#" />
			<area data-title="B202" data-key="twobed" shape="poly" coords="1042,532,1165,532,1165,566,1042,566" href="#" />
			<area data-title="B203" data-key="twobed" shape="poly" coords="1168,532,1337,532,1337,567,1168,567" href="#" />

		<!-- 3 bedroom building a -->
			<area data-title="A503" data-key="threebed" shape="poly" coords="274,468,442,468,443,502,274,502" href="#" />
			<area data-title="A403" data-key="threebed" shape="poly" coords="274,505,443,506,443,540,274,540" href="#" />
			<area data-title="A303" data-key="threebed" shape="poly" coords="274,543,443,543,443,577,274,577" href="#" />
			<area data-title="A502" data-key="threebed" shape="poly" coords="445,468,569,468,569,502,446,502" href="#" />
			<area data-title="A402" data-key="threebed" shape="poly" coords="569,506,569,540,446,540,446,506" href="#" />
			<area data-title="A302" data-key="threebed" shape="poly" coords="446,543,570,543,569,577,446,578" href="#" />
			<area data-title="A501" data-key="threebed" shape="poly" coords="572,468,724,468,724,502,572,502" href="#" />
			<area data-title="A401" data-key="threebed" shape="poly" coords="572,540,572,506,754,506,754,540" href="#" />
			<area data-title="A301" data-key="threebed" shape="poly" coords="572,577,572,543,724,543,724,577" href="#" />

		<!-- 3 bedroom building b -->
			<area data-title="B502" data-key="threebed" shape="poly" coords="1042,419,1165,419,1165,454,1042,454" href="#" />
			<area data-title="B402" data-key="threebed" shape="poly" coords="1042,491,1042,457,1165,457,1165,491" href="#" />
			<area data-title="B302" data-key="threebed" shape="poly" coords="1042,529,1042,495,1165,495,1165,529" href="#" />
			<area data-title="B503" data-key="threebed" shape="poly" coords="1168,419,1337,419,1337,454,1168,454" href="#" />
			<area data-title="B403" data-key="threebed" shape="poly" coords="1168,491,1337,491,1337,457,1168,457" href="#" />
			<area data-title="B303" data-key="threebed" shape="poly" coords="1168,529,1337,529,1337,494,1168,494" href="#" />
			<area data-title="B501" data-key="threebed" shape="poly" coords="887,420,1039,420,1039,454,887,454" href="#" />
			<area data-title="B401" data-key="threebed" shape="poly" coords="858,491,858,457,1039,457,1039,491" href="#" />
			<area data-title="B301" data-key="threebed" shape="poly" coords="887,495,1039,495,1039,529,887,529" href="#" />
		
		<!-- 4 bedroom building a -->
			<area data-title="A504" data-key="fourbed" shape="poly" coords="45,468,271,468,271,502,45,502" href="#" />
			<area data-title="A404" data-key="fourbed" shape="poly" coords="88,506,271,506,271,540,88,540" href="#" />
			<area data-title="A304" data-key="fourbed" shape="poly" coords="45,543,270,543,271,577,45,577" href="#" />
			<area data-title="A204" data-key="fourbed" shape="poly" coords="88,581,271,581,271,615,88,615" href="#" />
			
		<!-- 4 bedroom building b -->
			<area data-title="B504" data-key="fourbed" shape="poly" coords="1340,420,1566,419,1566,454,1340,454" href="#" />
			<area data-title="B404" data-key="fourbed" shape="poly" coords="1340,491,1340,457,1523,457,1523,491" href="#" />
			<area data-title="B304" data-key="fourbed" shape="poly" coords="1340,529,1340,495,1566,495,1566,529" href="#" />
			<area data-title="B204" data-key="fourbed" shape="poly" coords="1340,566,1340,532,1523,532,1523,566" href="#" />

		<!-- 4 bedroom building c -->
			<area data-title="C501" data-key="fourbed" shape="poly" coords="1669,380,1801,380,1801,415,1669,415" href="#" />
			<area data-title="C401" data-key="fourbed" shape="poly" coords="1669,451,1669,418,1801,418,1801,451" href="#" />		
			<area data-title="C301" data-key="fourbed" shape="poly" coords="1669,490,1669,453,1801,455,1801,488" href="#" />
			<area data-title="C201" data-key="fourbed" shape="poly" coords="1669,526,1669,492,1801,492,1801,526" href="#" />
			<area data-title="C502" data-key="fourbed" shape="poly" coords="1804,380,1937,380,1937,415,1804,415" href="#" />
			<area data-title="C402" data-key="fourbed" shape="poly" coords="1804,451,1804,418,1936,418,1936,451" href="#" />
			<area data-title="C302" data-key="fourbed" shape="poly" coords="1805,489,1805,455,1936,455,1936,489" href="#" />
			<area data-title="C202" data-key="fourbed" shape="poly" coords="1804,526,1805,492,1936,492,1936,526" href="#" />

		<!-- 5 bedroom -->
			<area data-title="A603" data-key="fivebed" shape="poly" coords="158,419,335,427,442,427,443,465,159,465,159,420" href="#" />
			<area data-title="A602" data-key="fivebed" shape="poly" coords="456,426,456,418,616,418,617,426,638,426,650,425,649,418,714,418,715,425,754,426,754,465,446,465,446,427,456,427" href="#" />
			<area data-title="B602" data-key="fivebed" shape="poly" coords="858,377,896,377,896,369,961,369,961,376,994,377,994,369,1155,369,1155,378,1165,379,1165,416,858,416,858,377" href="#" />
			<area data-title="B603" data-key="fivebed" shape="poly" coords="1168,379,1281,378,1452,371,1452,416,1168,416,1168,378" href="#" />
			<area data-title="C601" data-key="fivebed" shape="poly" coords="1670,325,1741,325,1741,340,1833,340,1833,325,1936,325,1936,325,1936,377,1670,377,1670,325" href="#" />

		<!-- villas -->
			<area data-title="Alpine Villas 1" data-key="sold" shape="poly" coords="202,114,231,114,231,116,304,116,304,160,365,161,365,226,144,226,144,157,125,157,125,150,203,150,203,113" 
			href="#" />
			<area data-title="Alpine Villas 2" data-key="fivebed" shape="poly" coords="368,120,470,120,470,145,510,145,510,161,575,161,575,226,368,226,368,120" href="#" />
			<area data-title="Alpine Villas 3" data-key="fivebed" shape="poly" coords="578,161,644,161,644,145,684,145,684,120,786,120,786,226,578,226,578,161" href="#" />
			<area data-title="Alpine Villas 4" data-key="fivebed" shape="poly" coords="900,120,1002,120,1002,144,1042,145,1042,161,1107,161,1107,226,900,226,900,120" href="#" />
			<area data-title="Alpine Villas 5" data-key="fivebed" shape="poly" coords="1110,161,1177,161,1177,145,1217,144,1217,120,1319,120,1319,226,1110,226,1110,161" href="#" />
	
	</map>
	
</div>

<script src=<?php echo ROOT . "js/imagemapster.js" ?>></script>

<script>

$(document).ready(function() {

	$('area').click(function() {
		var title = $(this).data('title');
		var html = 
			
			'<h3>' + title +  ' - ' + '$8,200,000' + '</h3>' +
			'<div>' +
				'<p>' + '5,000' + ' sf</p>' +
				'<p>5-Bed | 6-Bath | Den</p>' +
			'</div>';

		$('#modalTitle').html(html);
		$('#floorPlanModal').modal('show');
	});

    $('#floorPlanModal').on('hide.bs.modal',function() {
    	$('area').mapster('deselect');
    });

    $(document).ready(function() {
		$('.mdb-select').materialSelect();
	});

	$('#page_body').css("padding-top","66px");

    /******************************* Mapster Code ***********************************/

    var initialOptions = {

	    staticState:true,
	    mapKey: 'data-key',
	    areas: [
	    	{
		        key: 'fivebed',
		       	render_select: {
            		fillOpacity: 1,
            		fillColor: '76b0de'
            	}
        	},
	    	{
	    		key: 'sold',
	    		render_select: {
            		fillOpacity: 1,
            		fillColor: 'f4c364'
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
	//     }, 300);
	// });

	// ************************************* more verbose resize code from github ************************************ //

		// this code yields the same result as the code above using the resize() method

		var resizeTime = 100;     // total duration of the resize effect, 0 is instant
		var resizeDelay = 300;    // time to wait before checking the window size again
	 
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
		    window.setTimeout(function() {
		        var newWidth = $(window).width(),
		           newHeight = $(window).height();
		        if (newWidth === curWidth &&
		            newHeight === curHeight) {
		            
		            // ADD test for whether sidebar is showing, and if true subtract 240px
		        	if (newWidth > 1350) {
		        		newWidth = newWidth - 240;
		        	}

		            resize(newWidth,newHeight); 
		        }
		        checking = false;
		    },resizeDelay );
		}

		$(window).bind('resize',onWindowResize);


	$('#getUnits').click(function() {
		var sold,available,options;
		var bedrooms = $('#bedroomSelect').val();
		if($("#unitsSold").is(':checked')) sold = "sold"
		else sold = null;
		if($("#unitsAvailable").is(':checked')) available = "sold"
		else available = null;

		var fillColors = {
			'fivebed': '76b0de',
			'fourbed': 'a3cae9',
			'threebed': 'c6dcf1',
			'twobed': 'e2eff8'
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
		        	},
			    	{
			    		key: 'sold',
			    		render_select: {
		            		fillOpacity: 1,
		            		fillColor: 'f4c364'
		            	}
			    	}
			    ]
			}
		}

		$('.label').hide();
		if (bedrooms == 'all') $('.label').show();
		else $('.' + bedrooms).show();

		map.mapster(options).mapster('snapshot').mapster('rebind',realOptions,true);
	});


});

</script>
