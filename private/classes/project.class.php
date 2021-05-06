<?php

class Project extends DatabaseObject{

	static protected $table_name = "projects";
	static protected $db_columns = ['name','folder_name','db_name','db_password','documents_folder_id','master_ss_id','schedules_ss_id','sales_ss_id'];

	public $id;
	public $name;
	public $folder_name;
	public $db_name;
	public $db_password;
	public $documents_folder_id;
	public $master_ss_id;
	public $schedules_ss_id;
	public $sales_ss_id;

	public function __construct($args=[]) {
		foreach ($args as $key => $value) {
			if (property_exists($this,$key)) {
				$this->$key = $value;
			}
		}
	}

}
?>