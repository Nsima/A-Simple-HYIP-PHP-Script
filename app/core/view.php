<?php 


defined("BASEURL") OR die("Direct access denied");

class view {

	public function render($file, $data = array()) {

		if (file_exists("app/view/$file.php")) {
			require "app/view/$file.php";
		}

	}
}

?>