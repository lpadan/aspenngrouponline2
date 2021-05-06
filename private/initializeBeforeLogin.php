<?php

ob_start(); // turn on output buffering

define("PRIVATE_PATH",dirname(__FILE__));
define("PROJECT_PATH",dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

require_once('functions.php');
require_once('database_functions.php');
require_once('db_credentials.php');

$root = (isLocalHost()) ? "//localhost/aspengroup.online/public/":"https://aspengroup.online/";
define("ROOT", $root);


// this is not working.  glob() looks to the directory of the calling file, not /classes..
//foreach(glob('classes/*.class.php') as $file) {
	//require_once($file);
//}


// Autoload class definitions
function my_autoload($class) {
	if(preg_match('/\A\w+\Z/', $class)) {
		include('classes/' . lcfirst($class) . '.class.php');
	}
}
spl_autoload_register('my_autoload');

$session = new Session;
$database = db_connect();
DatabaseObject::set_database($database);

?>