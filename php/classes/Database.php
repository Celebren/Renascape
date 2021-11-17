<?php
namespace Database;


/**
 * Facade class for mysqli queries
 */

Class Database {
	private static $conn = null;

	private static function connector() : void {
		if (!isset(self::$conn)) {
			// Create connection
			$aData = json_decode(file_get_contents("../scape.ini"), true);
			self::$conn = new \mysqli($aData["Server"], $aData["User"], $aData["Pass"], $aData["Db"]);
	
			// Check connection
			if (self::$conn->connect_error) {
				die("Connection failed: " . self::$conn->connect_error);
			}
		}
	}

	private static function closeConnection() : void {
		self::$conn->close();
		self::$conn = null;
	}

	/**
	 * Execute select query and return associative array of results
	 * @param string $sql query to execute
	 * @return array array of results. Empty if no results found
	 */
	public static function select(string $sql) : array {
		self::connector();
		$rows = [];

		$result = self::$conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		} else {
			error_log("Error selecting from database: " . self::$conn->error);
		}

		self::closeConnection();
		return $rows;
	}

	/**
	 * Execute insert query and return the last ID inserted
	 * @param string $sql query to execute
	 * @return int ID of last row inserted. 0 if none inserted
	 */
	public static function insert(string $sql) : int {
		self::connector();
		$id = 0;

		if (self::$conn->query($sql) === TRUE) {
			$id = self::$conn->insert_id;
		} else {
			error_log("Error inserting to database: " . self::$conn->error);
			error_log($sql);

		}

		self::closeConnection();
		return $id;
	}

	/**
	 * Delete all entries in a table
	 * @param string $sTable table name
	 * @return void
	 */
	public static function deleteAll(string $sTable) : void {
		self::connector();
		$sql = "DELETE FROM $sTable";

		if (self::$conn->query($sql) === TRUE) {
			error_log("Deleted all entries in $sTable");
		} else {
			error_log("Error deleting record: " . self::$conn->error);
		}
		
		self::closeConnection();
	}

	public static function escapeString(string $s) : string {
		self::connector();
		return self::$conn->real_escape_string($s);
	}
}