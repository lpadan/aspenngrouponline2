<?php

class Spreadsheet extends DatabaseObject{

	static protected $table_name = "spreadsheets";
	static protected $db_columns = ['name','project_id','google_id'];

	public $id;
	public $name;
	public $project_id;
	public $google_id;

	public function __construct($args=[]) {
		foreach ($args as $key => $value) {
			if (property_exists($this,$key)) {
				$this->$key = $value;
			}
		}
	}

}
?>