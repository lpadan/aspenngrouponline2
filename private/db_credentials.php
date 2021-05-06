<?php

// credentials for the aspenonl_db database

if (isLocalHost()) {
	define("DB_SERVER","localhost");
	define("DB_USER","root");
	define("DB_PASS","root");
	define("DB_NAME","aspenonl_db");
} else {
	define("DB_SERVER","localhost");
	define("DB_USER","aspenonl_admin");
	define("DB_PASS","D4Ao%(eq=teP");
	define("DB_NAME","aspenonl_db");
}
