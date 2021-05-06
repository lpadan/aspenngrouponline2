<?php
	session_start();
	$_SESSION['offering_id'] = 12;
	$_SESSION['proforma_type'] = "offering";
	$_SESSION['project_id'] = 0;

	require_once('../../includes/initialize.php');
	$access = verifyAccess();
	$db = db_connect();

	$user_id = $_SESSION['login_id'];
	$offering_id = $_SESSION['offering_id'];

	$query = "SELECT nda_required FROM offerings WHERE offering_id = $offering_id LIMIT 1";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	$nda_required = $row['nda_required'];

	$query = "SELECT nda_onfile FROM offerings_users WHERE user_id = $user_id AND offering_id = $offering_id LIMIT 1";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	$nda_onfile = $row['nda_onfile'];

	if ($nda_required && !$nda_onfile && $_SESSION['login_role'] != 'admin') {
		header('Location:' . APP_URL . '/index.php');
	}

?>


<!DOCTYPE html>

<html lang="en">

	<head>
		<meta charset='utf-8'>
		<title>Offering | Sommet Blanc</title>
		<?php require_once(LIB_PATH . "/load_css.php");?>
	</head>

	<style>

		/* increase page width */
		@media (min-width:1300px) {
			.boxed .page-wrapper,.page-top .container {
				width:1300px;
			}
		}
	</style>

	<body class= "front no-trans boxed pattern-9">

		<div class = "page-wrapper">
			<?php require_once('header.php');?>

			<div id='page_body'>

				<!-- <div>
					<img src="images/sommetblanc-splash.jpg"  alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
				</div>

				<div class="page-top">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="call-to-action">
									<div class="title-center">"Life Elevated"</div>
									<p>Luxury Condominiums, steps from the Ruby Express Chair </p>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div> <!-- end page body -->

			<!-- <?php //include('../../project_footer.php');?> -->

		</div>  <!-- end page-wrapper -->

		<div id="mask"></div>
		<div id="loader" style="display:none">Loading Detail...</div>


		<?php
			include(LIB_PATH . '/load_js.php');
		?>

		<script>


		// needed for the summary proforma charts
		var chart_color = ""; // defautl gray
		//var chart_color = "#256ab0"; //"#8b5e3b";
		var $chrt_border_color = "#efefef";
		var $chrt_grid_color = "#DDD";

		var offering_id = <?php echo $_SESSION['offering_id']; ?>;
		var proforma_name = '';


		// auto load the offering
		(function() {
			$('#page_body').load('offering.php');
		})();


		$(document).ready(function() {

			$('a.offering_menu').click(function(event) {
				event.preventDefault();
				var page = $(this).attr("href");

				// $('#page_body').html(
				// '<div class="container">' +
				// 	'<div class="title" style="margin-top:3%;margin-bottom:0px">' +
				// 		'<span style="color:#666; font-size:.8em">Loading...</span>' +
				// 	'</div><br><br>' +
				// '</div>'
				// );

				$('#page_body').html('<div id="loader2">LOADING...</div>');

				$('#page_body').load(page);
			});

			$('#offering').click(function(){
				$.ajax({
					type: "GET",
					url: "offering.php",
					dataType: "html",
					beforeSend: function() {

						// $('#page_body').html(
						// 	'<div class="container">' +
						// 		'<div class="title" style="margin-top:3%;margin-bottom:0px">' +
						// 			'<span style="color:#666; font-size:.8em">Loading...</span>' +
						// 		'</div><br><br>' +
						// 	'</div>'
						// );

						$('#page_body').html('<div id="loader2">LOADING...</div>');
					},
					success: function(html) {
						var error_code = $(html).filter('#error_code').data('error_code');
						if (error_code == '1') {
							alert("You have been logged out after a period of inactivity. \nPlease log in again");
							window.location.assign('../../login.php');
						}
						$('#page_body').html(html);
					}
				});
			});

			$('#page_body').on('click', '#development_agreement_link', function(e) {
				e.preventDefault();
				$('#page_body').load('documents/development_agreement.php');
			});

			$(document).on("click", "#load_new", function() {
				var url = "../../proforma/proforma_table.php?offering_id=" + offering_id;
				window.open(url);
				return;
			});

			$('#page_body').on('click','#flagstaff_table_btn', function() {
				$('#flagstaff_table_wrapper').slideToggle("slow", function() {
					var text = $('#flagstaff_table_btn').text();
					if (text == "Show Table") $('#flagstaff_table_btn').text('Hide Table');
					else $('#flagstaff_table_btn').text('Show Table');
				});
				$flagstaff_built_table.columns.adjust().draw();
				$flagstaff_unbuilt_table.columns.adjust().draw();
			});

			$('#page_body').on('click','#empire_sales_table_btn', function() {
				$('#empire_sales_table_wrapper').slideToggle("slow", function() {
					var text = $('#empire_sales_table_btn').text();
					if (text == "Show Table") $('#empire_sales_table_btn').text('Hide Table');
					else $('#empire_sales_table_btn').text('Show Table');
				});
				$empire_sales_table.columns.adjust().draw();
			});

			$('#page_body').on('click','#empire_condo_sales_table_btn', function() {
				$('#empire_condo_sales_table_wrapper').slideToggle("slow", function() {
					var text = $('#empire_condo_sales_table_btn').text();
					if (text == "Show Table") $('#empire_condo_sales_table_btn').text('Hide Table');
					else $('#empire_condo_sales_table_btn').text('Show Table');
				});
				$empire_condo_sales_table.columns.adjust().draw();
			});

			$('#page_body').on('click','#market_overview_table_btn', function() {
				$('#market_overview_table_wrapper').slideToggle("slow", function() {
					var text = $('#market_overview_table_btn').text();
					if (text == "Show Table") $('#market_overview_table_btn').text('Hide Table');
					else $('#market_overview_table_btn').text('Show Table');
				});
				$market_overview_table.columns.adjust().draw();
			});

			$('#page_body').on('click', '#discussion_btn', function() {
				$('#discussion_wrapper').slideToggle('slow', function() {
					var text = $('#discussion_btn').text();
					if (text=="More...") $('#discussion_btn').text('Hide');
					else $('#discussion_btn').text('More...');
				});
			});

			$('#page_body').on('click', 'button.proforma_link', function(e){
				e.preventDefault();
				proforma_name = $(this).attr('data-name');
				encode_proforma_name = encodeURIComponent(proforma_name);
				var url = "../../proforma/proforma.php?offering_id=" + offering_id + '&proforma_name=' + encode_proforma_name;
				window.open(url);
				return;
			});

			$('#page_body').on('shown.bs.tab','a[href="#high"]', function() {
				$high_case_table.columns.adjust().draw();
				$.plot($("#high_cash_flow_chart"), [high_cash_flow_chart], chart3_options);
			});

			$('#page_body').on('shown.bs.tab','a[href="#medium"]', function() {
				$medium_case_table.columns.adjust().draw();
				$.plot($("#medium_cash_flow_chart"), [medium_cash_flow_chart], chart3_options);
			});

			$('#page_body').on('shown.bs.tab','a[href="#low"]', function() {
				$low_case_table.columns.adjust().draw();
				$.plot($("#low_cash_flow_chart"), [low_cash_flow_chart], chart3_options);
			});

			$('#documents').click(function() {
				$('#page_body').html('<div id="loader2">LOADING...</div>');
				$('#page_body').load('../../documents.php');

			});


		}); // end document ready

		</script>

</body>
</html>
