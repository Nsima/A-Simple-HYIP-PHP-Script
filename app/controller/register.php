<?php



/**

* 

*/

class register extends controller

{





	public function __construct() {

		parent::__construct();
 

		$this->view->title = "Register";



		$this->view->js = array("plugins/iCheck/icheck.min", "formvalidate");

		$this->register = $this->model->load("register_model");





		$this->view->header = "public/requires/header.php";

	}

	

	public function index($user=false) {






		//$id = '1';

		//$name = "Admin";



		//session::set("referral", $id);

		//session::set("ref_name", $name);



		$this->view->render("register/index");



	}





	public function join() {

 

		if (isset($_POST["firstname"])) {



                             

			extract(sanitize::arry($_POST));



			try {

				// check if required data are empty

				if ($name === "" || $username  === "" || 

					$phonenumber === "" || $email     === "" || 

					$password    === "" || $accountname === "" ||

					$bankname  === "" || $accountname === "") {



					throw new Exception("All fields are required.", 1);

				} 



				$v = validateEmail($email);

				$v1 = validateUsername($username);



				if ($v != "") throw new Exception("$v", 1);

				if ($v1 != "") throw new Exception("$v1", 1);

				 



				if ($email !== $re_email) {

					throw new Exception("Both email address those not match.", 1);

				}



				// verify password

				if ($password !== $re_password) {

					throw new Exception("Both password those not match.", 1);

				} 



				



				//check if account username exist

				$verify = $this->register->verify_exist($username, $email);



				if ($verify === true) {

					throw new Exception("User already exists", 1);

					

				}



		

				$botcheck = $_POST['template-contactform-botcheck'];



				if( $botcheck != '' ) {



					throw new Exception("Bot <strong>Detected</strong>.! Clean yourself Botster.!", 1);



				}

				

                               

				$register = $this->register->join(sanitize::arry($_POST));





			} catch (exception $e) {

				

					header("Location: " .URL . "/register/?error=".$e->getMessage());exit;

			

			}

		}

	}

}





?>