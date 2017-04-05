<?php 
defined("BASEURL") OR die("Direct access denied");


class queue_model extends model
{
	

	public function section_one_upgrade($data) 
	{
            
             
		global $CONF;
			
		extract($data);


		$section_one = $this->db->select(["pay_one, pay_two"])->from("section_one")->where(["id_one"=>$section_id])->fetch();
                  
		if (empty($section_one)) {
			header("Location: " . URL . "/dashboard");exit;
		}


		$section_one_queue = $section_one[0];

		extract($section_one_queue);

		try {
			
			$this->db->t_begin();

			// insert if any of the slot is empty
			if ($pay_one == false) {

				$this->db->saveInto("section_one", ["pay_one"=>$idu], "UPDATE")->where(["idu"=>$payto])->execute();
                                        
			} elseif ($pay_two == false) {

				$this->db->saveInto("section_one", ["pay_two"=>$idu], "UPDATE")->where(["idu"=>$payto])->execute();

			} else {
				header("Location: " . URL . "/dashboard");exit;
			}

			// check if level one payment is complete
			$complete = $this->db->select(["pay_one, pay_two"])->from("section_one")->where(["id_one"=>$section_id])->fetch()[0];

			
			if ($complete["pay_one"] == true && $complete["pay_two"] == true) {

				$this->db->saveInto("section_one", ["complete"=>'2'], "UPDATE")->where(["id_one"=>$section_id])->execute();

		
				$admin_acc = false;

				switch ($payto) {
					
				 	case '1':
						
					case '2':
						
					case '3':
						
					case '4':
						
					case '20':
				
					case '11':
					
					case '13':
						
					
				 		$admin_acc = true;
				 		break;
				 	
				 	default:
				 		$admin_acc = false;
				 		break;
				 } 

				if ($admin_acc === false) {

					$this->db->delete("section_one")->where(["idu"=>$payto])->execute();

				} 

			}

                        

			// delete user from queue 
			$this->db->delete("queue")->where(["idu"=>$idu])->cond("AND",["section"=>$section])->execute();
                        
                                        

			$sent = $this->db->select(["amount"])->from("sent_help")->where(["idu"=>$idu])->fetch()[0]["amount"];

			$received = $this->db->select(["amount"])->from("received_help")->where(["idu"=>$payto])->fetch()[0]["amount"];

			
			$this->db->saveInto("sent_help", ["amount"=>((int)$sent+(int)$CONF["section_one"])], "UPDATE")->where(["idu"=>$idu])->execute();
                                        
			$this->db->saveInto("received_help", ["amount"=>((int)$received+(int)$CONF["section_one"])], "UPDATE")->where(["idu"=>$payto])->execute();
			
			//$sent = $this->db->select(["amount"])->from("sent_help")->where(["idu"=>$idu])->fetch()[0]["amount"];

			//$received = $this->db->select(["amount"])->from("received_help")->where(["idu"=>$payto])->fetch()[0]["amount"];
			
			//echo $sent ."<br>".$received;

			// set user for next pay
			$this->db->saveInto("section_one", 
				[
				":id"=>0,
				":idu"=>$idu,
				":pay_one"=>0,
				":pay_two"=>0,
				//":pay_three"=>0,
				":complete"=>0,
				], "INSERT")->execute();
		
			$this->db->t_commit();

		} catch (PDOException $e) {
			$this->db->t_rollback();

			die("Error! " . $e->getMessage());
		}	
	}


	public function section_two_upgrade($data)
	{
		
		global $CONF;
			
		extract($data);


		$section_two = $this->db->select(["pay_one, pay_two"])->from("section_two")->where(["id_two"=>$section_id])->fetch();

		if (empty($section_two)) {
			header("Location: " . URL . "/dashboard");exit;
		}


		$section_two_queue = $section_two[0];

		extract($section_two_queue);

		try {
			
			$this->db->t_begin();

			// insert if any of the slot is empty
			if ($pay_one == false) {

				$this->db->saveInto("section_two", ["pay_one"=>$idu], "UPDATE")->where(["id_two"=>$section_id])->execute();

			} elseif ($pay_two == false) {

				$this->db->saveInto("section_two", ["pay_two"=>$idu], "UPDATE")->where(["id_two"=>$section_id])->execute();

			} else {
				header("Location: " . URL . "/dashboard");exit;
			}

			// check if level one payment is complete
			$complete = $this->db->select(["pay_one, pay_two"])->from("section_two")->where(["id_two"=>$section_id])->fetch()[0];

			
			if ($complete["pay_one"] == true && $complete["pay_two"] == true) {

				$this->db->saveInto("section_two", ["complete"=>'2'], "UPDATE")->where(["id_two"=>$section_id])->execute();

		
				$admin_acc = false;

				switch ($payto) {
				 	case '1':
						
					case '2':
						
					case '3':
						
					case '4':
						
					case '20':
				
					case '11':
					
					case '13':
				 		$admin_acc = true;
				 		break;
				 	
				 	default:
				 		$admin_acc = false;
				 		break;
				 } 

				if ($admin_acc === false) {

					$this->db->delete("section_two")->where(["idu"=>$payto])->execute();

				} 

			}

			$sent = $this->db->select(["amount"])->from("sent_help")->where(["idu"=>$idu])->fetch()[0]["amount"];

			$received = $this->db->select(["amount"])->from("received_help")->where(["idu"=>$payto])->fetch()[0]["amount"];

			$this->db->saveInto("sent_help", ["amount"=>((int)$sent+(int)$CONF["section_two"])], "UPDATE")->where(["idu"=>$idu])->execute();
			$this->db->saveInto("received_help", ["amount"=>((int)$received+(int)$CONF["section_two"])], "UPDATE")->where(["idu"=>$payto])->execute();

			// delete user from queue 
			$this->db->delete("queue")->where(["idu"=>$idu])->cond("AND",["section"=>$section])->execute();

			// set user for next pay
			$this->db->saveInto("section_two", 
				[
				":id"=>0,
				":idu"=>$idu,
				":pay_one"=>0,
				":pay_two"=>0,
				//":pay_three"=>0,
				":complete"=>0,
				], "INSERT")->execute();
		
			$this->db->t_commit();

		} catch (PDOException $e) {
			$this->db->t_rollback();

			die("Error! " . $e->getMessage());
		}	
	
	}





