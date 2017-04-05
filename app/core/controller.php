<?php 

defined("BASEURL") OR die("Direct access denied");

class controller {


	public function __construct() {
		$this->model = new model();
		$this->view = new view();
	}

}


?>