<?php

	class ImageMap extends DatabaseObject{

		static protected $table_name = "image_map";
		static protected $db_columns = ['unit_id','image_file_name','label_percentages','poly_coordinates'];

		public $unit_id;
		public $image_file_name;
		public $label_percentages;
		public $poly_coordinates;
		
		

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