	public function section_three_upgrade($data)
	{
		
		global $CONF;
		
		extract($data);


		$section_three = $this->db->select(["pay_one, pay_two"])->from("section_three")->where(["id_three"=>$section_id])->fetch();

		if (empty($section_three)) {
			header("Location: " . URL . "/dashboard");exit;
		}


		$section_three_queue = $section_three[0];

		extract($section_three_queue);

		try {
			
			$this->db->t_begin();

			// insert if any of the slot is empty
			if ($pay_one == false) {

				$this->db->saveInto("section_three", ["pay_one"=>$idu], "UPDATE")->where(["id_three"=>$section_id])->execute();

			} elseif ($pay_two == false) {

				$this->db->saveInto("section_three", ["pay_two"=>$idu], "UPDATE")->where(["id_three"=>$section_id])->execute();

			} else {
				header("Location: " . URL . "/dashboard");exit;
			}

			// check if level one payment is complete
			$complete = $this->db->select(["pay_one, pay_two"])->from("section_three")->where(["id_three"=>$section_id])->fetch()[0];

			
			if ($complete["pay_one"] == true && $complete["pay_two"] == true) {

				$this->db->saveInto("section_three", ["complete"=>'2'], "UPDATE")->where(["id_three"=>$section_id])->execute();

		
				$admin_acc = false;

				switch ($payto) {
				 	
					case '1':
						
					case '2':
						
					case '3':
						
					case '4':
						
					case '20':
				
					case '11':
					
					case '13':
				 		$admin_acc = true;
				 		break;
				 	
				 	default:
				 		$admin_acc = false;
				 		break;
				 } 

				if ($admin_acc === false) {

					$this->db->delete("section_three")->where(["idu"=>$payto])->execute();

				} 

			}

			$sent = $this->db->select(["amount"])->from("sent_help")->where(["idu"=>$idu])->fetch()[0]["amount"];

			$received = $this->db->select(["amount"])->from("received_help")->where(["idu"=>$payto])->fetch()[0]["amount"];

			$this->db->saveInto("sent_help", ["amount"=>((int)$sent+(int)$CONF["section_three"])], "UPDATE")->where(["idu"=>$idu])->execute();
			$this->db->saveInto("received_help", ["amount"=>((int)$received+(int)$CONF["section_three"])], "UPDATE")->where(["idu"=>$payto])->execute();

			// delete user from queue 
			$this->db->delete("queue")->where(["idu"=>$idu])->cond("AND",["section"=>$section])->execute();

			// set user for next pay
			$this->db->saveInto("section_three", 
				[
				":id"=>0,
				":idu"=>$idu,
				":pay_one"=>0,
				":pay_two"=>0,
				
				":complete"=>0,
				], "INSERT")->execute();
		
			$this->db->t_commit();

		} catch (PDOException $e) {
			$this->db->t_rollback();

			die("Error! " . $e->getMessage());
		}	
	}




