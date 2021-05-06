<?php


include('../../private/initializeBeforeLogin.php'); // does not use a session

// config
$projectId = 5;
$sourceFolder = "../projects/sommetBlancReservations/_floorplans";

$query = "SELECT * from units where project_id = $projectId";
$units = Unit::find_by_sql($query);

$villas = ['av1','av2','av3','av4','av5'];

foreach ($units as $unit) {
	
	$name = strtolower($unit->name);

	if (!in_array($name,$villas)) {
		$sourcePath = $sourceFolder . "/" . $name . "_floorplan-2000.jpg";
		if (file_exists($sourcePath)) {
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_main-2000.jpg";
			copy ($sourcePath,$destinationPath);
			$image = new Imagick($sourcePath);
			$image->scaleImage(800,0);
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_main-800.jpg";
			$image->writeImage($destinationPath);
		}
	} else {
		
		$sourcePathMain = $sourceFolder . "/" . $name . "_floorplan_main-2000.jpg";
		$sourcePathUpper = $sourceFolder . "/" . $name . "_floorplan_upper-2000.jpg";
		$sourcePathLower = $sourceFolder . "/" . $name . "_floorplan_lower-2000.jpg";

		if (file_exists($sourcePathMain)) {
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_main-2000.jpg";
			copy ($sourcePathMain,$destinationPath);
			$image = new Imagick($sourcePathMain);
			$image->scaleImage(800,0);
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_main-800.jpg";
			$image->writeImage($destinationPath);
		}

		if (file_exists($sourcePathLower)) {
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_lower-2000.jpg";
			copy ($sourcePathLower,$destinationPath);
			$image = new Imagick($sourcePathLower);
			$image->scaleImage(800,0);
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_lower-800.jpg";
			$image->writeImage($destinationPath);
		}

		if (file_exists($sourcePathUpper)) {
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_upper-2000.jpg";
			copy ($sourcePathUpper,$destinationPath);
			$image = new Imagick($sourcePathUpper);
			$image->scaleImage(800,0);
			$destinationPath = "../projects/sommetBlancReservations/_units/" . $name . "/floorPlans/" . $name . "_floorplan_upper-800.jpg";
			$image->writeImage($destinationPath);
		}
	}
}

