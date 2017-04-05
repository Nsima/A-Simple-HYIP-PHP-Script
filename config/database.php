<?php 

defined("BASEURL") OR die();
/**
* PHP Data Object (PDO). databse class - only one connection alowed.
* Connection made at dbQuery class. 
* @see liberary dbQuery
**/
class dataBase {
	private $connection;
	private static $instance;
	private $type     = DBTYPE; 
	private $host     = DBHOST;
	private $database = DBNAME;
	private $username = DBUSERNAME;
	private $password = DBPASS;
	private $charset  = "utf8";

	/**
	* Get an instance og the Database
	* @return Instance
	**/
	public static function getDatabase() {
		if(!self::$instance) { // If no instance then make one
			self::$instance = new self();
		}
		return self::$instance;
	}

	// Constructor
	private function __construct() {
		try {
			$this->connection = new PDO($this->type.":host=".$this->host.";dbname=".$this->database.";charset="
				.$this->charset,$this->username,$this->password);
			$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			die ("Error: " . $e->getMessage());
		}
	}
	// Magic method clone is private to prevent duplication of connection.
	private function __clone() { }

	// Get PDO connect.
	public function getConnection() {
		return $this->connection;
	}
}
?>