<?php

class MarketData extends DatabaseObject{

	static protected $table_name = "market_data";
	static protected $db_columns = ['name','google_ss_id'];

	public $id;
	public $name;
	public $google_ss_id;

	public function __construct($args=[]) {
		foreach ($args as $key => $value) {
			if (property_exists($this,$key)) {
				$this->$key = $value;
			}
		}
	}

}
?>