<?php 
defined("BASEURL") OR die("Direct access denied");

class login_model extends model {


	public function grant_access($username,$password, $admin=false) {


		//extract($data);

		$profile = $this->db->select(["email, block, admin_user"])->from("members")->where(["username"=>$username])->cond("AND", ["password"=>$password])->fetch();
                 
		try {

			if (empty($profile)) {
				throw new Exception("Invalid username or password", 1);
			} 

			$profile = $profile[0];

			if ($profile["blocked"] == '1') {
				throw new Exception("This account has been blocked. Contact support.", 1);
			}

		} catch (exception $e) {
			header("Location: " .URL."/login/?error=".$e->getMessage());exit;
		}

                
		cookie::set("name", $username);
		cookie::set("email", $profile["email"]);
		session::set("name", $username);
		session::set("ip", encrypt::ip());
                session::set("admin_user",$profile['admin_user']);
                 
                if($profile['admin_user']==1){
                    header("Location: " .URL."/mylala");exit;

                }
                
		header('Location: ' . URL . '/dashboard');exit;
	}

	function send($email){
		$profile = $this->db->select(["password"])->from("members")->where(["email"=>$_POST["email"]])->fetch();
		return $profile;
	}
}



?>
