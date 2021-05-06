<?php
	session_start();
	require_once('../../includes/initialize.php');
	verifyAjaxAccess(); // include with all AJAX files
	$db = db_connect();
	$offering_id = $_SESSION['offering_id'];

	// get and set the offering hex_color into $_SESSION['hex_color']
	$query = "SELECT hex_color from offerings WHERE offering_id = $offering_id LIMIT 1";
	$result = mysqli_query($db,$query);
	$row = mysqli_fetch_assoc($result);
	$hex_color = $row['hex_color'];
	$_SESSION['hex_color'] = $hex_color;

	include('../css/offering_css.php');

?>

<style>

	.sommetblanc {
		color:#256ab0;
		font-weight:bold;
		font-size:16px;
		font-style:italic;
	}

	section {
		margin-top:40px;
	}

	.page-wrapper{
		font-size:.9em;
	}
</style>

<div id="banner1">
	<img class="img-responsive" src="images/offering_memorandum-1200.jpg" style="width:100%">
</div>

<div class="" style="padding-bottom:30px">

	<div style="margin:2% 5% 0% 5%">

		<ul id="offering_menu" style="background-color:white" class="nav nav-pills nav-justified empire">
		  <li class="active"><a data-toggle="pill" href="#executive_summary">Executive<br>Summary</a></li>
		  <li><a data-toggle="pill" href="#proforma_summary">Proforma<br>Summary</a></li>
		  <li><a data-toggle="pill" href="#market_data">Market<br>Data</a></li>
		  <li><a data-toggle="pill" href="#empire">Empire<br>Pass</a></li>
		  <li><a data-toggle="pill" href="#deer_valley">Deer&nbsp;Valley<br>Overview</a></li>
		  <li><a data-toggle="pill" href="#park_city">Park&nbsp;City<br>Overview</a></li>
		  <li><a data-toggle="pill" href="#talisker_club">Talisker<br>Club</a></li>
		</ul>

		<hr style="border-top: 2px solid #8c8b8b; margin-bottom:30px">

		<div class="tab-content clear-style" style="margin:0; padding:0">	<!-- margin:0 -->

			<article id="executive_summary" class="tab-pane fade in active">

				<section name="intro">


					<h2>Introduction</h2>

					<p>Aspen Group is pleased to announce a unique investment opportunity in Park City, Utah.  An Aspen Group related entity has acquired the most sought after parcel in all of Deer Valley - The Sommet Blanc Resort parcel, adjacent to the Montage Hotel in upper Deer Valley.  Sommet Blanc is one of just three remaining ski-in / ski-out properties in Deer Valley.  Aspen Group is currently seeking investment in the Sommet Blanc Residences Phase I, consisting of twenty ski-in / ski-out condominiums at the base of the Ruby chair lift.</p>


					<h2>Background</h2>
					<p>In November of 2015, Wells Fargo Bank foreclosed on numerous real property assets in and around Park City, Utah, which were security for a loan made to Talisker Corporation, the successor in interest to United Park City Mines Company.  In October of 2016, Wells Fargo selected Aspen Group to acquire and develop the luxury ski-in property now known as <em><strong><a class="sommetblanc" href="https://empireresidences.com">Empire Residences </a></strong></em> in Deer Valley. Currently under construction, the project is scheduled for completion in the summer of 2020 (visit our <a href="https://empireresidences.com/video" target="_blank">video</a> for the project).</p>

					<p>After a lengthy review process, in October of 2018 Wells Fargo again selected Aspen Group, from among numerous regional and national developers, to purchase and develop what is known as the B2 East parcel in Deer Valley.  Aspen Group subsequently designed the <span class="sommetblanc">Sommet Blanc Resort</span> for the parcel and is seeking equity investment in the first phase of the project.<p>

					<p><em>* Aspen Group is the #1 developer in the Park City market, having developed over $500M in condominiums in Park City, Deer Valley and the Canyons ski resorts. Please visit our <a href="https://aspengroupusa.com" target="_blank">website</a> for more information.</em></p>
				</section>

				<section name="miscellaneous" hidden>
					<h2>Wells Fargo Bank Foreclosure</h2>

					<p>Aspen Group has acquired the most prestigious and desirable condominium site in all of Deer Valley, and has commenced the design of the world class <span class="sommetblanc">Sommet&nbsp;Blanc&nbsp;Resort</span>. We are presently seeking equity investment in the first phase of the project<p>

					<p>The Alpine Villas consists of six townhomes with an average size of 5,000 square feet. All townhomes have dramatic vista views and exposure to the south west. These homes are unique among all homes and townhomes in Deer Valley as they will have access to all of Sommet Blanc's amenities, as well as those of the Montage Resort. No other single family community in Park City has access to any significant amenity.  With direct ski access and umcomporable amenities, The Alpine Villas provide a unique combination of membership in a world class resort, while maintaining the privacy and seclusion of a single family home.</p>

					<p>The Alpine Villas consist of six townhomes with an average size of 5,000 square feet. All homes have dramatic vista views with a desirable south west exposure. These homes are unique among all homes and townhomes in Deer Valley as they will have access to all Sommet Blanc amenities.  All Villas will have convenient direct ski access, plus access to a full suite of desirable amenities, while maintaining the privacy and seclusion of a single family home.</p>
				</section>

				<section name="threeParcelsRemain" style="background-color:#36373c; color:#fff; padding:20px">

					<img src="../sommetblanc/images/deervalley_line.png">

					<h2 style="margin-left:20px; margin-top:0; color:white">Only Three Ski-in / Ski-out Parcels Remain in Deer Valley</h2>

					<ul style="margin:20px">
						<li>Empire Village Parcel 4 - 64,000 sf &nbsp;</li>
						<li>Talisker Tower condominiums - 41,640 sf &nbsp;</li>
						<li>Sommet Blanc - 162,000 sf</li>
					</ul>

					<p style="margin:20px; font-size:1.2em">Sommet Blanc includes the following development parcels:</p>
					<ul style="margin-left:20px; text-align:left">
						<li>Alpine Villas - Six townhomes (5,000 sf each)</li>
						<li>Residences Phase I - Twenty condominiums (49,000 sf)</li>
						<li>Residences Phase II - Twenty condominiums (49,000 sf)</li>
						<li>Residence Club - Twenty four condominiums (34,000 sf) </li>
					</ul>
				</section>

				<section name="location">
					<h2>The Best Location in Deer Valley</h2>

					<p>The <span class="sommetblanc">Sommet Blanc</span> parcel is arguably the best parcel in all of Deer Valley, and one of only three remaining ski-in/ski-out parcels in Park City. The site has no impediments to its immediate development, allowing marketing of the Alpine Villas and the Residences Phase I to commence in December of 2019, with ground breaking in June of 2020. Luxury condominium buyers currently prefer a mountain modern style, with open floor plans and up to date styling. As the market's newest product, Sommet Blanc is uniquely positioned to capture discerning buyers who are looking for the latest styles and features not found in existing older product.</p>
				</section>

				<section name="description" hidden>

					<div style="padding:20px 30px 30px 30px;background-color:#333; color:white">

						<h2 style="margin-top:20px;margin-bottom:20px" class="sommetblanc"><em><b>Sommet Blanc - Alpine Villas</b></em></h2>

						<div style="float:left;width:49%;margin-left:0px;margin-right:20px">
							<a href="../sommetblanc_alpinevillas/images/renderings/left_front-1900.jpg" target="_blank"><img src='../sommetblanc_alpinevillas/images/renderings/left_front-500.jpg'></a>
						</div>

						<p>Located along the highest portion of the site, with direct ski-in / ski-out access from the Lucky Jack ski run, the Alpine Villas feature commanding views of the Empire and Lady Morgan ski areas.  The Alpine Villas are the most exclusive townhome product in all of Deer Valley. Given their views, location, privacy and orientation, the Villas will demand some of the highest prices in Deer Valley. Current plans include a ski beach set along side the Ruby Express chair lift, adding a significant amount of convenience and value to these sites.  Additionally each Alpine Villa will have access to all Sommet Blanc amenties, plus the Montage amenities just steps away.</p>

						<div style="float:right;width:49%;margin-left:20px">
							<a href="../sommetblanc_alpinevillas/images/renderings/right_rear-1900.jpg" target="_blank"><img src='../sommetblanc_alpinevillas/images/renderings/right_rear-500.jpg'></a>
						</div>

						<p>The Alpine Villas consist of eight townhomes with an average size of 3,500 square feet. All homes have dramatic vista views with a desirable south west exposure. These homes are unique among all homes and townhomes in Deer Valley as they will have access to all Sommet Blanc amenities.  All Villas will have convenient direct ski access, plus access to a full suite of desirable amenities, while maintaining the privacy and seclusion of a single family home.</p>

						<br style="clear:both">

						<h2 style="margin-top:20px;margin-bottom:20px" class="sommetblanc"><em><b>Sommet Blanc Resort - Views</b></em></h2>

						<div style="width:100%;margin-bottom:0">
							<img src='../sommetblanc_alpinevillas/images/alpinevillas_view-1200.jpg'></a>
						</div>

					</div>
				</section>

				<section name="project_status" hidden>

					<h2>Current Project Status</h2>

					<p>As of October 1, 2017, the Empire Residences are fully designed and approved by the Empire Village design review board and scheduled for final approval by Park City in early November, 2017.  See the <a href='http://empireresidences.com' target='_blank'>Empire Residences website</a> for more information.</p>
				</section>

				<section name="configuration" style="margin:0">

					<h2>Project Configuration</h2>
					<p>Set alongside the Ruby and Empire chair lifts, and adjacent to the Montage Resort, <span class="sommetblanc">Sommet Blanc</span> is approved with 162,000 square feet of condominium density, on the most sought after and convenient location in all of Deer Valley. With forecasted sales of approximately $225 million, the project includes three non-competing product types:&nbsp;Townhomes, Condominiums, and a fractional Private Residence Club. A related entity of Aspen Group, Solaire Deer Valley, LLC, is purchasing the entire parcel and subdividing it into four smaller, individual development parcels.</p>


					<div style="padding:30px;background-color:#333; color:white">

						<div name="alpinevillas">
							<h2 style="clear:left;margin-top:0px;color:white"><em><b>Alpine Villas</b></em></h2>

							<p>Located along the highest portion of the site, with direct ski-in / ski-out access from the Lucky Jack ski run, the Alpine Villas feature commanding views of the Empire and Lady Morgan ski areas.  The Alpine Villas are the most exclusive townhome product in all of Deer Valley. Given their views, location, privacy and orientation, the Villas will demand some of the highest prices in Deer Valley. Current plans include a ski beach set along side the Ruby Express chair lift, adding a significant amount of convenience and value to these sites.  Additionally each Alpine Villa will have access to all Sommet Blanc amenities, plus the Montage amenities just steps away.</p>

							<div style="float:left;width:50%;margin-left:0px;margin-bottom:15px;padding-left:0px;padding-right:5px">
								<a href="../sommetblanc_alpinevillas/images/alpine_villas.jpg" target="_blank"><img src='../sommetblanc_alpinevillas/images/alpine_villas-600.jpg'></a>
							</div>

							<div style="float:left;width:50%;margin-left:0px;margin-bottom:15px;padding-left:5px;padding-right:5px">
								<a href="../sommetblanc_alpinevillas/images/alpine_villas2.jpg" target="_blank"><img src='../sommetblanc_alpinevillas/images/alpine_villas2-600.jpg'></a>
							</div>

							<br style="clear:both"><br>
						</div>

						<div name="residences">
							<h2 style="color:white;margin-top:10px"><em><b>Residences</b></em></h2>

							<p style="margin-bottom:15px; padding-bottom:0; clear:left">Planned as two, six story buildings, each containing twenty residential condominium units with an average unit size of 2,450 square feet (49,000 sf total), the Sommet Blanc Residences will be similar in size and height to the Empire Residences pictured below.  Phase I and Phase II are each approved for 49,000 square feet of salable residential condominiums, plus 3600 square feet of commercial space total.  The Residences will feature the following design elements and amenities.</p>

							<div class="container" style="width:100%">
								<div class="row">

									<div class="col-md-6 col-lg-6">
										<h3 style="color:white;margin-left:20px">Design Elements</h3>
										<ul style="overflow:hidden">
											<li>Thru-building units with views from every room</li>
											<li>Heated underground parking</li>
											<li>4'x10' mini-storage for each owner</li>
											<li>Large, private ski lockers for each owner</li>
											<li>Private elevator with no central corridor</li>
											<li>Electric vehicle charging</li>
										</ul>
									</div>

									<div class="col-md-6 col-lg-6">
										<h3 style="color:white;margin-left:20px">Amenities</h3>
										<ul>
											<li>Pool and hot tub</li>
											<li>Pre and Apres-ski pub and lounge</li>
											<li>Kids game room</li>
											<li>Full time lodgekeeper</li>
											<li>Lobby and concierge</li>
											<li><em>* Access to all Montage amenities</em></li>
										</ul>
									</div>

								</div>

								<p>* By written agreement, all Sommet Blanc owners have access to the Montage amenities, the same as though they were owners at the Montage</p>
							</div>

							<br>

							<div style="float:left;width:50%;margin-left:0px;margin-bottom:15px;padding-left:0px;padding-right:5px">
								<a href="https://aspengroupusa.com/offerings/empire_residences_2018/images/renderings/exterior/aerial_right3.jpg" target="_blank"><img src='https://aspengroupusa.com/offerings/empire_residences_2018/images/renderings/exterior/aerial_right3.jpg'></a>
							</div>

							<div style="float:left;width:50%;margin-left:0px;margin-bottom:15px;padding-left:5px;margin-right:0px">
								<a href="https://aspengroupusa.com/offerings/empire_residences_2018/images/renderings/exterior/aerial_rear3.jpg" target="_blank"><img src='https://aspengroupusa.com/offerings/empire_residences_2018/images/renderings/exterior/aerial_rear3.jpg'></a>
							</div>

							<br style="clear:both"><br>

						</div>

						<div name="residenceclub">
							<h2 style="clear:both;margin-top:0px;color:white"><em><b>Residence Club</em></b></h2>

							<p><em>The Sommet Blanc Residence Club</em> will be a Private Residence Club with six deeded interests per condominium, in a single six story building containing fourteen condominium units with an average unit size of 2,429 square feet. Aspen Group successfully developed <a href="http://chateauxresidences.com" target="_blank" style="color:#f0ad4e">The Chateaux Residences</a>, a similarly configured Private Residence Club in Deer Valley's Silver Lake Village. The Sommet Blanc Residence Club will be a high-end, members only Private Club, and will participate in exchange programs with other 5-star Residence Clubs around the world.  The Residence Club will be in a separate building, with a separate HOA, and contain a full compliment of exclusive amenities for Club member use only.</p>

							<div style="padding:0 10px 30px 20px">
								<h3 style="color:white;margin-left:20px">Amenities</h3>
								<ul>
									<li >Roof Top Pool and hot tub</li>
									<li>Heated underground parking</li>
									<li>Large, private ski lockers for each owner</li>
									<li>4'x10' mini-storage on the parking level for each owner</li>
									<li>Pre and Apres-ski pub and lounge</li>
									<li>Bowling with gaming and TV</li>
									<li>Kids room</li>
									<li>Lobby with full-time concierge</li>
									<li>On-site management</li>
								</ul>
							</div>

							<div style="float:left;width:50%;margin-left:0px;margin-bottom:15px;padding-left:0px;padding-right:5px">
								<a href="images/roof_top_pool.jpg" target="_blank"><img src="images/roof_top_pool-600.jpg" ></a>
							</div>

							<div style="float:left;width:50%;margin-left:0px;margin-bottom:15px;padding-left:5px;padding-right:5px">
								<a href="images/sommetblanc_view-1200.jpg" target="_blank"><img src="images/sommetblanc_view-600.jpg" ></a>
							</div>
							<br style="clear:both">
						</div>
					</div>
				</section>

				<section name="entitlement" hidden>
					<h2>Entitlement</h2>
					&lt;add copy on entitlement&gt;
				</section>

				<section mame="timing" hidden>
					<h2>Project Timing</h2>
					<div style="padding:0px 20px">
						<p><b>Land Acquisition</b><br>
						Aspen Group is under contract to purchase the entire Sommet Blanc parcel. The purchase will close on approximately February 5, 2019. A new single purpose entity, Sommet Blanc Alpine Villas, LLC, will purchase the Villas parcel for $6.0mm, and develop the Alpine Villas. </p>

						<p><b>Sales and Marketing</b><br>
						The Empire Residences will be marketed by one of the top real estate brokerages in Park City.  An on-site sales office, accessible from from both the Ruby lift and the public street, will be completed by Christmas 2019.   We will begin taking reservations in December 2019 with the expectation of obtaining two to three pre-sales by season's end and beginning construction summer of 2020.</p>
					</div>
				</section>

				<section name="investment structure">
					<h2>Investment Structure</h2>
					<p>Aspen Group will simultaneously develop the Alpine Villas Townhomes through a previously formed and subscribed partnership. Aspen Group will form an entity to acquire and develop the <strong><em>Sommet Blanc Residences</em></strong> parcel, and is seeking equity investment in this partnership at this time.</p>

					<div style="padding:0 20px 0 20px">

						<h3>Sommet Blanc Residences, LLC</h3>

						<p>The entity will purchase from Solaire Deer Valley, LLC Phase I development parcel for $9.8mm.  Total required equity will include the purchase price of the development parcel.  Additional soft costs including architectural and engineering, initial legal and initial marketing will be paid for with a bridge loan secured by the land. The parcel is entitled with 49,000 square feet of saleable condominium space, plus 3600 square feet of retail space total, and unlimited support commercial space (lobby, spa, exercise, etc.). The entity will utilize a non-recourse construction loan to construct each building, with Aspen Group providing a completion guarantee. Aspen Group will contribute a minimum of 10% of the required equity, with the balance from outside investors.</p>

					</div>

					<p>Construction will not begin until there are sufficient pre-sales to cover 100% of the cost of construction.  All sales will require a 25% non-refundable earnest money deposit at the time of ground breaking. For more detailed financial information, please see the <em><strong><span class="sommetblanc"><a id="proforma_summary_link">Proforma Summary</a><span></strong></em> section of this offering.</p>
				</section>

				<section name="equity">
					<div style="margin-top:30px;padding:30px 50px 20px 50px;background-color:#36373c; color:white">
						<img src="images/snowflake_line.png">
						<h2 style="color:white; margin-bottom:20px">Equity Investment</h2>

						<div style="padding:0 20px">
							<p>Aspen Group is offering its investor partner in the Residences a "preferred", fixed return on their investment of 125%. For example, a $1mm equity investment will yield a total return of $2.25mm, with an average annual IRR in excess of 24% over the life of the investment.</p>

							<p style="margin-left:20px;margin-bottom:5px">All cash distributions will be made according to the following priority:
								<ul style="margin-top:0; padding-top:0">
									<li>first to retire debt</li>
									<li>second to the return of initial investment</li>
									<li>third to the return on investment</li>
									<li>last to the Sponsor</li>
								</ul>
							</p>

					</div>
				</section>

				<section name="summary">
					<h2>Summary</h2>
					<p>The Park City market is very strong, with over $2.5B in 2018 sales, with sales in Empire Pass of over $200M during the same period.  Currently the only new condominiums being marketed in Deer Valley are our own Empire Residences, with ten of twenty units sold, and the Goldener Hirsch hotel in Silver Lake. Sommet Blank is the last new construction investment opportunity in Deer Valley. This offering does not attempt to answer every question, but should provide a solid overview of the investment opportunity at this time, as well as an overview of the surrounding market. We are available to meet in person, or answer any questions you may have over the phone to assist you in your decision making process. </p>

					<p style="font-size:1.1em;margin-bottom:0; padding-bottom:10px">Thank you for your consideration,</p>

					<p style="font-size:24px; font-family:'Times New Roman'"><b>Aspen Group</b></p>

				</section>

				<a href="#" class="back-to-top"></a>
			</article>

			<article id="proforma_summary" class="tab-pane fade">
				<br>
				<img src="images/offering/tower_larkspur.jpg">
				<br><br>

				<?php
						// ********************************* High Case *************************************** //

						$query = "SELECT * FROM proformas WHERE proforma_name = 'High Case' AND offering_id = $offering_id LIMIT 1";
						$result = mysqli_query($db, $query);
						while ($row = mysqli_fetch_assoc($result)) {
							$proforma_data = $row['all_data'];
							$proforma_data = json_decode($proforma_data, true);
							$proforma_name = $row['proforma_name'];
						}
						$high_partner_financial_summary = $proforma_data['partner_financial_summary'];
						$high_cash_flow_chart = $proforma_data['partner_chart_cash_flow'];
						$high_summary_financial_info = json_decode($proforma_data['summary_financial_info'],true);
						$high_construction_assumptions= $proforma_data['construction_assumptions'];
						$high_sales_assumptions= $proforma_data['sales_assumptions'];
						$high_project_start_date = $high_sales_assumptions[0][1];
						$high_sales_delay = $high_sales_assumptions[4][1];
						$high_sales_start_month = strtotime("+" . $high_sales_delay . "months", strtotime($high_project_start_date));
						$high_sales_start_month = date('F \of Y',$high_sales_start_month);


						// ********************************* Medium Case *************************************** //

						$query = "SELECT * FROM proformas WHERE proforma_name = 'Medium Case' AND offering_id = $offering_id LIMIT 1";
						$result = mysqli_query($db, $query);
						while ($row = mysqli_fetch_assoc($result)) {
							$proforma_data = $row['all_data'];
							$proforma_data = json_decode($proforma_data, true);
							$proforma_name = $row['proforma_name'];
						}
						$medium_partner_financial_summary = $proforma_data['partner_financial_summary'];
						$medium_cash_flow_chart = $proforma_data['partner_chart_cash_flow'];
						$medium_summary_financial_info = json_decode($proforma_data['summary_financial_info'],true);
						$medium_construction_assumptions = $proforma_data['construction_assumptions'];
						$medium_sales_assumptions = $proforma_data['sales_assumptions'];
						$medium_project_start_date = $medium_sales_assumptions[0][1];
						$medium_sales_delay = $medium_sales_assumptions[4][1];
						$medium_sales_start_month = strtotime("+" . $medium_sales_delay . "months", strtotime($medium_project_start_date));
						$medium_sales_start_month = date('F \of Y',$medium_sales_start_month);


						// ********************************* Low Case *************************************** //

						$query = "SELECT * FROM proformas WHERE proforma_name = 'Medium Case' AND offering_id = $offering_id LIMIT 1";
						$result = mysqli_query($db, $query);
						while ($row = mysqli_fetch_assoc($result)) {
							$proforma_data = $row['all_data'];
							$proforma_data = json_decode($proforma_data, true);
							$proforma_name = $row['proforma_name'];
						}
						$low_partner_financial_summary = $proforma_data['partner_financial_summary'];
						$low_cash_flow_chart = $proforma_data['partner_chart_cash_flow'];
						$low_summary_financial_info = json_decode($proforma_data['summary_financial_info'],true);
						$low_construction_assumptions = $proforma_data['construction_assumptions'];
						$low_sales_assumptions = $proforma_data['sales_assumptions'];
						$low_project_start_date = $low_sales_assumptions[0][1];
						$low_sales_delay = $low_sales_assumptions[4][1];
						$low_sales_start_month = strtotime("+" . $low_sales_delay . "months", strtotime($low_project_start_date));
						$low_sales_start_month = date('F \of Y',$low_sales_start_month);

						mysqli_close($db);
					?>


				<div class="tabs-style-2" style="margin:0">
					<ul class="nav nav-pills offering-proforma" style="margin:0">
						<li class="active"><a data-toggle="tab" href="#proforma_summary2">Discussion</a></li>
						<li><a data-toggle="tab" href="#high">High Case</a></li>
						<li><a data-toggle="tab" href="#medium">Medium Case</a></li>
						<li><a data-toggle="tab" href="#low">Low Case</a></li>
					</ul>


					<div class="tab-content" style="padding:0" >

						<div id="proforma_summary2" class="tab-pane active in text-panel" style="padding:4% 7%; margin:0">

						    <div>
								<img src="images/snowflake_line.png">
								<h2 style="font-family:'Times New Roman'; color:white">
									Proforma Discussion<br>
								</h2>
							</div>
							<br>

							<p>Aspen Group has pre-configured three proformas for <em>Residences Phase I.</em></p>

							<p>Summary information for each proforma is displayed by clicking one of the tabs above.&nbsp Each proforma contemplates a 90/10 equity split between Investor and Sponsor, with a fixed preferred return to the Investor. The detail for each proforma may be viewed by clicking the blue "VIEW DETAIL" button on the summary tab.</p>

							<p>You may modify the assumptions in a proforma from within the detailed display.  Click the "Assumptions" menu at the top of the page. Then click the appropriate tab for the assumptions you wish to modify.  Modify any paramater, then click "save".  After modifying the assumptions, click the blue "Calculate" button at the top right of the page.  Results for your revised assumptions will be calculated and displayed.  If you would like to save a set of assumptions for your private use, select "Save As..." from the file menu.</p>
						</div>

						<div class="tab-pane" id="high" style="background-color:#333; padding: 20px 40px 40px 40px; color:white; width:100%">

							<img src="images/snowflake_line.png">
							<h3 style="color:white">High Case&nbsp&nbsp</h3>

							<p style="margin-bottom:10px">Assumptions</p>
							 <ul>
							  <li>Pre-sales commence <?php echo $high_sales_start_month;?></li>
							  <li>Unit Sales per Year: &nbsp;<?php echo $high_sales_assumptions[3][1];?></li>
							  <li>Construction Costs: &nbsp;$<?php echo $high_construction_assumptions[0][1];?> per square foot</li>
							  <li>Beginning Sales price: &nbsp;$<?php echo $high_sales_assumptions[1][1];?> per square foot</li>
							</ul>
							<button data-name="High Case" class="proforma_link btn btn-proforma-color" type="button">View Detail</button>
							<div id="high_case_table_wrapper" style="">

								<div class="row" style="background-color:white;margin:20px 0 0 0;padding-bottom:20px">

									<div class="col-md-12 col-lg-6" style="margin-top:16px">
										<table id="high_case_table" style="width:100%" class="table table-striped">
											<?php
												echo $high_partner_financial_summary;
											?>
										</table>
									</div>

									<div class='col-md-12 col-lg-6' style="margin-top:23px">
										<div style="height:50px;background-color:#36373C;margin-bottom:26px;text-align:center">
											<span style="line-height: 50px;color:white;font-size:23px;padding-left:10px">Cumulative Cash Flow</span>
										</div>

										<div id="high_cash_flow_chart" style="height:350px">
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="tab-pane" id="medium" style="background-color:#333; padding: 20px 40px 40px 40px; color:white; width:100%">

							<img src="images/snowflake_line.png">
							<h3 style="color:white">Medium Case&nbsp&nbsp</h3>


							<p style="margin-bottom:10px">Assumptions</p>
							 <ul>
							  <li>Pre-sales commence <?php echo $medium_sales_start_month;?></li>
							  <li>Unit Sales per Year: &nbsp;<?php echo $medium_sales_assumptions[3][1];?></li>
							  <li>Construction Costs: &nbsp;$<?php echo $medium_construction_assumptions[0][1];?> per square foot</li>
							  <li>Beginning Sales price: &nbsp;$<?php echo $medium_sales_assumptions[1][1];?> per square foot</li>
							</ul>
							<button data-name="Medium Case" class="proforma_link btn btn-proforma-color" type="button">View Detail</button>
							<div id="medium_case_table_wrapper" style="">

								<div class="row" style="background-color:white;margin:20px 0 0 0;padding-bottom:20px">

									<div class="col-md-12 col-lg-6" style="margin-top:16px">
										<table id="medium_case_table" style="width:100%" class="table table-striped">
											<?php
												echo $medium_partner_financial_summary;
											?>
										</table>
									</div>

									<div class='col-md-12 col-lg-6' style="margin-top:23px">
										<div style="height:50px;background-color:#36373C;margin-bottom:26px;text-align:center">
											<span style="line-height: 50px;color:white;font-size:23px;padding-left:10px">Cumulative Cash Flow</span>
										</div>

										<div id="medium_cash_flow_chart" style="height:350px">
										</div>
									</div>

								</div>
							</div>
						</div>


						<div class="tab-pane" id="low" style="background-color:#333; padding: 20px 40px 40px 40px; color:white; width:100%">

							<img src="images/snowflake_line.png">
							<h3 style="color:white">Low Case&nbsp&nbsp</h3>


							<p style="margin-bottom:10px">Assumptions</p>
							 <ul>
							  <li>Pre-sales commence <?php echo $low_sales_start_month;?></li>
							  <li>Unit Sales per Year: &nbsp;<?php echo $low_sales_assumptions[3][1];?></li>
							  <li>Construction Costs: &nbsp;$<?php echo $low_construction_assumptions[0][1];?> per square foot</li>
							  <li>Beginning Sales price: &nbsp;$<?php echo $low_sales_assumptions[1][1];?> per square foot</li>
							</ul>
							<button data-name="Low Case" class="proforma_link btn btn-proforma-color" type="button">View Detail</button>
							<div id="low_case_table_wrapper" style="">

								<div class="row" style="background-color:white;margin:20px 0 0 0;padding-bottom:20px">

									<div class="col-md-12 col-lg-6" style="margin-top:16px">
										<table id="low_case_table" style="width:100%" class="table table-striped">
											<?php
												echo $low_partner_financial_summary;
											?>
										</table>
									</div>

									<div class='col-md-12 col-lg-6' style="margin-top:23px">
										<div style="height:50px;background-color:#36373C;margin-bottom:26px;text-align:center">
											<span style="line-height: 50px;color:white;font-size:23px;padding-left:10px">Cumulative Cash Flow</span>
										</div>

										<div id="low_cash_flow_chart" style="height:350px">
										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>
			</article>

			<article id="market_data" class="tab-pane fade">
				<br>

				<img src="images/offering/flagstaff_mountain.jpg">
				<div style="background-color:#333; padding: 20px 40px 40px 40px; color:white; width:100%">

					<h3 style="font-family:'Times New Roman';color:white">EMPIRE PASS - HISTORICAL CONDO SALES</h3>

					<p>As a result of its superior mid-mountain, ski-in / ski-out access, in 2018 Empire Pass condominium product commanded a 20% price premium relative to other Deer Valley offerings and a 90% premium over neighboring Park City product. With average condo pricing in excess of $3,000,000 in 2018, the superior location of Empire Pass has led to superior sales volume and pricing over proximate condominium projects in Lower Deer Valley or the Canyons.</p>

					<p>January 1, 2018 thru November 2018:</p>

					<div style="margin-left:20px">
						<table >
							<tr class="charcoal">
								<td class="text-left">Sales Volume :</td>
								<td class="text-right">&nbsp;&nbsp;&nbsp;$147,786,104 </td>
							</tr>
							<tr class="charcoal">
								<td class="text-left">Average Price :</td>
								<td class="text-right">$3,078,877 </td>
							</tr>
							<tr class="charcoal">
								<td class="text-left">Avg Price / sf :</td>
								<td class="text-right">$1,183 </td>
							</tr>
						</table>
					</div>
					<br>

					<button id="empire_condo_sales_table_btn" type="button" class="btn btn-proforma-color">Show Table</button>

					<div id="empire_condo_sales_table_wrapper" style="display:none;margin-top:0px">
						<h3 style="color:white">EMPIRE PASS CONDOMINIUM SALES (2004- Nov 2018 )</h3>
						<table id="empire_condo_sales_table" class="table" >

							<thead>

								<tr class="dark-grey">
									<th class="dark-grey left">Project</th>
									<th class="dark-grey right">2018</th>
									<th class="dark-grey right">2017</th>
									<th class="dark-grey right">2016</th>
									<th class="dark-grey right">2015</th>
									<th class="dark-grey right">2014</th>
									<th class="dark-grey right">2013</th>
									<th class="dark-grey right">2012</th>
									<th class="dark-grey right">2011</th>
									<th class="dark-grey right">2010</th>
									<th class="dark-grey right">2009</th>
									<th class="dark-grey right">2008</th>
									<th class="dark-grey right">2007</th>
									<th class="dark-grey right">2006</th>
									<th class="dark-grey right">2005</th>
									<th class="dark-grey right">2004</th>
								</tr>

							</thead>

							<tbody>

							<!-- Shooting Star -->

								<tr class="light-grey">
									<td class="light-grey">Shooting Star (21 units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'></td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'>2</td>
									<td class='right'>6</td>
									<td class='right'>15</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$1,220,000</td>
									<td class='right'>$1,725,000</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'>$1,725,005</td>
									<td class='right'>$1,150,000</td>
									<td class='right'>$1,275,000</td>
									<td class='right'></td>
									<td class='right'>$1,700,000</td>
									<td class='right'>$2,200,000</td>
									<td class='right'>$2,250,000</td>
									<td class='right'>$3,210,000</td>
									<td class='right'>$10,814,000</td>
									<td class='right'>$19,557,200</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>1351</td>
									<td class='right'>1745</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'>2,114</td>
									<td class='right'>1,442</td>
									<td class='right'>2,114</td>
									<td class='right'></td>
									<td class='right'>2,024</td>
									<td class='right'>2,114</td>
									<td class='right'>2,114</td>
									<td class='right'>3,653</td>
									<td class='right'>12,410</td>
									<td class='right'>25,987</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$1,220,000</td>
									<td class='right'>$1,725,000</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'>$1,725,000</td>
									<td class='right'>$1,150,000</td>
									<td class='right'>$1,275,000</td>
									<td class='right'></td>
									<td class='right'>$1,700,000</td>
									<td class='right'>$2,200,000</td>
									<td class='right'>$2,250,000</td>
									<td class='right'>$1,605,000</td>
									<td class='right'>$1,802,333</td>
									<td class='right'>$1,303,813</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>1351</td>
									<td class='right'>1745</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'>2,114</td>
									<td class='right'>1,442</td>
									<td class='right'>2,114</td>
									<td class='right'></td>
									<td class='right'>2,024</td>
									<td class='right'>2,114</td>
									<td class='right'>2,114</td>
									<td class='right'>1,827</td>
									<td class='right'>2,068</td>
									<td class='right'>1,732</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$903</td>
									<td class='right'>$989</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'>$816</td>
									<td class='right'>$798</td>
									<td class='right'>$603</td>
									<td class='right'></td>
									<td class='right'>$840</td>
									<td class='right'>$1,041</td>
									<td class='right'>$1,064</td>
									<td class='right'>$879</td>
									<td class='right'>$871</td>
									<td class='right'>$753</td>
								</tr>
							<!-- ************* -->

							<!-- Arrow Leaf -->

								<tr class="light-grey">
									<td class="light-grey">Arrow Leaf (56 units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>6</td>
									<td class='right'>5</td>
									<td class='right'>3</td>
									<td class='right'>2</td>
									<td class='right'>2</td>
									<td class='right'>3</td>
									<td class='right'>3</td>
									<td class='right'>5</td>
									<td class='right'>6</td>
									<td class='right'>2</td>
									<td class='right'></td>
									<td class='right'>15</td>
									<td class='right'>17</td>
									<td class='right'>24</td>
									<td class='right'></td>

								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$8,844,000</td>
									<td class='right'>$8,550,000</td>
									<td class='right'>$4,845,000</td>
									<td class='right'>$3,875,000</td>
									<td class='right'>$3,175,000</td>
									<td class='right'>$4,565,000</td>
									<td class='right'>$4,710,000</td>
									<td class='right'>$5,850,000</td>
									<td class='right'>$8,124,500</td>
									<td class='right'>$3,550,000</td>
									<td class='right'></td>
									<td class='right'>$32,852,000</td>
									<td class='right'>$38,657,440</td>
									<td class='right'>$44,355,161</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>10,021</td>
									<td class='right'>9,006</td>
									<td class='right'>4,874</td>
									<td class='right'>3,969</td>
									<td class='right'>3,640</td>
									<td class='right'>5,060</td>
									<td class='right'>5,398</td>
									<td class='right'>8,303</td>
									<td class='right'>10,678</td>
									<td class='right'>3,560</td>
									<td class='right'></td>
									<td class='right'>26,334</td>
									<td class='right'>32,774</td>
									<td class='right'>41,529</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$1,474,000</td>
									<td class='right'>$1,710,000</td>
									<td class='right'>$1,615,000</td>
									<td class='right'>$1,937,500</td>
									<td class='right'>$1,587,500</td>
									<td class='right'>$1,521,667</td>
									<td class='right'>$1,570,000</td>
									<td class='right'>$1,170,000</td>
									<td class='right'>$1,354,083</td>
									<td class='right'>$1,775,800</td>
									<td class='right'></td>
									<td class='right'>$2,190,133</td>
									<td class='right'>$2,273,967</td>
									<td class='right'>$1,848,132</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>1,670</td>
									<td class='right'>1,801</td>
									<td class='right'>1,625</td>
									<td class='right'>1,985</td>
									<td class='right'>1,820</td>
									<td class='right'>1,687</td>
									<td class='right'>1,799</td>
									<td class='right'>1,661</td>
									<td class='right'>1,780</td>
									<td class='right'>1,780</td>
									<td class='right'></td>
									<td class='right'>1,756</td>
									<td class='right'>1,928</td>
									<td class='right'>1,730</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$877</td>
									<td class='right'>$946</td>
									<td class='right'>$994</td>
									<td class='right'>$976</td>
									<td class='right'>$872</td>
									<td class='right'>$902</td>
									<td class='right'>$873</td>
									<td class='right'>$705</td>
									<td class='right'>$761</td>
									<td class='right'>$997</td>
									<td class='right'></td>
									<td class='right'>$1,248</td>
									<td class='right'>$1,180</td>
									<td class='right'>$1,068</td>
									<td class='right'></td>
								</tr>
							<!-- ********** -->

							<!-- Grand Lodge -->

								<tr class="light-grey">
									<td class="light-grey">Grand Lodge (27 Units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>4</td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'>2</td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'>2</td>
									<td class='right'></td>
									<td class='right'>1</td>
									<td class='right'>1</td>
									<td class='right'>2</td>
									<td class='right'>3</td>
									<td class='right'>1</td>
									<td class='right'>23</td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$8,044,000</td>
									<td class='right'>$2,740,000</td>
									<td class='right'>$2,350,000</td>
									<td class='right'>$3,950,000</td>
									<td class='right'>$1,994,050</td>
									<td class='right'>$1,750,000</td>
									<td class='right'>$3,000,000</td>
									<td class='right'></td>
									<td class='right'>$3,295,000</td>
									<td class='right'>$1,995,000</td>
									<td class='right'>$5,825,000</td>
									<td class='right'>$8,821,004</td>
									<td class='right'>$3,995,000</td>
									<td class='right'>$52,511,500</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>8,679</td>
									<td class='right'>3,264</td>
									<td class='right'>2,467</td>
									<td class='right'>4,134</td>
									<td class='right'>2,290</td>
									<td class='right'>2,067</td>
									<td class='right'>4,104</td>
									<td class='right'></td>
									<td class='right'>3,243</td>
									<td class='right'>2,067</td>
									<td class='right'>5,342</td>
									<td class='right'>7,592</td>
									<td class='right'>3,243</td>
									<td class='right'>54,457</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$2,011,000</td>
									<td class='right'>$2,740,000</td>
									<td class='right'>$2,350,000</td>
									<td class='right'>$1,975,000</td>
									<td class='right'>$1,995,050</td>
									<td class='right'>$1,750,000</td>
									<td class='right'>$1,500,000</td>
									<td class='right'></td>
									<td class='right'>$3,295,000</td>
									<td class='right'>$1,995,000</td>
									<td class='right'>$2,912,500</td>
									<td class='right'>$2,940,335</td>
									<td class='right'>$3,995,000</td>
									<td class='right'>$2,283,109</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>2,170</td>
									<td class='right'>3,264</td>
									<td class='right'>2,467</td>
									<td class='right'>2,067</td>
									<td class='right'>2,290</td>
									<td class='right'>2,067</td>
									<td class='right'>2,052</td>
									<td class='right'></td>
									<td class='right'>3,243</td>
									<td class='right'>2,067</td>
									<td class='right'>2,671</td>
									<td class='right'>2,531</td>
									<td class='right'>3,243</td>
									<td class='right'>2,368</td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$931</td>
									<td class='right'>$839</td>
									<td class='right'>$953</td>
									<td class='right'>$955</td>
									<td class='right'>$871</td>
									<td class='right'>$847</td>
									<td class='right'>$731</td>
									<td class='right'></td>
									<td class='right'>$1,016</td>
									<td class='right'>$965</td>
									<td class='right'>$1,090</td>
									<td class='right'>$1,162</td>
									<td class='right'>$1,232</td>
									<td class='right'>$964</td>
									<td class='right'></td>
								</tr>
							<!-- ********** -->

							<!-- Silver Strike -->

								<tr class="light-grey">
									<td class="light-grey">Silver Strike (34 units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>4</td>
									<td class='right'>1</td>
									<td class='right'>5</td>
									<td class='right'>1</td>
									<td class='right'>3</td>
									<td class='right'>2</td>
									<td class='right'>3</td>
									<td class='right'>2</td>
									<td class='right'>15</td>
									<td class='right'>1</td>
									<td class='right'>2</td>
									<td class='right'>8</td>
									<td class='right'>4</td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$8,327,500</td>
									<td class='right'>$2,400,000</td>
									<td class='right'>$11,720,250</td>
									<td class='right'>$1,420,000</td>
									<td class='right'>$8,240,000</td>
									<td class='right'>$5,550,000</td>
									<td class='right'>$6,380,000</td>
									<td class='right'>$3,905,000</td>
									<td class='right'>$23,917,000</td>
									<td class='right'>$2,350,000</td>
									<td class='right'>$5,130,000</td>
									<td class='right'>$22,654,000</td>
									<td class='right'>$10,350,000</td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>8,587</td>
									<td class='right'>2,253</td>
									<td class='right'>11,864</td>
									<td class='right'>1,697</td>
									<td class='right'>7,469</td>
									<td class='right'>5,250</td>
									<td class='right'>7,932</td>
									<td class='right'>4,790</td>
									<td class='right'>31,498</td>
									<td class='right'>2,255</td>
									<td class='right'>3,878</td>
									<td class='right'>18,202</td>
									<td class='right'>8,463</td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$2,081,875</td>
									<td class='right'>$2,400,000</td>
									<td class='right'>$2,344,050</td>
									<td class='right'>$1,420,000</td>
									<td class='right'>$2,746,667</td>
									<td class='right'>$2,775,000</td>
									<td class='right'>$2,126,667</td>
									<td class='right'>$1,952,500</td>
									<td class='right'>$1,594,467</td>
									<td class='right'>$2,350,000</td>
									<td class='right'>$2,565,000</td>
									<td class='right'>$2,831,750</td>
									<td class='right'>$2,587,500</td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>2,147</td>
									<td class='right'>2,253</td>
									<td class='right'>2,373</td>
									<td class='right'>1,697</td>
									<td class='right'>2,490</td>
									<td class='right'>2,625</td>
									<td class='right'>2,644</td>
									<td class='right'>2,395</td>
									<td class='right'>2,100</td>
									<td class='right'>2,255</td>
									<td class='right'>1,939</td>
									<td class='right'>2,275</td>
									<td class='right'>2,116</td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$964</td>
									<td class='right'>$1,065</td>
									<td class='right'>$988</td>
									<td class='right'>$837</td>
									<td class='right'>$1,103</td>
									<td class='right'>$1,057</td>
									<td class='right'>$804</td>
									<td class='right'>$815</td>
									<td class='right'>$759</td>
									<td class='right'>$1,042</td>
									<td class='right'>$1,323</td>
									<td class='right'>$1,245</td>
									<td class='right'>$1,223</td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>
							<!-- ************* -->

							<!-- Flagstaff -->

								<tr class="light-grey">
									<td class="light-grey">Flagstaff (37 units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'></td>
									<td class='right'>3</td>
									<td class='right'>2</td>
									<td class='right'>1</td>
									<td class='right'>8</td>
									<td class='right'>1</td>
									<td class='right'>4</td>
									<td class='right'>10</td>
									<td class='right'>17</td>
									<td class='right'>2</td>
									<td class='right'>5</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'></td>
									<td class='right'>$8,860,000</td>
									<td class='right'>$5,080,000</td>
									<td class='right'>$1,950,000</td>
									<td class='right'>$15,842,500</td>
									<td class='right'>$2,112,500</td>
									<td class='right'>$9,418,500</td>
									<td class='right'>$20,778,000</td>
									<td class='right'>$36,098,400</td>
									<td class='right'>$4,636,000</td>
									<td class='right'>$10,417,000</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'></td>
									<td class='right'>6,853</td>
									<td class='right'>4,280</td>
									<td class='right'>1,749</td>
									<td class='right'>16,100</td>
									<td class='right'>2,140</td>
									<td class='right'>9,032</td>
									<td class='right'>20,409</td>
									<td class='right'>37,156</td>
									<td class='right'>4,241</td>
									<td class='right'>10,493</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'></td>
									<td class='right'>$2,953,333</td>
									<td class='right'>$2,540,000</td>
									<td class='right'>$1,950,000</td>
									<td class='right'>$1,980,313</td>
									<td class='right'>$2,112,500</td>
									<td class='right'>$2,354,625</td>
									<td class='right'>$2,077,800</td>
									<td class='right'>$2,123,435</td>
									<td class='right'>$2,318,000</td>
									<td class='right'>$2,083,400</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'></td>
									<td class='right'>2,284</td>
									<td class='right'>2,140</td>
									<td class='right'>1,749</td>
									<td class='right'>2,013</td>
									<td class='right'>2,140</td>
									<td class='right'>2,258</td>
									<td class='right'>2,041</td>
									<td class='right'>2,186</td>
									<td class='right'>2,121</td>
									<td class='right'>2,099</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'></td>
									<td class='right'>$1,279</td>
									<td class='right'>$1,187</td>
									<td class='right'>$1,115</td>
									<td class='right'>$984</td>
									<td class='right'>$987</td>
									<td class='right'>$1,043</td>
									<td class='right'>$1,018</td>
									<td class='right'>$972</td>
									<td class='right'>$1,093</td>
									<td class='right'>$993</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>
							<!-- ********* -->

							<!-- Montage -->

								<tr class="light-grey">
									<td class="light-grey">Montage (81 units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>3</td>
									<td class='right'>11</td>
									<td class='right'>5</td>
									<td class='right'>19</td>
									<td class='right'>14</td>
									<td class='right'>10</td>
									<td class='right'>10</td>
									<td class='right'>11</td>
									<td class='right'>3</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$14,565,000</td>
									<td class='right'>$34,820,250</td>
									<td class='right'>$22,167,500</td>
									<td class='right'>$71,751,250</td>
									<td class='right'>$55,061,400</td>
									<td class='right'>$37,765,000</td>
									<td class='right'>$39,328,760</td>
									<td class='right'>$42,242,400</td>
									<td class='right'>$9,138,000</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>9,991</td>
									<td class='right'>26,155</td>
									<td class='right'>14,852</td>
									<td class='right'>49,732</td>
									<td class='right'>39,666</td>
									<td class='right'>27,169</td>
									<td class='right'>30,825</td>
									<td class='right'>32,300</td>
									<td class='right'>6,955</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$4,858,333</td>
									<td class='right'>$3,165,477</td>
									<td class='right'>$4,433,500</td>
									<td class='right'>$3,776,382</td>
									<td class='right'>$3,932,957</td>
									<td class='right'>$3,776,500</td>
									<td class='right'>$3,932,876</td>
									<td class='right'>$3,840,218</td>
									<td class='right'>$3,046,000</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>3,330</td>
									<td class='right'>2,378</td>
									<td class='right'>2,970</td>
									<td class='right'>2,617</td>
									<td class='right'>2,833</td>
									<td class='right'>2,717</td>
									<td class='right'>3,083</td>
									<td class='right'>2,936</td>
									<td class='right'>2,318</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$1,426</td>
									<td class='right'>$1,324</td>
									<td class='right'>$1,497</td>
									<td class='right'>$1,443</td>
									<td class='right'>$1,388</td>
									<td class='right'>$1,390</td>
									<td class='right'>$1,276</td>
									<td class='right'>$1,308</td>
									<td class='right'>$1,314</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>
							<!-- ******* -->

							<!-- Stein Eriksen -->

								<tr class="light-grey">
									<td class="light-grey">Stein Eriksen (39 units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>4</td>
									<td class='right'>18</td>
									<td class='right'>17</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$19,512,999</td>
									<td class='right'>$77,691,555</td>
									<td class='right'>$63,559,508</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>18,731</td>
									<td class='right'>61,206</td>
									<td class='right'>55,817</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$4,878,250</td>
									<td class='right'>$4,316,198</td>
									<td class='right'>$3,738,795</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>4,683</td>
									<td class='right'>3,400</td>
									<td class='right'>3,283</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$1,041</td>
									<td class='right'>$1,269</td>
									<td class='right'>$1,158</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>
							<!-- ************* -->

							<!-- One Empire -->

								<tr class="light-grey">
									<td class="light-grey">One Empire (27 Units)</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>26</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$87,262,605</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>67,515</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$3,356,254</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>2,597</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$1,288</td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
									<td class='right'></td>
								</tr>
							<!-- ************* -->

							<!-- Total Transactions -->

								<tr class="light-grey">
									<td class="light-grey">Total Transactions</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="basic">
									<td class=" left padding-left">Units Sold</td>
									<td class='right'>48</td>
									<td class='right'>40</td>
									<td class='right'>33</td>
									<td class='right'>25</td>
									<td class='right'>28</td>
									<td class='right'>18</td>
									<td class='right'>23</td>
									<td class='right'>29</td>
									<td class='right'>42</td>
									<td class='right'>7</td>
									<td class='right'>10</td>
									<td class='right'>27</td>
									<td class='right'>24</td>
									<td class='right'>53</td>
									<td class='right'>15</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross Sales Volume</td>
									<td class='right'>$147,786,104</td>
									<td class='right'>$136,786,805</td>
									<td class='right'>$109,722,258</td>
									<td class='right'>$82,946,250</td>
									<td class='right'>$84,312,950</td>
									<td class='right'>$53,467,500</td>
									<td class='right'>$63,987,260</td>
									<td class='right'>$74,050,400</td>
									<td class='right'>$80,572,900</td>
									<td class='right'>$14,231,000</td>
									<td class='right'>$23,572,000</td>
									<td class='right'>$66,577,004</td>
									<td class='right'>$56,212,440</td>
									<td class='right'>$107,680,661</td>
									<td class='right'>$19,557,200</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Gross S.F. sold</td>
									<td class='right'>124,875</td>
									<td class='right'>110,482</td>
									<td class='right'>94,154</td>
									<td class='right'>61,281</td>
									<td class='right'>69,165</td>
									<td class='right'>43,800</td>
									<td class='right'>58,733</td>
									<td class='right'>67,916</td>
									<td class='right'>89,530</td>
									<td class='right'>14,147</td>
									<td class='right'>21,827</td>
									<td class='right'>54,242</td>
									<td class='right'>48,133</td>
									<td class='right'>108,396</td>
									<td class='right'>25,987</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Sales Price</td>
									<td class='right'>$3,078,877</td>
									<td class='right'>$3,419,670</td>
									<td class='right'>$3,324,917</td>
									<td class='right'>$3,317,850</td>
									<td class='right'>$3,011,213</td>
									<td class='right'>$2,970,417</td>
									<td class='right'>$2,782,055</td>
									<td class='right'>$2,553,462</td>
									<td class='right'>$1,918,402</td>
									<td class='right'>$2,033,000</td>
									<td class='right'>$2,357,200</td>
									<td class='right'>$2,465,815</td>
									<td class='right'>$2,342,185</td>
									<td class='right'>$2031,711</td>
									<td class='right'>$1,303,813</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. S.F. / Unit</td>
									<td class='right'>2,602</td>
									<td class='right'>2,762</td>
									<td class='right'>2,853</td>
									<td class='right'>2,451</td>
									<td class='right'>2,470</td>
									<td class='right'>2,433</td>
									<td class='right'>2,554</td>
									<td class='right'>2,342</td>
									<td class='right'>2,132</td>
									<td class='right'>2,021</td>
									<td class='right'>2,183</td>
									<td class='right'>2,009</td>
									<td class='right'>2,006</td>
									<td class='right'>2,045</td>
									<td class='right'>1,732</td>
								</tr>

								<tr class="basic">
									<td class="left padding-left">Avg. Price / S.F.</td>
									<td class='right'>$1,183</td>
									<td class='right'>$1,238</td>
									<td class='right'>$1,165</td>
									<td class='right'>$1,354</td>
									<td class='right'>$1,219</td>
									<td class='right'>$1,221</td>
									<td class='right'>$1,089</td>
									<td class='right'>$1,090</td>
									<td class='right'>$900</td>
									<td class='right'>$1,006</td>
									<td class='right'>$1,080</td>
									<td class='right'>$1,227</td>
									<td class='right'>$1,169</td>
									<td class='right'>$993</td>
									<td class='right'>$753</td>
								</tr>
							<!-- ************* -->


							</tbody>
						</table>
						<!-- <div class="table-footer">
							<p>*Stein Eriksen 2015 transactions are non-refundable presales</p>
						</div> -->
					</div>
				</div>

				<!-- <img src="images/offering/empire_village_1200x300.jpg"> -->
				<div style="background-color:#333; padding: 20px 40px 40px 40px; color:white; width:100%; display:none">

					<h3 style="font-family:'Times New Roman';color:white">EMPIRE PASS - 2018 TOWNHOME SALES</h3>

					<p>With average townhome pricing in excess of $4,900,000 in 2018, the superior location of Empire Pass has led to superior sales volume and pricing, resulting in a significant price premium other townhome product in Deer Valley.</p>

					<p>August 2017 thru November 2018:</p>

					<div style="margin-left:20px">
						<table >
							<tr class="charcoal">
								<td class="text-left">Sales Volume&nbsp; :</td>
								<td class="text-right">&nbsp;&nbsp;&nbsp;$52,222,855</td>
							</tr>
							<tr class="charcoal">
								<td class="text-left">Average Price&nbsp; :</td>
								<td class="text-right">$4,900,000 </td>
							</tr>
							<tr class="charcoal">
								<td class="text-left">Average Price&nbsp; :</td>
								<td class="text-right">$1,042 </td>
							</tr>
						</table>
					</div>
					<br>

					<button id="empire_sales_table_btn" type="button" class="btn btn-proforma-color">Show Table</button>

					<div id="empire_sales_table_wrapper" style="display:none;margin-top:0px">
						<h3 style="color:white">EMPIRE PASS TOWNHOME SALES</h3>

					<table id="empire_sales_table" class="table">
						<thead>
							<tr>
								<th title="Field #3">Subdivision</th>
								<th title="Field #2">Status</th>
								<th title="Field #1">Property Type</th>
								<th title="Field #4">Beds</th>
								<th title="Field #5">Baths</th>
								<th title="Field #6">Sq Ft Total</th>
								<th title="Field #7">List Price</th>
								<th title="Field #8">List Per SF</th>
								<th title="Field #9">Close Price</th>
								<th title="Field #10">Sold Per SF</th>
								<th title="Field #11">List:Close Ratio</th>
								<th title="Field #12">DOM</th>
								<th title="Field #13">Close Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<td>Ironwood</td>
							<td>Active</td>
							<td>Condominium</td>
							<td align="right">4</td>
							<td align="right">6</td>
							<td align="right">3025</td>
							<td>$3,250,000</td>
							<td>$1,074</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td align="right">273</td>
							<td> </td>
							</tr>
							<tr>
							<td>Nakoma</td>
							<td>Active</td>
							<td>Single Family</td>
							<td align="right">5</td>
							<td align="right">6</td>
							<td align="right">5548</td>
							<td>$5,500,000</td>
							<td>$991</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td align="right">24</td>
							<td> </td>
							</tr>
							<tr>
							<td>Nakoma</td>
							<td>Active</td>
							<td>Single Family</td>
							<td align="right">5</td>
							<td align="right">6</td>
							<td align="right">6325</td>
							<td>$5,895,000</td>
							<td>$932</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td align="right">143</td>
							<td> </td>
							</tr>
							<tr>
							<td><a href="http://www.tourbuzz.net/public/vtour/display?idx=1&mlsId=257&mlsNumber=1455777" target="_blank">Paintbrush</a></td>
							<td>Active</td>
							<td>Single Family</td>
							<td align="right">5</td>
							<td align="right">6</td>
							<td align="right">4671</td>
							<td>$6,175,000</td>
							<td>$1,322</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td align="right">510</td>
							<td> </td>
							</tr>
							<tr>
							<td><a href="http://www.spotlighthometours.com/tours/tour.php?mls=11805165&state=UT" target="_blank">The Belles</a></td>
							<td>Active</td>
							<td>Condominium</td>
							<td align="right">5</td>
							<td align="right">7</td>
							<td align="right">4442</td>
							<td>$6,375,000</td>
							<td>$1,435</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td align="right">91</td>
							<td> </td>
							</tr>
							<tr>
							<td><a href="http://www.spotlighthometours.com/tours/tour.php?mls=11704852&state=UT" target="_blank">The Belles</a></td>
							<td>Active</td>
							<td>Single Family</td>
							<td align="right">5</td>
							<td align="right">6</td>
							<td align="right">7517</td>
							<td>$6,850,000</td>
							<td>$911</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td align="right">321</td>
							<td> </td>
							</tr>
							<tr>
							<td><a href="http://www.spotlighthometours.com/tours/tour.php?mls=11501216&state=UT" target="_blank">Nakoma</a></td>
							<td>Pending</td>
							<td>Single Family</td>
							<td align="right">5</td>
							<td align="right">8</td>
							<td align="right">6287</td>
							<td>$6,275,000</td>
							<td>$998</td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td align="right">1274</td>
							<td> </td>
							</tr>
							<tr>
							<td>Larkspur</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">4</td>
							<td align="right">5</td>
							<td align="right">3027</td>
							<td>$2,695,000</td>
							<td>$913</td>
							<td>$2,600,000</td>
							<td>$881</td>
							<td>96%</td>
							<td align="right">120</td>
							<td>1/30/18</td>
							</tr>
							<tr>
							<td>Larkspur</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">4</td>
							<td align="right">5</td>
							<td align="right">3614</td>
							<td>$3,495,000</td>
							<td>$967</td>
							<td>$3,300,000</td>
							<td>$913</td>
							<td>94%</td>
							<td align="right">278</td>
							<td>8/23/17</td>
							</tr>
							<tr>
							<td>Larkspur</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">4</td>
							<td align="right">5</td>
							<td align="right">2936</td>
							<td>$3,550,000</td>
							<td>$1,209</td>
							<td>$3,415,500</td>
							<td>$1,163</td>
							<td>96%</td>
							<td align="right">100</td>
							<td>10/11/18</td>
							</tr>
							<tr>
							<td>Ironwood</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">4</td>
							<td align="right">6</td>
							<td align="right">3889</td>
							<td>$3,590,000</td>
							<td>$923</td>
							<td>$3,520,000</td>
							<td>$905</td>
							<td>98%</td>
							<td align="right">20</td>
							<td>2/15/18</td>
							</tr>
							<tr>
							<td>Nakoma</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">5</td>
							<td align="right">7</td>
							<td align="right">4841</td>
							<td>$3,950,000</td>
							<td>$816</td>
							<td>$3,750,000</td>
							<td>$775</td>
							<td>95%</td>
							<td align="right">34</td>
							<td>9/11/17</td>
							</tr>
							<tr>
							<td>Ironwood</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">4</td>
							<td align="right">6</td>
							<td align="right">3892</td>
							<td>$4,100,000</td>
							<td>$1,053</td>
							<td>$3,900,000</td>
							<td>$1,002</td>
							<td>95%</td>
							<td align="right">40</td>
							<td>2/7/18</td>
							</tr>
							<tr>
							<td>Nakoma</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">5</td>
							<td align="right">7</td>
							<td align="right">4841</td>
							<td>$4,250,000</td>
							<td>$878</td>
							<td>$4,000,000</td>
							<td>$826</td>
							<td>94%</td>
							<td align="right">185</td>
							<td>1/5/18</td>
							</tr>
							<tr>
							<td>The Belles</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">5</td>
							<td align="right">7</td>
							<td align="right">4442</td>
							<td>$4,675,000</td>
							<td>$1,052</td>
							<td>$4,200,000</td>
							<td>$946</td>
							<td>90%</td>
							<td align="right">361</td>
							<td>5/9/18</td>
							</tr>
							<tr>
							<td>The Belles</td>
							<td>Closed</td>
							<td>Condominium</td>
							<td align="right">5</td>
							<td align="right">7</td>
							<td align="right">4530</td>
							<td>$4,750,000</td>
							<td>$1,049</td>
							<td>$4,987,355</td>
							<td>$1,101</td>
							<td>105%</td>
							<td align="right">361</td>
							<td>7/26/18</td>
							</tr>
							<tr>
							<td>Paintbrush</td>
							<td>Closed</td>
							<td>Single Family</td>
							<td align="right">5</td>
							<td align="right">6</td>
							<td align="right">5000</td>
							<td>$5,950,000</td>
							<td>$1,190</td>
							<td>$5,900,000</td>
							<td>$1,180</td>
							<td>99%</td>
							<td align="right">515</td>
							<td>6/29/18</td>
							</tr>
							<tr>
							<td>The Belles</td>
							<td>Closed</td>
							<td>Single Family</td>
							<td align="right">5</td>
							<td align="right">6</td>
							<td align="right">5798</td>
							<td>$6,875,000</td>
							<td>$1,186</td>
							<td>$6,375,000</td>
							<td>$1,100</td>
							<td>93%</td>
							<td align="right">798</td>
							<td>10/12/18</td>
							</tr>
						</tbody>
					</table>

					</div>
				</div>

				<img src="images/offering/sunset_vista.jpg">
				<div style="background-color:#333; padding:20px 40px 40px 40px; color:white; width:100%">

					<h3 style="font-family:'Times New Roman'; color:white">EMPIRE PASS - ENTITLEMENT</h3>

					<p>Empire Pass is the master planned anchor to the Flagstaff Development Agreement executed June 24, 1999 between United Park City Mines Company (UPCM), Deer Valley and Park City Municipal Corporation for mid-mountain community development on Flagstaff Mountain, one of the most prominent mountains in the prestigious Deer Valley Resort.  By definition, the Flagstaff Mountain development area is composed of several neighborhoods including the Mountain Village and the Northside Neighborhood, various ski related improvements, and the Silver Mine Adventure. The Flagstaff Development Agreement governs the 106 acres of Empire Pass and restricts development to a maximum density of 785 unit equivalents and / or 550 dwelling units. As stated in the Development Agreement, unit equivalents are defined as 1 unit per 2,000 SF of residential and 1 unit per 1,000 sf for commercial development. Additionally, the Agreement states density may be comprised of a mix of multifamily, hotel, PUD units, and single family, as long as PUD units do not exceed 60 and single family units do not exceed 16.</p> <!--Please refer to the <a id="development_agreement_link" style="color:#c9a182" href=''>Development Agreement</a> for more details.</p>-->

					<button id="flagstaff_table_btn" type="button" class="btn btn-proforma-color">Show Table</button>

					<div id="flagstaff_table_wrapper" style="display:none">
						<h3 style="color:white">DEVELOPMENT DENSITY SUMMARY</h3>
						<h3 style="color:white; margin-top:20px">Completed Projects</h3>

						<table id="flagstaff_built_table" class="table" style="width:100%">
							<thead>
								<tr>
									<th style="padding-left:5px">Location</th>
									<th style="text-align:left">Description</th>
									<th>Type</th>
									<th><div>Total Net</div><div>SF</div></th>
									<th><div>Unit</div><div>Equivalent</div></th>
									<th>Total MF</th>
									<th><div>Units as</div><div>PUDS</div></th>
									<th>Single Family</th>
								</tr>
							</thead>

							<tbody>

								<tr class="light-grey">
									<td>Pod A</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr style="color:black">
									<td></td>
									<td style="text-align:left">Shooting Star</td>
									<td>Lodge</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">One Empire Pass</td>
									<td>Lodge</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Silver Strike</td>
									<td>Lodge</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Flagstaff Lodge</td>
									<td>Lodge</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Arrow Leaf A & B</td>
									<td>Lodge</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Grand Lodge</td>
									<td>Lodge</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Belles</td>
									<td>PUD</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>


								<tr>
									<td></td>
									<td style="text-align:left">Paintbrush</td>
									<td>PUD</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Larkspur East</td>
									<td>TH</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Larkspur West</td>
									<td>TH</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Bannerwood</td>
									<td>SF</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<!-- <tr style="border-bottom: 1px solid black">
									<td></td>
									<td style="text-align:left">Marsac Claim</td>
									<td>-</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr> -->

								<tr style="font-weight:bold">
									<td></td>
									<td style="text-align:left">Total</td>
									<td></td>
									<td>654,448</td>
									<td>327.7</td>
									<td>260</td>
									<td>35</td>
									<td>6</td>
								</tr>

								<tr class="light-grey">
									<td>Pod B1 & B2</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Nakoma</td>
									<td>PUD</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Ironwood</td>
									<td>TH</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Northside Village</td>
									<td>SF</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr style="border-bottom: 1px solid black">
									<td></td>
									<td style="text-align:left">Montage</td>
									<td>Lodge</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr style="font-weight:bold">
									<td></td>
									<td style="text-align:left">Total</td>
									<td></td>
									<td>531,080</td>
									<td>265.6</td>
									<td>121</td>
									<td>17</td>
									<td>10</td>
								</tr>

								<tr class="light-grey">
									<td>Pod D</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Red Cloud</td>
									<td>SF</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>30</td>
								</tr>

								<tr style="font-weight:normal; background-color:#666; color:white; font-size:1.2em">
									<td style="text-align:left; padding-left:5px">Total Built</td>
									<td></td>
									<td></td>
									<td>1,185,528</td>
									<td>593.3</td>
									<td>381</td>
									<td>52</td>
									<td>46</td>
								</tr>
							</tbody>
						</table>

						<br>
						<h3 style="color:white">Remaining Parcels</h3>

						<table id="flagstaff_unbuilt_table" class="table" style="width:100%">
							<thead>
								<tr style="background-color:#204060!important; color:white">
									<th style="padding-left:5px">Location</th>
									<th style="text-align:left; ">Description</th>
									<th>Type</th>
									<th><div>Total Net</dvi><div>SF</div></th>
									<th><div>Unit</div><div>Equivalent</div></th>
									<th>Total MF</th>
									<th><div>Units as</div><div>PUDS</div></th>
									<th>Single Family</th>
								</tr>
							</thead>

							<tbody>

								<tr class="light-grey">
									<td>Pod A</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Tower Residences</td>
									<td>Lodge</td>
									<td>41,640</td>
									<td>20.9</td>
									<td>15</td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Empire Residences</td>
									<td>Lodge</td>
									<td>49,000</td>
									<td>24.5</td>
									<td>23</td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Parcel 4</td>
									<td>Lodge</td>
									<td>64,000</td>
									<td>32</td>
									<td>32</td>
									<td></td>
									<td></td>
								</tr>

								<tr style="border-bottom: 1px solid black">
									<td></td>
									<td style="text-align:left">Moon Shadow</td>
									<td>TH</td>
									<td>68,000</td>
									<td>34</td>
									<td>17</td>
									<td>8</td>
									<td></td>
								</tr>


								<tr style="font-weight:bold">
									<td></td>
									<td style="text-align:left">Total</td>
									<td></td>
									<td>222,640</td>
									<td>111.4</td>
									<td>88</td>
									<td>8</td>
									<td>0</td>
								</tr>

								<tr class="light-grey">
									<td >Pod B1 & B2</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td style="text-align:left">Sommet Blanc</td>
									<td>Lodge</td>
									<td>162,000</td>
									<td>81</td>
									<td>81</td>
									<td></td>
									<td>30</td>
								</tr>

								<tr style="font-weight:normal; background-color:#666; color:white;font-size:1.2em">
									<td style="text-align:left; padding-left:5px">Total Unbuilt</td>
									<td></td>
									<td></td>
									<td>384,640</td>
									<td>192.4</td>
									<td>169</td>
									<td>8</td>
									<td>0</td>
								</tr>

								<tr class="charcoal">
									<td>&nbsp;</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="charcoal">
									<td style="color:white;font-size:22px;margin-left:0;text-align:left;padding-left:0; font-family:'Times New Roman'">Grand Total</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr class="dark-grey" style="font-weight:normal; font-size:1.2em">
									<td style="text-align:left; padding-left:5px">Total</td>
									<td></td>
									<td></td>
									<td>1,570,000</td>
									<td>785.0</td>
									<td>550</td>
									<td>60</td>
									<td>46</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<br><br>
			</article>

			<article id="empire" class="tab-pane fade">
				<br>

				<img src="images/offering/empire_village/down_canyon.jpg">

				<br>

			    <div class="text-panel">
					<img src="../sommetblanc/images/e_line.png">
					<h3 style="font-family:'Times New Roman'; color:white">EMPIRE PASS AT DEER VALLEY</h3>

					<p>Located on the slopes of Flagstaff Mountain, Empire Pass has become the preeminent ski in / ski out community in Park City. With direct connectivity to the Silver Strike Express and the Northside Express ski lifts, residents can be on their favorite Deer Valley ski slope within minutes of stepping out of their condominium or townhome. In addition to convenient access to Deer Valley slopes, residents can enjoy on-site check-in, personalized services, fireplaces and hot tub amenities. The rich amenity base at Empire Pass creates a place family and friends can reunite year after year, and new visitors can experience all that Deer Valley has to offer.</p>

					<p>Since delivering the first condominium unit in 2004, Empire Pass Village is now more than 85% built-out with over 300 luxury residences delivered to date.</p>

					<!-- <p>The crown jewel of Deer Valley, the Empire Pass development portfolio offering includes all remaining coveted development density and is fully entitled for 169 additional units.</p> -->

				</div>
				<br>

				<img src="images/offering/empire_village/up_canyon.jpg">

				<br>

			    <div class="text-panel">
					<img src="../sommetblanc/images/e_line.png">
					<h3 style="font-family:'Times New Roman'; color:white">FLAGSTAFF MOUNTAIN DEVELOPMENT AGREEMENT</h3>

					<p>Empire Pass is the master planned anchor to the Flagstaff Development Agreement executed June 24, 1999 between United Park City Mines Company (UPCM), Deer Valley Resort and Park City Municipal Corporation for mid-mountain community development on Flagstaff Mountain, one of the most prominent mountains in the prestigious Deer Valley Resort. By definition, the Flagstaff Mountain development area is composed of several neighborhoods including the Mountain Village and the Northside Neighborhood, various ski related improvements, and the Silver Mine Adventure.</p>

					<p>The Flagstaff Development Agreement governs the 106 acres of Empire Pass and restricts development to a maximum density of 785 unit equivalents and / or 550 dwelling units. As stated in the Development Agreement, unit equivalents are defined as 1 unit per 2,000 SF of residential and 1 unit per 1,000 sf for commercial development. Additionally, the Agreement states density may be comprised of a mix of multifamily, hotel, PUD units, and single family, as long as PUD units do not exceed 60 and single family units do not exceed 16.</p>

				</div>
				<br>

				<img src="images/offering/empire_village/village_site_plan.jpg">

				<br>

			    <div class="text-panel">
					<img src="../sommetblanc/images/e_line.png">
					<h3 style="font-family:'Times New Roman'; color:white">EMPIRE PASS VILLAGE</h3>

					<p>The Village at Empire Pass is a well-established mid-mountain community that is comprised of homes, condos and land located along the Silver Strike Express ski lift. The neighborhood includes the following built properties: Arrowleaf, Flagstaff, Larkspur, Paintbrush, Shooting Star, Silver Strike Lodge and Talisker Tower. Additionally, the neighborhood includes One Empire Pass, Empire Residences (currently under construction), Empire Pass Site 4 and the Moon Shadow eight lot subdivision. Empire Pass’s pedestrian network and connectivity to the Silver Strike Express allow residents to experience every aspect of Deer Valley and western mountain resort living in one, easily accessible location.</p>

				</div>
				<br>

				<!-- <img src="images/offering/empire_village/three_parcels.jpg">

				<br>

			    <div class="text-panel">
					<img src="../sommetblanc/images/e_line.png">
					<h3 style="font-family:'Times New Roman'; color:white">EMPIRE PASS SITES 3 & 4</h3>

					<p>Empire Pass Sites 3 and 4 represent two of the most valuable condo sites ever made available at Empire Pass. Set alongside the Silver Strike express ski lift and adjacent to the Talisker Tower Club, Sites 3 and 4 are graded and ready for a combined 113,000 SF of development. Entitlements are available to build up to 56 total units, creating a condominium community with the most sought after and convenient, direct ski lift access in all of Deer Valley. Site 3 offers 47,000 square feet of entitled sellable space, with a planned build-out of 23 units. Site 4 offers 66,000 square feet of entitled sellable space, with a planned build-out of 33 units.</p>

					<p style="font-family:'Times New Roman'; font-size:1.2em; margin-bottom:10px">MARSAC HORSESHOE</p>

					<p>Located across the street from Parcel 4, the Empire Townhome parcel features commanding views of Deer Valley, downtown Park City and the Wasatch mountains. These townhome sites represent some of the most exclusive remaining single-family product in Deer Valley. Given their views, location, privacy and orientation, the sites at Marsac Horseshoe will demand some of the highest prices in Empire Pass. Current plans include a connection with the Silver Strike ski lift via a pedestrian bridge over Marsac Avenue, adding a significant amount of convenience and value to these sites.
					</p>

					<p style="font-family:'Times New Roman'; font-size:1.2em; margin-bottom:10px">SURGING CONDO SALES PERFORMANCE</p>

					<p>Deer Valley continues to witness impressive residential demand growth, posting a record $205 million in condo sales volume in 2015 from 56 unit sales. With a dearth of remaining mid-mountain development opportunities, the highly anticipated delivery of the Stein Eriksen Residences demonstrated the incredible demand for ski-in ski-out Deer Valley product with 32 of the 39 condo units pre-sold or under contract, as of first quarter 2016, within 6 months of delivery at an average price of $3.9 million per residence of nearly $1,200 PSF. Further demonstrating the robust demand for newly delivered Empire Pass condominium product, One Empire Pass received reservations and security deposits in excess of $100,000 for 11 of its 27 planned condominiums within the first week of being made available. As the current mid-mountain condo inventory drops below 6 months of remaining supply, the Empire Residences Site presents an incredible opportunity to target the pent-up demand for larger condo units previously unavailable within Deer Valley while controlling market pricing.</p>

					<p style="font-family:'Times New Roman'; font-size:1.2em; margin-bottom:10px">EMPIRE PASS PRICE PREMIUM</p>

					<p>As a result of its superior mid-mountain, ski-in / ski-out access, in 2015 Empire Pass condominium product commanded a 20% price premium relative to other Deer Valley offerings and a 90% premium over neighboring Park City product. With average condo pricing in excess of $1,230 PSF in 2015, the superior location of Empire Pass has led to superior sales volume and pricing over proximate condominium projects in Lower Deer Valley or the Canyons Village (averaging $1,050 PSF & $661 PSF respectively).</p>
				</div>
				<br> -->
				<a href="#" class="back-to-top"></a>
			</article>

			<article id="deer_valley" class="tab-pane fade">

				<br>
				<img src="../../images/dv_night.jpg">
				<br>

				<div class="text-panel">
					<img src="../sommetblanc/images/deervalley_line.png">

					<h3 style="font-family:'Times New Roman'; color:white" >ELITE DEER VALLEY</h3>

					<p>
						Empire Pass anchors the exclusive Deer Valley Ski Resort, one of the finest skiing destinations in the entire world. Winner of Ski Magazines Top Resort for five consecutive years between 2007 – 2011 (no other resort has ranked first for more than three consecutive years) and second overall in 2012, 2013 and 2014. With over 300 inches of annual snowfall, more than 100 runs, 3,000 feet of vertical drop and 2,026 skiable acres, Deer Valley’s natural landscape and physical attributes make it one of the foremost ski resorts in North America. Although the natural beauty of the resort in stunning, what truly separates Deer Valley from other resorts is the supreme level of services and amenities.
						As evidenced by its number one ratings in 2015 for Service, Access, On-Mountain Food, Lodging and Dining, and number two in grooming, Deer Valley prides itself on the details.
					</p>

				</div>
				<br>

				<img src="images/offering/deer_valley/mining.jpg">
				<br>

				<div class="text-panel">
					<img src="../sommetblanc/images/deervalley_line.png">

					<h3 style="font-family:'Times New Roman'; color:white" >DEER VALLEY HISTORY</h3>

					<p>While Deer Valley can boast of many firsts, the resort is most proud that
					it was one of the first resorts to offer ski valets and carry guests’ ski gear from their cars to the slopes, provide free parking lot shuttles, refer to customers as “guests” as is done at fine hotels, have a state-licensed childcare facility on site, provide tissues in the lift lines, and provide complimentary overnight ski storage. This commitment to service and excellence in all parts of the guests ski experience sets Deer Valley apart from the rest and is the reason the resort has achieved top rankings.</p>

					<p>Deer Valley has invested over $100 million in improvements and grown from five chairlifts to 21; from 35 ski runs to 101; from two day lodges to three; from 50 ski instructors to more than 500, ranking it as one of the largest ski schools in the country; and from 200 total employees from the first season to 2,600 today, many of whom have been with the company two decades or more. Yet with all the improvements, lift ticket sales are limited to 7,500 each day, and with well over half of its chairlifts being high speed, the resort boasts one of the highest uphill capacities in the country.</P>

					<p>Attracting global attention in 2002, the freestyle mogul, aerial and alpine slalom events of the Winter Olympic Games showcased Deer Valley’s excellence and flawless execution. Many ski enthusiasts agree that Deer Valley resort ran the best Olympic Games of all time. Deer Valley’s commitment to excellence and ability to host world-class events makes the resort a top choice of venues for many of the world’s major winter sporting events.</p>

				</div>
				<br>

				<img src="images/offering/deer_valley/montage.jpg">
				<br>

				<div class="text-panel">
					<img style="padding:0; margin:0" src="../sommetblanc/images/deervalley_line.png">
					<h3 style="font-family:'Times New Roman'; color:white" >DINING AND LODGING</h3>

					<p>While Deer Valley’s lift system is perfectly capable of accommodating well over 7,500 guests, skiing is only part of the Deer Valley experience. The resort limits the number of guests allowed in the resort each day based on dining, not lift capacity. In addition to short lines and open tables, Deer Valley offers some of the best menus in Park City, making the dining experience an integral part of visiting the resort. From Swiss raclette cheese, cured meats, fire-roasted leg of lamb, fresh baked breads and dessert fondues at Fireside Dining to Deer Valley’s famous Turkey Chili at Cushing’s Cabin or Snowshoe Tommy’s, Deer Valley’s fine hotel dining is an experience guests will never forget.</p>

				</div>
				<br>

				<img src="images/offering/deer_valley/skier.jpg">

				<br>
				<div class="text-panel">
					<img src="../sommetblanc/images/deervalley_line.png">
					<h3 style="font-family:'Times New Roman'; color:white" >SKIING</h3>

					<p>Deer Valley offers a variety of world class skiing that accommodates the novice and dares the professional. From wide, groomed runs of Flagstaff Mountain to the 2002 Olympic mogul course and the Double Black Daly Chutes in Empire Canyon, Deer Valley’s six mountains welcome skiers of all backgrounds to enjoy and challenge themselves in the resort.</p>

					<p>Deer Valley boasts The Greatest Snow On Earth® with an annual average of 300 inches blanketing Deer Valley’s six mountains – Little Baldy Peak, Bald Eagle, Bald, Flagstaff, Empire and Lady Morgan – offering a thrilling day for skiers of all abilities.</p>

					<p>Challenge yourself on the very runs skied by Olympians during the 2002 Salt Lake Olympic Winter Games; take a ski lesson and learn the basic fundamentals of an exciting, new sport; or treat yourself to Deer Valley’s award-winning cuisine. We are excited to show you just how wonderful a Deer Valley Resort vacation can be and to share the “Deer Valley Difference” with you.</p>

				</div>
				<br>
				<a href="#" class="back-to-top"></a>
			</article>

			<article id="park_city" class="tab-pane fade" >

			    <br>
				<img src="images/offering/park_city/main_street.jpg">
				<br>
				<div class="text-panel">

					<h3 style="font-family:'Times New Roman'; color:white" >PARK CITY OVERVIEW</h3>

					<p>The exclusive Empire Pass sites hold dominant positions on the north face of Flagstaff Mountain in Deer Valley, just minutes away from the vibrant downtown of Park City, Utah. Park City is located within the picturesque Wasatch Back region on the eastern side of the Wasatch Range of the Rocky Mountains. Surrounded by spectacular terrain and scenic wilderness, the area’s rich history is rooted in silver mining. Today, Park City is the largest city in Summit County and one of the most sought after recreation destinations in the world. While approximately 7,800 residents live in Park City year-round, millions of visitors travel to the mountain city each year. Boasting three world-class winter resorts totaling more than 9,000 skiable acres of “The Greatest Snow On Earth,” Park City is synonymous with premier skiing and winter sports.</p>

					<p>Home to three of the nation’s leading ski resorts – all located within a five-mile radius, the Park City area is best known for its world-famous ski slopes and light, dry powder snow. Superior winter sports conditions due to nearby Salt Lake, along with a strong visitor infrastructure, made Park City the ideal location for the 2002 Olympic Winter Games. Coupled with the growing success of the internationally-renowned Sundance Film Festival, the premier platform for American and international independent film which takes place for 10 days in Park City each January, the quaint nature of Park City has garnered immense worldwide awareness and has emerged as a popular year-round destination. Unlike any other location in the world, Park City offers abundant summer and winter outdoor recreational opportunities, as well as an incredible variety of year-round festivals, concerts and cultural events – all amongst an unrivaled natural setting.</p>

				</div>
				<br>

				<img src="images/offering/park_city/map.jpg">
				<br>

				<div class="text-panel">
					<br>

					<h3 style="font-family:'Times New Roman'; color:white; margin-top:-20px" >40 Minutes from Salt Lake City</h3>

					<p>Park City is located approximately 30 miles southeast of downtown Salt Lake City and less than 40 minutes from Salt Lake City International Airport, making it the most accessible mountain resort in the country. Situated at the south end of the Snyderville Basin, the town is primarily accessed by State Route 224 via Interstate 80 to the north and State Route 248 which connects with U.S. Route 40 to the northeast.</p>

				</div>

				<br>

				<img src="images/offering/park_city/mining.jpg">

				<br>
				<div class="text-panel">

					<h3 style="font-family:'Times New Roman'; color:white" >PARK CITY HISTORY</h3>

					<p>Park City was founded as a silver mining town by prospectors in the late 1860s, and in its heyday, the Ontario Mine was considered the greatest silver mine in the world. By the 1880s, dozens of mines in the Park City Mining District actively made shipments. With more than $400 million worth of silver extracted from the mountains surrounding the town during its mining height, Park City mines made such men as George Hearst, father of newspaper publisher William Randolph Hearst, millionaires. During this time, Park City experienced considerable population growth followed by the development of homes, schools and services, and the town was incorporated in 1884. The mining industry was eventually crippled by the Great Depression and falling mineral prices in the early 1900s, and mining subsequently ended in the early 1970s.</p>

					<p>With the decline of the silver market, focus turned to what would become one of Park City’s greatest assets – exceptional terrain and snow conducive to skiing. Park City’s first ski area, Snow Park, opened in 1946 with one T-bar lift. Treasure Mountain (Park City Mountain) opened in 1963, and Park West (Canyons) opened in 1968 followed by Deer Valley in 1981. The area soon became a preferred location for winter sports competition, and Park City Mountain Resort held the first America’s Opening World Cup ski race in 1985, and Deer Valley hosted its first freestyle World Cup competition in 2000. </p>

					<p>Building upon these successes, Park City ultimately played an integral role in securing the 2002 Olympic Winter Games for Utah, which is considered by many the most successful Winter Olympics in history. Deer Valley, Park City Mountain and the Utah Olympic Park all host World Cup events each winter, and the 2016 World Cup Competition took place at Deer Valley this year. Park City has also been home to the U.S. Ski and Snowboard Team since 1974, as well as the United States Ski and Snowboard Association since 1988.</p>

				</div>
				<br>

				<img src="images/offering/park_city/airline_routes.jpg">

				<br>
				<div class="text-panel">

					<h3 style="font-family:'Times New Roman'; color:white" >CONVENIENT, ACCESSIBLE LOCATION</h3>

					<p>Park City is the most accessible mountain resort destination in North America. With its location less than 40 minutes from Salt Lake City International Airport, visitors can easily fly in and ski the very same day. Salt Lake City International Airport is served by fifteen airlines and their affiliates and offers an average of 639 scheduled daily flights to more than 90 cities worldwide. The airport served 22 million passengers in 2015 and was ranked 27th busiest in in North America and 80th busiest in the world in terms of passenger volume. Ground access is provided via Interstate 80, a major east-west arterial that connects Park City to downtown Salt Lake City approximately 30 miles to the northwest and extends as far west as San Francisco and east to New York City. The town is also accessible via State Route 248 which intersects with U.S. Route 40 to the northeast. U.S. Route 40 begins at Interstate 80 and runs north-south just east of Park City and continues southeast and east through Denver, Kansas City and St. Louis. Park City residents and visitors enjoy complimentary local bus service year-round to the two Park City Ski Resorts, including Deer Valley, the historic district, residential neighborhoods and lodging, shopping and dining areas within downtown Park City, as well as the outlying areas of Kimball Junction and Quarry Village. A trolley operates daily along the town’s Main Street during the winter season and serves as a connection between Main Street and other routes in the Park City transit system via the Old Town Transit Center.<p>

				</div>
				<br>

				<img src="images/offering/park_city/deer_valley_concert.jpg">

				<br>
				<div class="text-panel">

					<h3 style="font-family:'Times New Roman'; color:white" >PREMIER ALL-SEASON RESORT DESTINATION</h3>

					<p>Park City is one of North America’s premier, multi-seasonal resort communities. While Park City has remained a skiing mecca, featuring more than 9,000 skiable acres of “The Greatest Snow On Earth” for superb skiing/snowboarding in the winter season, the area has also evolved into a desirable year-round resort destination offering a plethora of outdoor recreational activities in the summer. Tucked high in the Wasatch Back region, Park City is surrounded by breathtaking valleys, majestic mountains and verdant open spaces. In the summer, its stunning natural environs offer a fertile landscape for a variety of outdoor adventures, including alpine sledding, wheeled bobsledding, zip lining, rock climbing, camping, hiking, mountain biking, horseback riding on over 400 miles of public trails, golf at both public and private championship courses, and some of the country’s best fly fishing. Park City is also host to numerous outdoor concerts, festivals and cultural events, such as the Sundance Film Festival each January and the annual Park City Kimball Arts Festival and Deer Valley Music Festival in the summer. The Kimball Arts Festival, which takes place on Park City’s historic Main Street, draws more than 50,000 people from around the country each year, while the Sundance Film Festival produces an economic impact of $62.2 million to the state.</p>

					<h3 style="font-family:'Times New Roman'; color:white" >AFFLUENT DEMOGRAPHIC PROFILE</h3>

					<p>Park City has seen an increase in population of 70% since 1990. Its 2015 full-time resident base has reached over 7,800 people, and the population is expected to grow 3.2% in the next five years to over 8,000. The exclusive community is remarked for its affluent residents and expensive homes. Per Claritas, 52% of the town’s residents over the age of 25 hold a bachelor’s degree or higher, approximately two times greater compared to the national average of 30%. This wealthy community maintains an average household income of $138,500 compared to the national average of $74,165, with 42% of its residents earning an estimated household income of $100,000 or more. Home prices also reflect the area’s affluence, with the median list price for single family homes at over $675,000 according to Zillow.com.</p>

				</div>
				<br>

				<img src="images/offering/park_city/collage.jpg">

				<br>
				<div class="text-panel">

					<h3 style="font-family:'Times New Roman'; color:white" >VIBRANT, DYNAMIC COMMUNITY</h3>

					<p>Offering a lifestyle and experience unlike any other destination in the world, Park City is home to 7,800 full-time residents and welcomes nearly half a million overnight visitors each year. As a preferred resort destination world-renowned for exemplary skiing, a famed Olympic legacy, unrivaled leisure activities and an impressive calendar of attractive year-round events, Park City attracts a wide selection of domestic and international travelers, creating a dynamic, cosmopolitan vibe that is unique to this inviting mountain town. Park City has successfully evolved into an epicenter of culture and sophistication, while maintaining its historic identity and a deeply rooted local community. A strong resident and visitor-serving infrastructure includes first-class services and amenities, luxury resort condominiums and hotels, spas and a wide variety of retail, entertainment and dining options. An endearing gem amongst the luxury that has developed around it in the past few decades, the historic downtown serves as a cohesive anchor of the community and is a vibrant gathering place for both residents and visitors. The center of historic downtown is Main Street, flanked by well-preserved historic buildings filled with designer boutiques, antique shops, art galleries, fine and casual restaurants, bars and nightlife venues.</p>

					<h3 style="font-family:'Times New Roman'; color:white" >PARK CITY RETAIL, DINING, ENTERTAINMENT AND EVENTS</h3>

					<p>Park City has emerged as an internationally-recognized all-season resort and cultural center and is widely regarded for its year-round activities. A veritable playground for the discerning traveler, each year, nearly half a million people visit the mountain resort for its world-class skiing, festivals and events. In addition, a deep amenity base that caters to the affluent community and visitors has grown to include a diverse selection of retail and dining options, including over 100 restaurants with many boasting Zagat ratings and award-winning chefs and more than 100 shops and boutiques. The local community embraces a rich cultural calendar that features numerous concerts, cultural events, art exhibits and festivals, and Park City is best known for hosting the internationally-acclaimed Sundance Film Festival each January.</p>

					<h3 style="font-family:'Times New Roman'; color:white" >YEAR ROUND APPEAL</h3>

					<p>As a true “four seasons” resort destination, Park City benefits from consistent year-round exposure and attracts nearly 3.0 million visitors annually, including many primary and second-home buyers. In addition to three award-winning ski resorts (Deer Valley, Park City and The Canyons), Park City showcases many of the finest golf courses in the intermountain region, a multitude of mountain and road bike competitions, and nationally recognized music and art festivals. With easy access via Salt Lake City International Airport, Park City has become an extremely convenient travel location for the entire U.S. and many international cities.</p>

				</div>
				<br>

				<img src="images/offering/park_city/sundance.jpg">

				<br>
				<div class="text-panel">

					<h3 style="font-family:'Times New Roman'; color:white" >SUNDANCE FILM FESTIVAL</h3>

					<p>For 10 days each January, Park City is host to the internationally-acclaimed Sundance Film Festival, the premier platform for American and international independent film. The Sundance Film Festival is part of the Feature Film program which is one of nine Sundance Institute artist programs. Since its founding by Robert Redford in 1978, the Sundance Institute has become an internationally-recognized nonprofit organization. Dedicated to the discovery and development of independent artists and audiences, through its programs, the Institute supports and fosters independent filmmakers and theatre artists from the U.S. and around the world. The Sundance Institute’s artist programs include Feature Film, Documentary, Theatre, Native American and Indigenous Film, Film Music, Creative Producing, Short Film, Alumni Initiative and Film Forward. The Feature Film program is the longest-running program of the Sundance Institute. Since its inception, the Feature Film Program has supported more than 500 independent filmmakers and has introduced audiences to some of the most original stories of the last three decades, including American Splendor, An Inconvenient Truth, Reservoir Dogs, The Cove and Little Miss Sunshine. Today, the Sundance Film Festival continues to be a favorite Park City tradition for residents and a highly-notable event among celebrities, filmmakers, entertainment and production companies. The Sundance Film Festival celebrated its 32nd year of being the top independent film festival in 2016, and according to the Economic Development Corporation of Utah, the event produced a statewide economic impact of approximately $62.2 million.</p>

				</div>
				<br>

				<img src="images/offering/park_city/mountain.jpg">

				<br>
				<div class="text-panel">

					<h3 style="font-family:'Times New Roman'; color:white" >WORLD-CLASS SKIING</h3>

					<p>With two leading mountain resorts encompassing over 9,300 acres of terrain with an annual average snowfall of 300 inches of “The Greatest Snow On Earth,” Park City is renowned for its world-famous ski slopes featuring an unforgettable experience in downhill alpine skiing and/or snowboarding at Deer Valley and Park City Mountain Resorts. Just a 40-minute ride from Salt Lake City International Airport, Park City is the most accessible mountain resort destination in the country, where visitors (even those from the East Coast) can fly in and ski or snowboard the very same day.</p>

					<h3 style="font-family:'Times New Roman'; color:white" >Park City, Utah</h3>

					<p>Although Park City is a fairly young mountain resort area in comparison to such locations as Aspen, Sun Valley and Tahoe, the community has enjoyed a robust surge in popularity and development in recent years, garnering tremendous appeal as a preferred leisure resort destination. In addition to a growing amenity base comprised of upscale retail, dining and entertainment that has transformed Park City into a vibrant, dynamic destination, the development of new high-end resort condominiums and such luxury branded hotels as Montage Deer Valley (Deer Valley Resort), The St. Regis Deer Valley (Deer Valley Resort) and Waldorf Astoria Park City (Park City Resort) have also helped catalyze the area’s renaissance.</p>

					<h3 style="font-family:'Times New Roman'; color:white" >Deer Valley Resort</h3>

					<p>Deer Valley Resort has based a commitment to first-class service second to no other resort in North American. With 2,026 skiable acres, 101 groomed trails and six bowls, and a mountain that is limited to the first 7,500 guests each day, the resort has consistently been named the #1 ski resort in North America by readers of SKI Magazine for guest service, on mountain food and mountain grooming. Deer Valley Resort was the venue for the 2002 Olympic Winter Games alpine slalom, freestyle mogul and aerial events. The resort’s summer calendar includes concerts at the Snow Park Outdoor Amphitheater, in addition to offering a variety of other activities, such as lift-served hiking and mountain biking on over 60 miles of trails and scenic chairlift rides.</p>

					<h3 style="font-family:'Times New Roman'; color:white" >Park City Mountain Resort</h3>

					<p>The largest ski resort in America, Park City Mountain Resort expands Vail Resorts’ brand across 7,300 acres. Park City Mountain Resort recently acquired The Canyons resort and invested over $50 million between the two resort areas. Park City Mountains served as a venue for the giant slalom and snowboard events during the 2002 Olympic Winter Games and currently serves as the setting for the U.S. Snowboarding and Free Skiing Grand Prix and many other winter competitions throughout the season. Park City Mountain features a vertical drop of 3,100 feet and 300 designated trails, 14 bowls and one 22’ superpipe. Park City Mountain is home to Utah’s only Alpine Coaster with one of the world’s longest Alpine Slides at almost a mile long, as well as hundreds of miles of hiking and biking trails.</p>

				</div>
				<br>

				<a href="#" class="back-to-top"></a>
			</article>

			<article id="talisker_club" class="tab-pane fade">
			    <br>
			    <img src="images/offering/talisker/tower.jpg">
			    <br>
				<div style="background-color:#333; color:white; padding:5% 10%">

						<img src="../sommetblanc/images//talisker_line.png">

					<h3 style="font-family:'Times New Roman'; color:white" >TALISKER CLUB</h3>
					<h3 style="font-family:'Times New Roman'; color:white" >WORLD CLASS AMENITIES WITH MULTI-GENERATIONAL APPEAL</h3>

					<p>Residents throughout Empire Pass are united by one very exceptional offering: the award-winning Talisker Club. Club membership is private and exclusive to those who own real estate in one of Talisker’s communities thereby attracting only the most affluent members with discerning taste and expectations. The Club offers an unmatched array of amenities and recreational activities including world class skiing at Deer Valley, championship golf designed by Mark O’Meara, state-of-the-art spa and fitness facilities, hiking, mountain-biking, water sports and the Wildstar Rangers kids program. With the Club’s extensive golf and ski amenities, members enjoy activities in both summer and winter seasons. The Club offers more than 200 programmed activities and social events annually, award-winning cuisine, and family-oriented programming in its five clubhouses located on Talisker land both on and off mountain. Awards won by the Club include being named “Best of the Best” by Robb Reports for Mountain Resort Community; being ranked in “Best Places for a Second Home” by Barron’s for two consecutive years; and being ranked #8 by Travel + Leisure Golf in “America’s Top 100 Golf Communities.” Currently, the Club is in Receivership and the Lenders and the Receiver are working toward a final resolution.</p>

				</div>
				<br>

			    <img src="images/offering/talisker/fireplace.jpg">
			    <br>
			    <div style="background-color:#333; color:white; padding:5% 10%">
			    	<img src="../sommetblanc/images//talisker_line.png">
			    	<h3 style="font-family:'Times New Roman'; color:white" >TALISKER CLUB OVERVIEW</h3>

					<p>The Talisker Club offers an experience second to none with its exclusive, unrivaled access to world-class, multi-season amenities. The luxury Club consists of several neighborhood, including Tuhaye and Empire Pass, that are brought together through exclusive membership to the Talisker Club. With member-only clubhouses, award-winning dining, championship level golf designed by Mark O’Meara, spa and fitness facilities, and some of the finest skiing in the world at Deer Valley, the Club is truly the preeminent Park City alpine club. With over 200 programmed events, the Club is committed to fostering family memories and appealing to real estate buyers from around the world.</p>

				</div>
				<br>

			    <img src="images/offering/talisker/snow_party.jpg">

			    <br>
			    <div style="background-color:#333; color:white; padding:5% 10%">
			    	<img src="../sommetblanc/images//talisker_line.png">
			    	<h3 style="font-family:'Times New Roman'; color:white" >MEMBERSHIP OVERVIEW</h3>

					<p>Historically, the Talisker Club membership has been limited to individuals who own real estate in one of the Talisker communities. Currently, the Club is in Receivership, and the Lenders and the Receiver are working toward a final resolution. It is possible that these conversations will lead to a definitive agreement of the outstanding issues. As events unfold, more information will be made available.</p>

					<p style="margin-bottom:5px">Membership:&nbsp $100,000</p>
					<p>Current Dues: &nbsp;$1,160 per month</p>

				</div>
				<br>

			    <img src="images/offering/talisker/collage.jpg">

			    <br>

			    <div style="background-color:#333; color:white; padding:5% 10%">
			    	<img src="../sommetblanc/images//talisker_line.png">
			    	<h3 style="font-family:'Times New Roman'; color:white" >TALISKER CLUB AMENITIES DESCRIPTION</h3>

					<br>
					<p class="sub-heading">TALISKER TOWER</p>

					<p>Nestled in the heart of Empire Pass, Talisker Club Members’ private clubhouse is sumptuous and grand, more of an elegant lounge than a ski lodge accessed by Silver Strike Express lift at Deer Valley Resort.</p>

					<p class="sub-heading">EMPIRE MEMBER'S SKI LODGE</p>

					<p>Offering easy ski-in/ski-out access to Ruby, Empire and Lady Morgan lifts at Deer Valley, the Members’ ski lodge, adjacent to the Empire day lodge, offers a convenient portal to the mountain and place to relax without leaving the hill.</p>

					<p class="sub-heading">THE OUTPOST</p>

					<p>This high-altitude playground is the hub for snowshoeing, skate skiing, tubing and an array of backcountry adventures including snowmobiling and more. Accessible only by snowcat, Outpost excursions are made even more memorable by the prospects of privately catered meals inside the rustic yurt by Talisker’s exceptional culinary team.</p>

					<p class="sub-heading">TALISKER CLUB PARK</p>

					<p>At the heart of Tuhaye and situated near the 10th tee of Talisker Golf at Tuhaye, Talisker Club Park is the ultimate experience in relaxation and activity. Open year-round, Talisker Club Park features the Tuhaye Clubhouse, the Golf Clubhouse, a family pool and fitness center, a bite to eat at the Table Café or spectacular spa treatments, all just steps away from the delightful Wildstar Cabin.</p>

					<p class="sub-heading">TUHAYE GOLF</p>

					<p>Talisker Golf at Tuhaye offers an unparalleled golf experience with panoramic views of Deer Valley® Resort, Mt. Timpanogos and the blue waters of the Jordanelle Reservoir. The Mark O’Meara designed Signature Course was recently recognized by Golf Digest as one of the Top 10 “Best New Private Courses” in America.</p>

					<p class="sub-heading">TENNIS</p>

					<p>Located just east of Talisker Club Park, the Tennis Courts feature two Har-Tru clay surface courts that provide the most desirable conditions for players. The granular surface acts as a shock-absorbing cushion, allowing players to slide into their returns and reduce stress on the legs.</p>

					<p class="sub-heading">BOATING</p>

					<p>Members can book boating adventure and let Talisker Club captains command the Talisker Toy, Talisker Club’s Mastercraft X45, for an unforgettable outing of wakeboarding, waterskiing, tubing, surfing and/or leisure cruising on the sparkling waters of the Jordanelle Reservoir.</p>

				</div>
				<br>
				<a href="#" class="back-to-top"></a>
			</article>
		</div>

</div>

<script>

	var high_cash_flow_chart = <?php echo $high_cash_flow_chart; ?>;
	var medium_cash_flow_chart = <?php echo $medium_cash_flow_chart; ?>;
	var low_cash_flow_chart = <?php echo $low_cash_flow_chart; ?>;
	var chart3_options;
	var $high_case_table;
	var $medium_case_table;
	var $low_case_table;

	$(document).ready(function() {

		var html = "<tr><td>Total Units</td><td>" + <?php echo $high_summary_financial_info['total_units'];?> + "</td></tr><tr><td>Project Duration (months)</td><td>" +<?php echo $high_summary_financial_info['project_duration'];?> + "</td></tr>";
		$('#high_case_table tbody').append(html);

		var html = "<tr><td>Total Units</td><td>" + <?php echo $medium_summary_financial_info['total_units'];?> + "</td></tr><tr><td>Project Duration (months)</td><td>" +<?php echo $medium_summary_financial_info['project_duration'];?> + "</td></tr>";
		$('#medium_case_table tbody').append(html);



		$empire_sales_table = $('#empire_sales_table').DataTable({
			scrollX:true,
			//scrollY:800,
			paging:false,
			searching:false,
			bSort:true,
			dom:'t',
			//fixedColumns:true
			//fixedHeader:true // doesn't work with scrollX or scrollY
			columnDefs: [
				{className:"text-left", "targets": [0,1,2]},
				{className:"center", "targets": [3,4,10,12]},
				{className:"text-right", "targets":['_all']}
			]
		});

		$empire_condo_sales_table = $('#empire_condo_sales_table').DataTable({
			scrollX:true,
			//scrollY:800,
			paging:false,
			searching:false,
			bSort:false,
			dom:'t',
			fixedColumns:true
			//fixedHeader:true // doesn't work with scrollX or scrollY
		});

		$flagstaff_built_table = $('#flagstaff_built_table').DataTable({
			scrollX:true,
			//scrollY:800,
			paging:false,
			searching:false,
			bSort:false,
			dom:'t',
			//fixedColumns:true
			//fixedHeader:true // doesn't work with scrollX or scrollY
		});

		$flagstaff_unbuilt_table = $('#flagstaff_unbuilt_table').DataTable({
			scrollX:true,
			//scrollY:800,
			paging:false,
			searching:false,
			bSort:false,
			dom:'t',
			//fixedColumns:true
			//fixedHeader:true // doesn't work with scrollX or scrollY
		});

		$high_case_table = $('#high_case_table').DataTable ({
			paging:false,
			searching:false,
			destroy:true,
			bSort:false,
			dom:'t',
			columnDefs: [{
				className:"text-left", "targets": [0]
			},{
				className:"text-right", "targets":['_all']
			}]
		});

		$medium_case_table = $('#medium_case_table').DataTable ({
			paging:false,
			searching:false,
			destroy:true,
			bSort:false,
			dom:'t',
			columnDefs: [
				{className:"text-left", "targets": [0]},
				{className:"text-right", "targets":['_all']}
			]
		});

		$low_case_table = $('#low_case_table').DataTable ({
			paging:false,
			searching:false,
			destroy:true,
			bSort:false,
			dom:'t',
			columnDefs: [
				{className:"text-left", "targets": [0]},
				{className:"text-right", "targets":['_all']}
			]
		});

		var amountScrolled = 1000;

		$(window).scroll(function() {
			if ($(window).scrollTop() > amountScrolled ) {
				$('a.back-to-top').fadeIn('slow');
			} else {
				$('a.back-to-top').fadeOut('slow');
			}
		});

		$('a.back-to-top').click(function() {
			$('html, body').animate({
				scrollTop: 0
			}, 700);
			return false;
		});

		chart3_options = { // global
			yaxis : {
				tickFormatter: function numberWithCommas(x) {
					return x.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
				}
			},
			series : {
				bars: {
					barWidth: 1, //60*60*12*30*1000, // 1/2 a month width
					align: "center",
					show: true
				}
			},
			selection : {
				//mode : "x"
			},
			grid : {
				hoverable : true,
				clickable : true,
				tickColor : $chrt_border_color,
				borderWidth : 5,
				borderColor : $chrt_border_color,
			},
			tooltip : true,
			tooltipOpts : {
				content: function(label,xval,yval,flotItem) {
					 var yval = Math.round(yval);
					 yval = yval.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
					 var label = "Month <b>%x.0</b> is <span>$" + yval + "</span>";
					 return label;
				},
				shifts: {
					x:-30,
					y:-50
				},
				//dateFormat : "%y-%0m-%0d",
				defaultTheme : false
			},
			//colors : [$chrt_main],
			colors :[chart_color],
		};

		$('#proforma_summary_link').click(function(e){
			e.preventDefault();
			$('a[href="#proforma_summary"]').click();
		});


	});
</script>

