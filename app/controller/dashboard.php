<?php 







class dashboard extends controller {

	public function __construct() {



		parent::__construct();

		$this->user = $this->model->load('check_login_model');


		ini_set('display_errors', 1);
		
		$this->username = $this->user->fetch_name();

		$this->fullname = $this->user->fetch_fullname();

		$this->id       = $this->user->fetch_id();





 






		$this->view->header = "public/requires/dashboard.php";

		$this->view->footer = "public/requires/footer.php";



		$this->section_model = $this->model->load("section_model");

		$this->dashboard_model = $this->model->load("dashboard_model");

		$this->user_data       = $this->model->load("user_data_model");







		$approvals = $this->dashboard_model->get_pending_approval($this->id);

		

		if(empty($approvals[0]["idq"])) {

			$this->num_app = 0;

		} else {

			$this->num_app = count($approvals);

		}

		

	}



        public function view_list($uid = null, $message = null){ 
                                
                //$this->dashboard_model->trigger_roll_call();

                if($uid==null){
                	header("location:".URL."/dashboard");
                	exit;
                }

                $uid = base64_decode($uid);
                
                
                $pending_payment = $this->dashboard_model->how_much_should_payer_pay($uid);


                if($pending_payment>0){
					header("location:".URL."/dashboard/ds4948s");
                	exit;

                }

                                
         
		$this->view->title = "Payment List";
		
		
		
		$list_status  = $this->dashboard_model->get_list_status();
                 
                
                                

		$data = $this->dashboard_model->get_payment_list();
                
                $publication_date = $this->dashboard_model->getLastPublicationTime();
                
                $amount_owed = $this->dashboard_model->how_much_should_payer_pledge($this->id);
                
                
                $next_publication = date("l h:i:s A", $this->dashboard_model->get_action_time());
                  
                 
                
                $my_data['idu'] = $uid;
                
		$this->view->render("dashboard/payment_list", ['data'=>$data,"list_status"=>$list_status, "next_publication"=>$next_publication, "published_date"=>$publication_date, "amount_owed"=>$amount_owed,"my_data"=>$my_data, "user_id"=>$this->id, "message"=>$message]); 
                }
           
                                
	
        
        
        //reserve user for payment renamed for security reasons
        public function preview(){
           
           //if all the pledges to this user on match_id is less than he is expecting
            
                                
            
            $sender = base64_decode($_POST[base64_encode("payer")]);
            $receiver = base64_decode($_POST[base64_encode("payee")]);
            $amount = base64_decode($_POST[base64_encode("amount")]);
            $amount_pledged = $_POST['amt'];
            
            
               $message = "Invalid Donation";
               
            
            
            if($sender === NULL || $receiver ===NULL || $amount === NULL || $amount_pledged===NULL){
                                
               header("location:".URL."/dashboard/view_list/".$sender."/".base64_encode($message)); exit;
            }
                                
                    
           if($sender== $receiver){
           
           	    header("location:".URL."/dashboard/view_list/".$sender."/".base64_encode("You cant reserve yourself for payment!")); exit;
           }
           
           $user_can_reserve = $this->dashboard_model->can_user_reserve($sender);
           
           
           if(!$user_can_reserve){
           
           	
           	    header("location:".URL."/dashboard/view_list/".$sender."/".base64_encode("You are not allowed to make reservations when you have incomplete incoming/outgoing transactions")); exit;
           
           }
           
           
                                     
           
           $amount_owed = $amount;
           
           
           $amount_payable_by_this_user = $amount_pledged;
           
           global $CONF;
                                
           if($amount_owed > 0 && $amount_payable_by_this_user >=$CONF['min_pledge'] && $amount_payable_by_this_user <= $CONF['max_pledge']){
               
                                
            if($amount_pledged > $amount_owed){
                //die(var_dump($amount_owed));
                
               header("location:".URL."/dashboard/view_list/".$sender."/".base64_encode("Amount pledged is higher than what receiver should get")); exit;
                
            }
            
            
            
            $remainder = $amount_owed - $amount_pledged;
            
            if($remainder > 0 && $remainder < $CONF['min_pledge']){
            
            	 header("location:".URL."/dashboard/view_list/".$sender."/".base64_encode("Amount pledged will leave receiver with an unpayable remainder ( less than minimum pledge)")); exit;
            }                    

           $this->dashboard_model->match($receiver, $sender, $amount_payable_by_this_user, $amount_owed);
           header("location:".URL."/dashboard"); exit;            
                                
           }
                                
                                
           
           
           header("location:".URL."/dashboard/view_list/".$sender."/".base64_encode($message)); exit;
                                
           
                                
           
            
        }
        
        
                                

