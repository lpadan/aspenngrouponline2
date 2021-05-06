<?php

$project = Project::find_by_id($_SESSION['projectId']);
$dbName = $project->db_name;
$dbPassword = $project->db_password;

if ($_SERVER['SERVER_ADDR'] == "::1") { // development // could use $_SERVER['HTTP_HOST'] == 'localhost'
	define("PROJECT_DB_SERVER","localhost");
	define("PROJECT_DB_USER","root");
	define("PROJECT_DB_PASS","root");
	define("PROJECT_DB_NAME",$dbName);
} else { // production
	define("PROJECT_DB_SERVER","localhost");
	define("PROJECT_DB_USER","aspenonl_admin");
	define("PROJECT_DB_PASS",$dbPassword);
	define("PROJECT_DB_NAME",$dbName);
}

?>