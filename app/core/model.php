<?php 

defined("BASEURL") OR die("Direct access denied");


class model  {

	public function __construct() 
	{
		// database
		$this->db = new dbQuery; 
		
	}

	public function load($file) {
		if (file_exists("app/model/$file.php")) {
			require "app/model/$file.php";
			return new $file();
		}
	}  
}

?>