<?php

	class Unit extends DatabaseObject{

		static protected $table_name = "units";
		static protected $db_columns = ['name','display_name','project_id','building','type','description','sf','status','current_price','levels','bedrooms','baths','den'];

		public $id;
		public $name;
		public $display_name;
		public $project_id;
		public $building;
		public $type;
		public $description;
		public $sf;
		public $status;
		public $current_price;
		public $levels;
		public $bedrooms;
		public $baths;
		public $den;

		public function __construct($args=[]) {
			foreach ($args as $key => $value) {
				if (property_exists($this,$key)) {
					$this->$key = $value;
				}
			}
		}

		public function full_name() {
			return $this->first_name . " " . $this->last_name;
		}

		public function  set_hashed_password() {
			$this->hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
		}

	}


?>