	public function index() { 
               // $this->dashboard_model->tidy_up_affairs();
                
		$id = $this->id; 

		//------------Get profile data--------------------//

		$my_data = $this->user_data->user_profile($id);

		//-----------End profile data --------------------//
                                

		//$id = $this->id;
                                

		$approvals = $this->dashboard_model->get_pending_approval($id);





		//------Setting pending approvals------------//

		

		

		if ($approvals !== false) {

			$this->num_approval = count($approvals);



			$approvals_list = array(

				"pay_section"    => [],

				"pay_amount"     => [],

				"payee_username" => [],

				"payee_fullname" => [],

				"payee_phone"    => [],

				"payee_email"    => [],

				"payee_id"       => [],

				"queue_id"       => [],

				"section_id"     => [],

				);



                        
                        $i =0;



				$payee_id    = $approvals[$i]["payer_id"];

				$pay_section = $approvals[$i]["section"];

				$pay_amount  = $approvals[$i]["amount"];

				$queue_id    = $approvals[$i]["id"];

				$section_id    = $approvals[$i]["section_id"];



				$get_payee_data = $this->user_data->user_profile($payee_id);



				$payee_username = $get_payee_data["username"];

				$payee_fullname = $get_payee_data["name"];

				$payee_email    = $get_payee_data["email"];

				$payee_phone    = $get_payee_data["phonenumber"];



				array_push($approvals_list["pay_section"], $pay_section);

				array_push($approvals_list["pay_amount"], $pay_amount);

				array_push($approvals_list["payee_username"], $payee_username);

				array_push($approvals_list["payee_fullname"], $payee_fullname);

				array_push($approvals_list["payee_email"], $payee_email);

				array_push($approvals_list["payee_phone"], $payee_phone);

				array_push($approvals_list["payee_id"], $payee_id);

				array_push($approvals_list["queue_id"], $queue_id); 

				array_push($approvals_list["section_id"], $section_id); 

			

		} else {

			$approvals_list = false;

		} 



			

		//------End setting pending approvals-----------//



		$pay = $this->dashboard_model->get_user_to_pay($id);

                
                $outstanding = $this->dashboard_model->how_much_should_payer_pledge($this->id);
                                
		//print_r($pay);exit;

                if($pay!=false){

		$my_pay = array();

                                

			$pay_data = $this->user_data->user_profile($pay[0]["receiver_id"]);



                                

					$my_pay[1] = [

						"fullname"    =>null,

						"username"    =>null,

						"email"       =>null,

						"phonenumber" =>null,

						"bank_name"   =>null,

						"acc_name"    =>null,

						"acc_number"  =>null,

						"expire_date" =>null,

						"amount"      =>null,

						];



		

					$my_pay[1]["fullname"]    = $pay_data["name"];

					$my_pay[1]["username"]    = $pay_data["username"] ;

					$my_pay[1]["email"]       = $pay_data["email"] ;

					$my_pay[1]["phonenumber"] = $pay_data["phonenumber"] ;

					$my_pay[1]["bank_name"]   = $pay_data["bank_name"] ;

					$my_pay[1]["acc_name"]    = $pay_data["acc_name"] ;

					$my_pay[1]["acc_number"]  = $pay_data["acc_number"] ;

                $my_pay[1]["expire_date"] = date("Y-m-d H:i:s", intval($pay[0]["expiry_date"])  );
                                
                                

					$my_pay[1]["amount"] 	  = $pay[0]["amount"] ;
                                

                }
		//section one

		$one = $this->dashboard_model->section_one($id);

		//section one

		$two = $this->dashboard_model->section_two($id);

		//section one

		$three = $this->dashboard_model->section_three($id);

		//section one

		$four = $this->dashboard_model->section_four($id);

		//section one

		$five = $this->dashboard_model->section_five($id);

		



		$section = array($one,$two,$three,$four,$five);





		$received =  $this->dashboard_model->get_recieved($id);
		 
                                
		$send     =  $this->dashboard_model->get_sent($id);


                $pending = intval($this->dashboard_model->get_pending_payment($id));

		$tranz = array($received, $send, $pending);
		
		$news = $this->dashboard_model->get_announcement();
		

		$this->dashboard_model->tidy_up_affairs();
		//print_r($section); exit;



		// /"approvals_list"=>$approvals_list, 

		//-------------- 

		$this->view->render("dashboard/index", ["my_data"=>$my_data,"pay"=>$my_pay,  "news"=>$news, "section"=>$section, "num"=>$this->num_approval, "outstanding"=>$outstanding, "transaction"=>$tranz, "approvals_list"=>$approvals_list]);



	}



