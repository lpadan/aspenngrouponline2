<?php

class Role extends DatabaseObject {

	static protected $table_name = 'roles';
	static protected $db_columns = ['description'];

	public $id;
	public $description = 'description';


	public function __construct($args=[]) {
		foreach ($args as $key => $value) {
			if (property_exists($this,$key)) {
				$this->$key = $value;
			}
		}
	}

}


?>