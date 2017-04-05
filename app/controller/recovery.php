<?php 

class recovery extends controller {


	public function index() {
		$this->view->render("recovery/index");
	}



	public function verify_user() {
		
		if (isset($_POST["username"])) {
			try {


				if (is_numeric(sanitize::int($_POST["username"]))) {
						throw new Exception("User not found", 1);	
				}

				$v = $this->model->load("user_data_model")->user_profile(sanitize::string($_POST["username"]));

				if($v === false) {

					throw new Exception("User not found", 1);

				} elseif($v["block"] == '1') {

					throw new Exception("This account has been blocked. Contact support.", 1);
				

				}

				$this->message();
			

			
			} catch (PDOException $e) {
				
			}
			
		
	}
}


?>