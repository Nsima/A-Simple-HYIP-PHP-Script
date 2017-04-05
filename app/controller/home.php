<?php 

class home extends controller {
	public function __construct() {

		parent::__construct();

		$this->view->header = "public/requires/header.php";
		$this->view->footer = "public/requires/ofooter.php";
	}

	public function index() {
	 
		$this->view->render("home/index");
	}
	
	
	function check(){
	
	$this->dashboard_model = $this->model->load("dashboard_model");
	
	$this->dashboard_model->check();
	
	
	}
}


?>