        public function purge_user_admin($user_id){
            
            
           $queue = $this->dashboard_model->get_queue($user_id);
                                
           if($queue !=null){
               
               $type = $queue['section'];
               $id = $queue['idu'];
                                


                                

			switch ($type) {

				case '1':

					$type = "one";

					break;



				case '2':

					$type = "two";

					break;



				case '3':

					$type = "three";

					break;



				case '4':

					$type = "four";

					break;

					

				case '5':

					$type = "five";

					break;

				

				default:

					header("Location: " . URL . "/dashboard");exit;

					break;

			}

			//echo $data["idu"] . "<br>";

			//echo $type;exit;

			$this->dashboard_model->remove($queue['payto'], $queue['idu'], $type);
                                

               
           }
           
		header("Location: " . URL . "/mylala/admins");
        }




	public function purge($match_id) {

                                
                                
                $this->dashboard_model->purge(base64_decode($match_id));

		header("Location: " . URL . "/dashboard");

	}





	public function section($type=null) {







		//

		if ($type !== null) {



			$type = sanitize::string($type); 

			switch ($type) {

				case 'one':

					# code...

					//$queue = $this->section_model->set_queue('1', $this->id);	

					//if ($queue === true) 

                                
						$this->section_model->set_section_one($this->id); 

					break;
 	


				case 'two':

					# code...

					//$queue = $this->section_model->set_queue('2', $this->id);	

					//if ($queue === true) 

						$this->section_model->set_section_two($this->id);

					break;



				case 'three':

					# code...

					//$queue = $this->section_model->set_queue('2', $this->id);	

					//if ($queue === true) 

						$this->section_model->set_section_three($this->id);

					break;



				case 'four':

					# code...

					//$queue = $this->section_model->set_queue('2', $this->id);	

					//if ($queue === true) 

						$this->section_model->set_section_four($this->id);

					break;





				case 'five':

					# code...

					//$queue = $this->section_model->set_queue('2', $this->id);	

					//if ($queue === true) 

						$this->section_model->set_section_five($this->id);

					break;



				default:

					# code...

					break;

			}

			 
			header("Location: " .URL . "/dashboard");

		}

	}



/*	public function approvals() {



		$id = $this->id;



		$approvals = $this->dashboard_model->get_pending_approval($id);





		if ($approvals !== false) {

			$this->num_approval = count($approvals);



			$approvals_list = array(

				"pay_section"    => [],

				"pay_amount"     => [],

				"payee_username" => [],

				"payee_fullname" => [],

				"payee_phone"    => [],

				"payee_email"    => [],

				"payee_id"       => [],

				"queue_id"       => [],

				"section_id"     => [],

				);



			for ($i=0; $i < $this->num_approval; $i++) 

			{ 



				$payee_id    = $approvals[$i]["idu"];

				$pay_section = $approvals[$i]["section"];

				$pay_amount  = $approvals[$i]["amount"];

				$queue_id    = $approvals[$i]["idq"];

				$section_id    = $approvals[$i]["section_id"];



				$get_payee_data = $this->user_data->user_profile($payee_id);



				$payee_username = $get_payee_data["username"];

				$payee_fullname = $get_payee_data["name"];

				$payee_email    = $get_payee_data["email"];

				$payee_phone    = $get_payee_data["phonenumber"];



				array_push($approvals_list["pay_section"], $pay_section);

				array_push($approvals_list["pay_amount"], $pay_amount);

				array_push($approvals_list["payee_username"], $payee_username);

				array_push($approvals_list["payee_fullname"], $payee_fullname);

				array_push($approvals_list["payee_email"], $payee_email);

				array_push($approvals_list["payee_phone"], $payee_phone);

				array_push($approvals_list["payee_id"], $payee_id);

				array_push($approvals_list["queue_id"], $queue_id); 

				array_push($approvals_list["section_id"], $section_id); 

			}

		} else {

			$approvals_list = false;

		}





		$this->view->render("approval/index", ["approvals_list"=>$approvals_list, "num"=>$this->num_app]);

	}

*/





