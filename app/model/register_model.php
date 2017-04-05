<?php 



defined("BASEURL") OR die("Direct access denied");



class register_model extends model {





	public function __construct() {

		parent::__construct();

	}





	public function join($registeration_data, $admin=false, $section='') {

		global $CONF;

		

		extract($registeration_data);



		$url      = URL;

		$logoLink = $CONF["auralz_logo_path"];

		$logoImg  = eMailer::auralzMailerImg($logoLink);

		$subject  = "Welcome"; 

		$appname = APP_NAME;

	

		$message =

"

<html>

	<head>

		<title>Welcome message</title> 

		<style>

			body {

				border: 1px solid #ccc;

				background-color: #ebebeb;

				padding: 1.3rem;

			}

		</style>

	</head>

	<body>

		<section>

			<img src='$logoImg'>

			<h1>$appname community</h1>

			<br>

			<div class='messageWrapper'>

				<div>

					<p>Thank you $firstname for signing up to our community.</p>

					<p>Below is your login details thanks.</p>

				</div>

				<br>

				<p>Your username is: $username</p>

				<p>Password :$password</p>

				<p>Please keep your password secret. $appname will never ask you to send your password.</p>

			</div>

			<br>

			<footer><p>Thank you.</p><p>$appname Team.</p></footer>

		</section>

	</body>

</html>

";

		//send verification mail.

		//eMailer::auralzMailer($email, $subject, $message, "do-not-reply", NULL, "An error occurred please try again letter");



		try {

			$this->db->t_begin(); // begin transaction


                        
			$this->db->saveInto("members", [ 

                                ":idu"=>0,

				":name"=>$firstname,

				":username"=>$username,

				":email"=>$email,

				":password"=>$password,

				":phonenumber"=>$phonenumber,

				":bank_name"=>$bankname,

				":acc_name"=>$accountname,

				":acc_number"=>$accountnumber,

				":block"=>0,

				":reg_date"=>$CONF["datetime"],
                                
                                ":admin_user"=>  0

				], "INSERT")->execute();

                        
			$id = $this->db->getLastInsertId();

                        

			if($admin){ 

				$this->db->saveInto("receive_queue", [

				":id"=>0,

				":idu"=>$id,

				":amount"=>$this->get_amount($section),

				":complete"=>'0', 
                                
                                ":section"=>"",
                                    
                                ":listed"=>0
				], "INSERT")->execute();


			}


                        $this->db->t_commit(); // commit transaction


			

			cookie::set("name", $username);

			cookie::set("email", $email);

			session::set("name", $username);
			
		

			session::set("ip", encrypt::ip());

	
			if($admin){
		
			session::set("admin", true);
			cookie::set("admin", true);
			

			header("Location: " .URL . "/mylala");exit;
			}
			

			header("Location: " .URL . "/dashboard");exit;



		} catch (PDOException $e) {



			$this->db->t_rollback(); // roll back transactions

			header("Location: " .URL . "/register?error=".$e->getMessage());exit;

			//die("Error! " . $e->getMessage());

		}

		

	} 
	
	
	private function get_amount($section){
                
                        
              
              return intval($section);
            
            
        }
	private function get_id_column($section){
	
	
		switch($section){
			case "section_one":
				return "id_one";
				
			case "section_two":
				return "id_two";
				
			
			case "section_three":
				
				return "id_three";
				
			
			case "section_four":
				return "id_four";
				
			case "section_five":
				return "id_five";
				
			
				
				
		}
	
	}



	public function verify_exist($user, $email) {



		$v = $this->db->select(["idu"])->from("members")->where(["username"=>$user])->cond("OR",["email"=>$email])->fetch();



		if (!empty($v)) {

			return true; // username and password exist

		} 



		return false; 

	}







	public function edit($data, $id) {

		extract($data);



		$this->db->saveInto("members", [

			"name"=>$fullname,

			"phonenumber"=>$phonenumber,

			"bank_name"=>$bankname,

			"acc_name"=>$accname,

			"acc_number"=>$accnumber,

			], "UPDATE")->where(["idu"=>$id])->execute();





		header("Location: ". URL ."/dashboard/settings?success=You have updated your profile");



	}

	/*

	public function account_details_check($acc_number,$acc_name) {



		$v = $this->db->select(["ida"])->from("account_details")->where(["acc_number"=>$acc_number])->cond("OR", ["acc_name"=>$acc_name])->fetch();



		if (empty($v)) {

			return false;

		}



		return true;

	}



	public function verification($data) {



		extract($data);



		$verify = $this->db->select()->from("verify")->where(["user"=>$user])->cond("AND",["sid"=>$sid])->cond("AND",["confirm_code"=>$code])->fetch();



		if (empty($verify)) {



			return false;



		} else {



			$this->db->delete("verify")->where(["user"=>$user])->execute();

		}



		return true;

	}*/



}



?>