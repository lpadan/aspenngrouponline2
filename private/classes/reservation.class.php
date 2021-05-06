<?php

class Reservation extends DatabaseObject{

	static protected $table_name = "reservations";
	static protected $db_columns = ['project_id','priority_num','selection_time','selected_unit_id'];

	public $id;
	public $project_id;
	public $priority_num;
	public $selection_time;
	public $selected_unit_id;

	public function __construct($args=[]) {
		foreach ($args as $key => $value) {
			if (property_exists($this,$key)) {
				$this->$key = $value;
			}
		}
	}

}
?>