<?php


class login extends controller {

	public function __construct() {

		parent::__construct();

		$this->view->title = "Login";

		$this->view->header = "public/requires/header.php";
		$this->view->footer = "public/requires/footer.php";
	}


	public function index() {

		$this->view->render("login/index");

	}

	public function forgot($accept = null){
ini_set("display_errors", 1); 
		$message = '';

		if($accept != null){
			if(isset($_POST['email'])){
				$email = $_POST['email']; 
				$password = $this->model->load("login_model")->send($email); 
				if(count($password)){
					$r = $password[0]['password'];
					mail($email, "INVESTMENTSHUB: FORGOT PASSWORD", "Hi there, Your password at investmentshub.com is $r. Do have a wonderful day.", "FROM: info@investmentshub.org");
					$message = "An Email Has Been Sent to Your Mail Address. Cheers. ";
				}else{
					$message = "This email is not registered with InvestmentsHub."; 
				}
			}
			//process email
			//set message to what you want it to be

		}
		$this->view->title = "Forgot Password";
		$data["message"]= $message ;
		$this->view->header = "public/requires/header.php";
		$this->view->footer = "public/requires/footer.php";
		$this->view->render('login/forgot', $data);
	}


        
        
        public function mylala(){ 
               $this->view->render("login/index", ["admin"=>true]);
            
        }

	public function authenticate() {

		global $CONF;

		if (isset($_POST["username"]) && isset($_POST["password"])) {

			try {
				
				$username = sanitize::string($_POST["username"]);
				$password = sanitize::string($_POST["password"]);
				
				if($username === $CONF["mylala"] && $password === $CONF["mylala_password"]) {
					
					session::set("mylala", $CONF["mylala"]);
					session::set("mylala_ip", encrypt::ip());
					
					header("Location: ".URL."/mylala");exit;
					
				}

				if ($username === "" || $password === "") {
					throw new Exception("All fields are required.", 1);
				}
                                 

				$this->model->load("login_model")->grant_access($username,$password);
				
						
				
				
				

			} catch (Exception $e) {
				header("Location: " .URL."/login/?error=".$e->getMessage());exit;
			}
				


		}
	}

}


?>