	public function accept_pay() {

		

                                

		if (isset($_POST["p_i"]) && isset($_POST["s_p"]) && 

			isset($_POST["q"])   && isset($_POST["s_i"])) {

                        

                                

			$idu        = sanitize::int($_POST["p_i"]);
                                

			$payto      = $this->id;

                        $queue = $_POST["q"];

			
                        $this->dashboard_model->confirm($queue);        

			}

			

			header("Location: " . URL ."/dashboard");

                                




	}


        
        public function accept_pay_admin($q) {

		

                                
                        $queue = $this->dashboard_model->get_queue($q);
                                
                                
                         if($queue == null){ header("location:".URL."/mylala/admins"); exit;}
                         
                                
                      
                         
			$idu        = $queue['idu'];

			$section_id = $queue['section_id'];

			$payto      = $queue['payto'];

			$section    = $queue['section'];

                                
			//echo $section;exit;

                                    

			$model_queue = $this->model->load("queue_model");

                                



			$data = array(

				"idu"=>$idu,

				"section_id"=>$section_id,

				"payto"=>$payto,

				"section"=>$section

				);

			

			

			//print_r($data);exit;

                        

                                
			switch ($section) {

				case '1':

					$model_queue->section_one_upgrade($data) ;

					break;



				case '2':

					$model_queue->section_two_upgrade($data) ;

					break;



				case '3':

					//print_r($data); exit;

					$model_queue->section_three_upgrade($data) ;

					break;





				case '4':

                                   

					$model_queue->section_four_upgrade($data) ; 

					break;



				case '5':

					//print_r($data);exit;
                                
					$model_queue->section_five_upgrade($data) ;

					break;



				

				default:

					# code...

					break;

			}

			

			header("Location: " . URL ."/mylala/admins"); 

		}





	





	public function settings() {



		$this->view->title = "Settings";
                                
		$data = $this->user_data->user_profile($this->id); 
		$this->view->render("dashboard/settings", ["user"=>$data, "num"=>$this->num_app]);



	}



	public function edit() {



		if (isset($_POST["fullname"]) && isset($_POST["phonenumber"]) &&

			isset($_POST["bankname"]) && isset($_POST["accname"]) && 

			isset($_POST["accnumber"])) {









			$firstname = sanitize::string($_POST["fullname"]);

			$phone     = sanitize::string($_POST["bankname"]);

			$bankname  = sanitize::string($_POST["phonenumber"]);

			$accname   = sanitize::string($_POST["accname"]);

			$accnumber = sanitize::string($_POST["accnumber"]);





			if ($firstname != ''  || $password != '' || $accnumber != '' || 

				$bankname != "" || $phone != "") {



				$this->model->load("register_model")->edit(sanitize::arry($_POST), $this->id);



			}



			



		}



		//echo "treu";





	}






public function  contact(){
	$this->view->render("dashboard/contact");
}




	public function logout() {





		cookie::terminate("name", true);

		session::terminate("name");

		session::terminate("ip");



		header("Location: " . URL . "/home");







	}

}





?>