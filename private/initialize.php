<?php

ob_start(); // turn on output buffering
session_start();

if (!isset($_SESSION['logged_in'])) {
	http_response_code(419);
	exit;
}

require_once('functions.php');
require_once('database_functions.php');
require_once('db_credentials.php');

$root = (isLocalHost()) ? "//localhost/aspengroup.online/public/":"https://aspengroup.online/";
define("ROOT", $root);

define("PRIVATE_PATH",dirname(__FILE__));
define("PROJECT_PATH",dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');
define('LIB_PATH', ROOT . '/includes');

// this is not working.  glob() looks to the directory of the calling file, not /classes..
//foreach(glob('classes/*.class.php') as $file) {
	//require_once($file);
//}

// Autoload class definitions
function my_autoload($class) {
	if(preg_match('/\A\w+\Z/', $class)) {
		if (file_exists(PRIVATE_PATH . '/classes/' . lcfirst($class) . '.class.php')) {
			include('classes/' . lcfirst($class) . '.class.php');
		}
	}
}
spl_autoload_register('my_autoload');
DatabaseObject::set_database(db_connect());

?>