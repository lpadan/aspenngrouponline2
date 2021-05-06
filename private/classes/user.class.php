<?php

	class User extends DatabaseObject{

		static protected $table_name = "users";
		static protected $db_columns = ['first_name','last_name','user_name','hashed_password','email','exp_date'];

		public $id;
		public $first_name;
		public $last_name;
		public $email;
		public $user_name;
		public $hashed_password;
		public $exp_date;

		// public function __construct($args=[]) {
		// 	$this->first_name = ($args['first_name']) ? true : '';
		// 	$this->last_name = ($args['last_name']) ? true : '';
		// 	$this->email = ($args['email']) ? true : '';
		// 	$this->username = ($args['username']) ? true : '';
		// 	$this->password = ($args['password']) ? true : '';
		// 	$this->confirm_password = ($args['confirm_password']) ? true : '';
		// }

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