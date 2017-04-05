<?php
defined("BASEURL") OR die("Direct access denied");
/**
* 
*/
class check_login_model extends model
{
	
	private $getIp;
	private $sessionGetUser;
	private $cookieGetuser;

	public function __construct() {
		parent::__construct();

		$this->getIp          = session::get("ip");
		$this->sessionGetUser = session::get("name");
		$this->cookieGetuser  = cookie::get("name");



		$this->data = [];
		// check when user is logged in or not.
		$this->checkLogginStatus();
	}
        
        
        public function check_admin($username){
            
            $result = $this->db->select(["username, name, email, idu, admin"])->from("members")->where(["username"=>$username])->fetch();
            
            if(count($result) < 1) return false;
            
            if(result[0]['admin'] == 0) return false;
            
            return $result[0];
        }
        

	public function fetch_name() {
		return $this->checkLogginStatus()["username"];
	}

	public function fetch_fullname() {
		return $this->checkLogginStatus()["name"];
	}
	
	public function fetch_id() {
		return $this->checkLogginStatus()["idu"];
	}

	public function fetch_email() {
		return $this->checkLogginStatus()["email"];
	}

	private function checkLogginStatus() {
		if (!$this->sessionGetUser && !$this->getIp) {
			if (!$this->cookieGetuser) {
				header("Location: " . URL . "/login");
			}
			else {
				return $this->getUserInfo($this->cookieGetuser);
			}
		} 
		else {
			return $this->getUserInfo($this->sessionGetUser); 
				
		}
	}

	private function getUserInfo($name) {
		$result = $this->db->select(["username, name, email, idu"])->from("members")->where(["username"=>$name])->fetch();
		//print_r($result);
		if (empty($result)) {
			header("Location: " . URL . "/login");
		}
		else {
			foreach ($result as $row) {
				return $row;
			} 
		}
	}
}


?>