<?php 
defined("BASEURL") OR die("Direct access denied");

class user_data_model extends model {

	public function user_profile($data) {
		$fetch = $this->db->select()->from("members")->where(["username"=>$data])->cond("OR", ["idu"=>$data])->cond("OR", ["email"=>$data])->fetch();
		if (!empty($fetch)) {
			return $fetch[0];
		}
		return FALSE;
		
	}
}

?>