<?php 



class mylala extends controller {


	public function __construct() {


		parent::__construct();
		
		ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                
                

		$this->view->header = "public/requires/header.php";
		$this->view->footer = "public/requires/footer.php";
                                
                                
                
		global $CONF;
                
                
		$this->admin_model = $this->model->load("admin_model");
                
                
                
                                

		$this->view->title = "Register";

		$this->view->js = array("plugins/iCheck/icheck.min", "formvalidate");
		$this->register = $this->model->load("register_model");


		$this->view->header = "public/requires/header.php";

                                


		$this->view->title = "Admin";

		$this->view->header = "public/requires/adminpanel.php";

		$this->user_data = $this->model->load("user_data_model");



		$this->view->css = [
		"admin/animate.css",
		"admin/style.css",
		];


		$this->view->js = [
		"default",
		"ajax",
		"purge",
		"admin/jquery-2.1.1",
		"admin/bootstrap.min",
		"admin/plugins/metisMenu/jquery.metisMenu",
		"admin/plugins/slimscroll/jquery.slimscroll.min",
		"admin/inspinia",
		"admin/plugins/pace/pace.min",

		];


	}



	function test(){
 	
	$dashboard_model = $this->model->load("dashboard_model");
	
	
	$dashboard_model->trigger_roll_call();
	$dashboard_model->tidy_up_affairs();
	
		
	 $dashboard_model->check();
	 echo "hi";
	}



        
        public function checkLogin(){
            if (!$this->admin_model->check_logged_in()) {

            header("location:" . URL . "/login");
            exit;
        }
        }
        
        
        public function set_list(){
        
          $no = $_POST['no'];
          
          if(intval($no) > 0){
          	
          	$this->admin_model->update_no_people_list($no);
          
          }
          
          header("location:".URL."/mylala/set_time");
        
        }
        
        
        public function set_list_status($list_status){
         
         	
         	$this->admin_model->set_list_status($list_status);
         	
          header("location:".URL."/mylala/set_time");
         	
        
        }
        
        
        public function set_announcement(){
        
        $announcement = $_POST['news'];
        
        $this->admin_model->add_announcement($announcement);
        
             header("location:".URL."/mylala/set_time");
        
        }
        
                                
	public function index() {
                                

                $this->checkLogin(); 
                                
                header("location:" . URL . "/mylala/admins"); 

	}
        
        
        public function register_new(){
                                
            $this->view->render("admin/index");
            
        }
        
        
        public function admins(){
             
             $this->checkLogin();   
             
             $admins = $this->admin_model->get_admins(); 
	     $this->view->render("admin/admins", ["admins"=>$admins]);
        }



        public function members(){ 
             $this->checkLogin();   
             
             $admins = $this->admin_model->get_members(); 
	     $this->view->render("admin/members", ["admins"=>$admins]);
        }
        
	public function remove($id){

 		$this->admin_model->admin_remove($id);
		header("location:".URL."/mylala/members");
	}
	
	
	
        public function set_time($accept=null){
                    
        $errors = "";            
				if($accept!=null){
                                    
                                
					$set_time = $_POST['next_time'];
					$repeat = $_POST['repeat_after'];
                                
					$this->admin_model->set_action_time($set_time, $repeat);
                                

				} 
                                
                 $action_time = $this->admin_model->get_action_time();
                 
                 $no_of_people = $this->admin_model->get_no_people_per_list();
                 
                 $list_status = $this->admin_model->get_list_status();
                 
                 $news= $this->admin_model->get_announcement();
                 
                 
                 
		 $this->view->render("admin/set_time", ["action_time"=>$action_time, "errors"=>$errors, "news"=>$news, "no"=>$no_of_people, "list_status"=>$list_status]); 
	}
        

	public function register(){
 		if (isset($_POST["firstname"])) {

                             
			extract(sanitize::arry($_POST));
			
			$name = $firstname;

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
				
				
                                
                                
				$register = $this->register->join(sanitize::arry($_POST), true, $_POST['section']);


			} catch (exception $e) {
				
					header("Location: " .URL . "/mylala?error=".$e->getMessage());exit;
			
			}
		}

	}
	private function load_flush($admin_acc, $type) {

		$acc = ["id"=>[], "name"=>[]];



		

		for ($i=0; $i < sizeof($admin_acc); $i++) { 


			switch ($type) {
				case '1':
					$f = $this->admin_model->get_admin_acc_flush_one($admin_acc[$i]);
					break;

				case '2':
					$f = $this->admin_model->get_admin_acc_flush_two($admin_acc[$i]);
					break;


				case '3':
					$f = $this->admin_model->get_admin_acc_flush_three($admin_acc[$i]);
					break;

				case '4':
					$f = $this->admin_model->get_admin_acc_flush_four($admin_acc[$i]);
					break;

				case '5':
					$f = $this->admin_model->get_admin_acc_flush_five($admin_acc[$i]);
					break;
				
				
			}
			
			


			if ($f === false) {

				continue;


			} else {

				$user_name = $this->user_data->user_profile($f);


				array_push($acc["name"], $user_name["username"]);

				array_push($acc["id"], $f);


				//array_push($acc["section"], $f["section"]);

			}

		}



		return $acc;

	}


	public function flood($type) {

		/**/


		if(isset($_POST["account"])) {

			$id = sanitize::int($_POST["account"]);

			switch ($type) {

				case '0':
					

					$flood = $this->admin_model->flood($id, 'one');


					break;

				case '1':
					
					$flood = $this->admin_model->flood($id, 'two');


					break;

				case '2':
					

					$flood = $this->admin_model->flood($id, 'three');

					break;

				case '3':
					

					$flood = $this->admin_model->flood($id, 'four');

					break;

				case '4':
					

					$flood = $this->admin_model->flood($id, 'five');

					break;
				
				
			} 



			header("Location: " . URL . "/mylala");

		}


	}
        
        

	

	public function purge() {


		$this->admin_model->remove_user();


	}




}



?>