	public function section_four_upgrade($data)
	{
		
		global $CONF;
		
		extract($data);


		$section_four = $this->db->select(["pay_one, pay_two"])->from("section_four")->where(["id_four"=>$section_id])->fetch();

		if (empty($section_four)) {
			header("Location: " . URL . "/dashboard");exit;
		}


		$section_four_queue = $section_four[0];

		extract($section_four_queue);

		try {
			
			$this->db->t_begin();

			// insert if any of the slot is empty
			if ($pay_one == false) {

				$this->db->saveInto("section_four", ["pay_one"=>$idu], "UPDATE")->where(["id_four"=>$section_id])->execute();

			} elseif ($pay_two == false) {

				$this->db->saveInto("section_four", ["pay_two"=>$idu], "UPDATE")->where(["id_four"=>$section_id])->execute();

			} else {
				header("Location: " . URL . "/dashboard");exit;
			}

			// check if level one payment is complete
			$complete = $this->db->select(["pay_one, pay_two"])->from("section_four")->where(["id_four"=>$section_id])->fetch()[0];

			
			if ($complete["pay_one"] == true && $complete["pay_two"] == true) {

				$this->db->saveInto("section_four", ["complete"=>'2'], "UPDATE")->where(["id_four"=>$section_id])->execute();

		
				$admin_acc = false;

				switch ($payto) {
				 	case '1':
						
					case '2':
						
					case '3':
						
					case '4':
						
					case '20':
				
					case '11':
					
					case '13':
				 		$admin_acc = true;
				 		break;
				 	
				 	default:
				 		$admin_acc = false;
				 		break;
				 } 

				if ($admin_acc === false) {

					$this->db->delete("section_four")->where(["idu"=>$payto])->execute();

				} 

			}

			$sent = $this->db->select(["amount"])->from("sent_help")->where(["idu"=>$idu])->fetch()[0]["amount"];

			$received = $this->db->select(["amount"])->from("received_help")->where(["idu"=>$payto])->fetch()[0]["amount"];

			$this->db->saveInto("sent_help", ["amount"=>((int)$sent+(int)$CONF["section_four"])], "UPDATE")->where(["idu"=>$idu])->execute();
			$this->db->saveInto("received_help", ["amount"=>((int)$received+(int)$CONF["section_four"])], "UPDATE")->where(["idu"=>$payto])->execute();

			// delete user from queue 
			$this->db->delete("queue")->where(["idu"=>$idu])->cond("AND",["section"=>$section])->execute();

			// set user for next pay
			$this->db->saveInto("section_four", 
				[
				":id"=>0,
				":idu"=>$idu,
				":pay_one"=>0,
				":pay_two"=>0,
				
				":complete"=>0,
				], "INSERT")->execute();
		
			$this->db->t_commit();

		} catch (PDOException $e) {
			$this->db->t_rollback();

			die("Error! " . $e->getMessage());
		}	
	}



	public function section_five_upgrade($data)
	{
		
		
		
		global $CONF;
			
		extract($data);
	


		$section_five = $this->db->select(["pay_one, pay_two"])->from("section_five")->where(["id_five"=>$section_id])->fetch();
		//print_r($section_five);exit;
		if (empty($section_five)) {
			header("Location: " . URL . "/dashboard");exit;
		}


		$section_five_queue = $section_five[0];

		extract($section_five_queue);
                                        
		try {
			
			$this->db->t_begin();

			// insert if any of the slot is empty
			if ($pay_one == false) {

				$this->db->saveInto("section_five", ["pay_one"=>$idu], "UPDATE")->where(["id_five"=>$section_id])->execute();

			} elseif ($pay_two == false) {

				$this->db->saveInto("section_five", ["pay_two"=>$idu], "UPDATE")->where(["id_five"=>$section_id])->execute();

			} else {
				header("Location: " . URL . "/dashboard");exit;
			}
                                        
			// check if level one payment is complete
			$complete = $this->db->select(["pay_one, pay_two"])->from("section_five")->where(["id_five"=>$section_id])->fetch()[0];
                                        
			
			if ($complete["pay_one"] == true && $complete["pay_two"] == true) {

				$this->db->saveInto("section_five", ["complete"=>'2'], "UPDATE")->where(["id_five"=>$section_id])->execute();

                                
                                
		
				$admin_acc = false;

				switch ($payto) {
				 	case '1':
						
					case '2':
						
					case '3':
						
					case '4':
						
					case '20':
				
					case '11':
					
					case '13':
				 		$admin_acc = true;
				 		break;
				 	
				 	default:
				 		$admin_acc = false;
				 		break;
				 } 

				if ($admin_acc === false) {

					$this->db->delete("section_five")->where(["idu"=>$payto])->execute();

				} 

			}

			$sent = $this->db->select(["amount"])->from("sent_help")->where(["idu"=>$idu])->fetch()[0]["amount"];

			$received = $this->db->select(["amount"])->from("received_help")->where(["idu"=>$payto])->fetch()[0]["amount"];

			$this->db->saveInto("sent_help", ["amount"=>((int)$sent+(int)$CONF["section_five"])], "UPDATE")->where(["idu"=>$idu])->execute();
			$this->db->saveInto("received_help", ["amount"=>((int)$received+(int)$CONF["section_five"])], "UPDATE")->where(["idu"=>$payto])->execute();

			// delete user from queue 
			$this->db->delete("queue")->where(["idu"=>$idu])->cond("AND",["section"=>$section])->execute();

                                      
			// set user for next pay
			$this->db->saveInto("section_five", 
				[
				":id"=>0,
				":idu"=>$idu,
				":pay_one"=>0,
				":pay_two"=>0,
				
				":complete"=>0,
				], "INSERT")->execute();
                        
			$this->db->t_commit();

		} catch (PDOException $e) {
			$this->db->t_rollback();

			die("Error! " . $e->getMessage());
		}	
	}



	

}

?>