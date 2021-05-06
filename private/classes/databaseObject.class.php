<?php

class DatabaseObject {

	static protected $autoIncrementId = true; // NOTE: in child classes, do NOT include the id column in the $db_columns array if the id is autoIncremented
	static protected $database;
	static protected $table_name = "";
	static protected $columns = [];
	public $errors = [];


	public function attributes() {
		$attributes = [];
		foreach(static::$db_columns as $column) {
			// if ($column == 'id') { continue; }
			$attributes[$column] = $this->$column;
		}
		return $attributes;
	}

	public function create() {
		// ADD: check db to make sure the id has not been used.
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO " . static::$table_name . " (";
		$sql .= join(', ', array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		$result = self::$database->query($sql);

		if (!$result) {
			echo self::$database->error;
		}
		//use only if the id is auto incremented and need to retrieve it
		if (static::$autoIncrementId) {
			if ($result) {
				$this->id = self::$database->insert_id;
			}
		}
		return $result;
	}

	public function delete() {
		$sql = "DELETE FROM " . static::$table_name . " ";
		$sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
		$sql .= "LIMIT 1";
		$result = self::$database->query($sql);
		return $result;
	}

	static public function find_by_sql($sql) {
		$result = self::$database->query($sql);
		if (!$result) {
			echo self::$database->error;
			exit("Database query failed.");
		}
		// convert results into objects
		$object_array = [];
		while($record = $result->fetch_assoc()) {
			$object_array[] = static::instantiate($record);
		}
		$result->free();
		return $object_array;
	}

	static public function find_by_id($id) {
		$sql  = "SELECT * FROM " . static::$table_name . " ";
		$sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
		$obj_array = static::find_by_sql($sql);
		if (!empty($obj_array)) {
			return array_shift($obj_array);
		} else {
			return false;
		}
	}

	static public function find_all() {
		$sql = "SELECT * FROM " . static::$table_name; // late static binding
		return static::find_by_sql($sql);
	}

	static protected function instantiate($record) {
		$object = new static;
		// assign values to properties
		foreach($record as $property => $value) {
			if (property_exists($object,$property)) {
				$object->$property = $value;
			}
		}
		return $object;
	}

	public function merge_attributes($args=[]) {
		foreach($args as $key => $value) {
			if (property_exists($this,$key) && !is_null($value)) {
				$this->$key = $value;
			}
		}
	}

	protected function sanitized_attributes() {
		$sanitized = [];
		foreach($this->attributes() as $key => $value) {
			$sanitized[$key] = self::$database->escape_string($value);
		}
		return $sanitized;
	}

	static public function set_database($database) {

		self::$database = $database;
	}

	public function update() {
		// $this->validate();
		// because I display the ID field, the user can change the ID and then the update won't work because the ID is not found in the db.
		// in order to change the ID, the user must delete the submittal, so don't display the ID input field in the edit form.

		if (!empty($this->errors)) { return false;}
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = [];
		foreach($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE " . static::$table_name . " SET ";
		$sql .= join(', ', $attribute_pairs);
		$sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
		$sql .= "LIMIT 1";
		$result = self::$database->query($sql);
		echo self::$database->error;
		return $result;
	}

	protected function validate() {
		$this->errors = [];
		// ADD custom validation
		return $this->errors;
	}

}

?>