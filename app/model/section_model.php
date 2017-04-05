<?php 





class section_model extends model {

        private function get_amount($section){
                
            
              require("./config/default.php");
              
              return intval($CONF[$section]);
            
            
        }
        
	
	public function set_section($id, $amount) {
	
            
            
            //save into payer_queue with amount for section
            $this->db->saveInto("pay_queue", [
                ":id"=>0,
                ":idu"=>$id,
                ":amount"=>$amount,
                ":complete"=>0,
                ":section"=>$amount, 
                ":pledged" =>0,
            ], "INSERT")->execute();
            
 
	}


	public function set_section_two($id) {
		global $CONF;
                
                 //save into payer_queue with amount for section
            $this->db->saveInto("pay_queue", [
                ":id"=>0,
                ":idu"=>$id,
                ":amount"=>$this->get_amount("section_two"),
                ":complete"=>0,
                ":section"=>"id_two", 
                ":pledged" =>0,
            ], "INSERT")->execute();

	}



	public function set_section_three($id) {
		 //save into payer_queue with amount for section
            $this->db->saveInto("pay_queue", [
                ":id"=>0,
                ":idu"=>$id,
                ":amount"=>$this->get_amount("section_three"),
                ":complete"=>0,
                ":section"=>"id_three", 
                ":pledged" =>0,
            ], "INSERT")->execute();
	}




	public function set_section_four($id) {
		 //save into payer_queue with amount for section
            $this->db->saveInto("pay_queue", [
                ":id"=>0,
                ":idu"=>$id,
                ":amount"=>$this->get_amount("section_four"),
                ":complete"=>0,
                ":section"=>"id_four", 
                ":pledged" =>0,
            ], "INSERT")->execute();
	}




	public function set_section_five($id) {
		global $CONF;

		 //save into payer_queue with amount for section
            $this->db->saveInto("pay_queue", [
                ":id"=>0,
                ":idu"=>$id,
                ":amount"=>$this->get_amount("section_five"),
                ":complete"=>0,
                ":section"=>"id_five", 
                ":pledged" =>0,
            ], "INSERT")->execute();
	}




	private function peer_users($peer_data, $loop = FALSE) {
		global $CONF;

		extract($peer_data);



			/*$data = array(
				"num_in_peer"=>$num_to_queue,
				"section_idu"=>$peer_idu,
				"section_id"=>$peer_id_one,
				"max_peer"=>2, // int
				"amount"=>$CONF["section_one"],
				"stop_at"=>null,
				"queue"=>$queue,
				); */


		if ($loop === TRUE) {

			for ($i=0; $i < $num_in_peer; $i++) { 

				$now_date = $CONF["datetime"];
				$date     = date_create($now_date);
				date_add($date,date_interval_create_from_date_string($CONF["time_limit"]));
				$expire_date = date_format($date,"Y-m-d H:i:s");
				

				// check how many people has already been peer to the user
				$check_peer = $this->db->select(["idu"])->from("queue")->where(["payto"=>$section_idu])->cond("AND",["section"=>$section_type])->fetch();
				$num_user_peer = count($check_peer); // check the number of user that has been peer
				
				if ($num_user_peer == $stop_at) {
					break;
				} else {

					$this->db->saveInto("queue", [
						"payto"=>$section_idu, 
						"section_id"=>$section_id,
						"amount"=>$amount,
						"date_peered"=>$now_date,
						"date_expire"=>$expire_date,
						], "UPDATE")->where(["idu"=>$queue[$i]["idu"]])->cond("AND",["section"=>$section_type])->execute();

				} 

				
			}


		} else {

			$now_date = $CONF["datetime"];
			$date     = date_create($now_date);
			date_add($date,date_interval_create_from_date_string($CONF["time_limit"]));
			$expire_date = date_format($date,"Y-m-d H:i:s");

			// check how many people has already been peer to the user
			$check_peer = $this->db->select(["idu"])->from("queue")->where(["payto"=>$peer_idu])->cond("AND",["section"=>$section_type])->fetch();
			//$num_user_peer = count($check_peer); // check the number of user that has been peer

			if (empty($num_user_peer)) {
			

				$this->db->saveInto("queue", [
					"payto"=>$section_idu, 
					"section_id"=>$section_id,
					"amount"=>$amount,
					"date_peered"=>$now_date,
					"date_expire"=>$expire_date,
					], "UPDATE")->where(["idu"=>$queue[0]["idu"]])->cond("AND",["section"=>$section_type])->execute();
			} 
		}

		//exit;

	}



	public function set_queue($type, $id) {

		$queue_check = $this->db->select(["idu"])->from("queue")->where(["idu"=>$id])->cond("AND", ["section"=>$type])->fetch();
            
		if (empty($queue_check)) {
			try {
				$date =  "2017-03-10 07:00:12";
				$this->db->saveInto("queue", [
					":id"=>0,
					":idu"=>$id,
					":payto"=>0,
					":section"=>$type,
					":section_id"=>0,
					":amount"=>0,
					":date_peered"=>$date,
					":date_expire"=>$date,
					":paid"=>0,
					], "INSERT")->execute();
                                

			} catch (PDOException $e) { 
				die($e->getMessage());
			}
			return true;
		}
		return false;
	}



	private function get_section($type) {
		$queue = $this->db->select(["id_$type, idu, pay_one, pay_two, complete"])->from("section_$type")->where(["complete"=>'0'])->limit("1")->fetch();

		if (!empty($queue)) {
			return $queue[0];
		}

		return false;
	}
}


?>