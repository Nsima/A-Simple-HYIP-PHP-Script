<?php 


class dashboard_model extends model {
	private function index() {}

	public function get_pending_approval($id) {

		$get = $this->db->select(["id, payer_id, receiver_id, amount"])->from("match_queue")->where(["receiver_id"=>$id])->fetch();

		if (empty($get)) {
			return false;
		}
		return $get;
	}
        
        
        public function can_user_reserve($id){
        
        	$re1 = $this->db->select()->from("payment_list")->where(["idu"=>$id])->fetch();
        	
        	if(count($rel) > 0) { return false;}
        	
        	$rel2 = $this->db->select()->from("match_queue")->where(["receiver_id"=>$id])->fetch();
        	
        	if(count($rel2) > 0) { return false;}
        	
        	$rel3 = $this->db->select()->from("receive_queue")->where(["idu"=>$id])->cond("AND", ["listed"=>0])->fetch();
        	
        	if(count($rel3) > 0) {return false;}
        	
        	return true;
        
        
        }
	
	public function get_list_status(){
	
	return $this->db->select()->from("list_status")->fetch()[0]['status'];
	
	}
	
	public function get_announcement(){
	
	return $this->db->select()->from("announcements")->fetch()[0]['news'];
	
	}
	
        
        public function match($receiver, $sender, $amount_payable, $amount_owed){
            
            global $CONF;
                    
           
            $this->db->t_begin(); 
            $this->db->delete("payment_list")->where(["idu"=>$receiver])->execute();
            $this->db->saveInto("pay_queue",
                    [   ":id"=>0,
                        ":idu"=>$sender,
                      ":amount"=>$amount_payable,
                      ":complete"=>0,
                       ":section"=>$amount_payable,
                        ":pledged"=>$amount_payable], "INSERT")->execute();
               
            $expire_date = (3600) * $CONF['time_limit'];
            
            
            $expire_date+=time();
             
            
            //if they are both equal, handle the payment and everybody goes to match_queue
            if($amount_owed == $amount_payable){
                
            
                $this->db->saveInto("match_queue", 
                        [":id"=>0,
                          ":payer_id"=>$sender,
                          ":receiver_id"=>$receiver,
                          ":amount"=> $amount_owed,
                          ":confirmed"=>0,
                           ":expiry_date"=>$expire_date,
                           ":complete"=>0 
                        ], "INSERT")->execute();
                    
                    
                $this->db->saveInto("receive_queue", 
                        [  
                          "amount"=> 0, 
                          "listed"=>0,
                        ], "UPDATE")->where(["idu"=>$receiver])->execute();
                    
            }
            else if($amount_owed > $amount_payable){
                    
                //match the user, and enlist him to receive the remaining money
                $remainder = $amount_owed - $amount_payable;
                
                $this->db->saveInto("match_queue", 
                        [":id"=>0,
                          ":payer_id"=>$sender,
                          ":receiver_id"=>$receiver,
                          ":amount"=> $amount_payable,
                          ":confirmed"=>0,
                           ":expiry_date"=>$expire_date,
                           ":complete"=>0 
                        ], "INSERT")->execute();
                
                
                $this->db->saveInto("receive_queue", 
                        [  
                          "amount"=> $remainder, 
                          "listed"=>0,
                        ], "UPDATE")->where(["idu"=>$receiver])->execute();
                
                // $this->increase_pledge($sender, $amount_payable);
                
            }
        
            
            $this->db->t_commit(); 
        }
        
        
        public function check(){
        
        
        	$this->db->saveInto("testing", array("id"=>0, "nothing"=>"adding it up"), "INSERT")->execute();
        	
        }
        
        public function trigger_roll_call(){
 
		$action_time = $this->db->select(["action_time, action_repeat"])->from('action_queue')->fetch()[0];

		
		$due_time = intval($action_time['action_time']);
		$repeat = intval($action_time['action_repeat']);

		if(time()>= $due_time){
                    
			$this->set_action_time($due_time+$repeat, $repeat);
                    
                        $this->prepare_new_list(); 
                       
		}
                  
                       
                    
	}
        
        
        public function tidy_up_affairs(){
             
             global $CONF;
            
            $last  = $this->db->select()->from("tidy_up")->fetch()[0];
            
            
            $last_tidy = intval($last['last_time']);
             
            $current_time = time();
            
            //die("current: " .$current_time . " last: " .$last_tidy. " diff" . ($current_time- $last_tidy)); 
            
            if((time() - $last_tidy) > (60 *$CONF['clean_up_minutes'])){
                    
              $this->do_clean_up();
              $this->update_clean_up_time(); 
            }
            
      }
        
      
      public function update_clean_up_time(){
          
          $time = time()."";
          $this->db->saveInto("tidy_up",
                  [
                      "last_time"=>$time
                  ], "UPDATE")->execute();
      }
        
        
       public function do_clean_up(){
          
          
          $matches = $this->db->select()->from("match_queue")->fetch();
          
          if(count($matches) > 0){
              
              foreach($matches as $m){
                  
                  $expiry_time = intval($m['expiry_date']);
                  
                  if(time() > $expiry_time){
                    
                      $this->purge($m['id']);
                  }
              }
          }
       }
       
       
       public function get_pending_payment($id){
           
           $res = $this->db->select()->from("receive_queue")->where(["idu"=>$id])->cond("AND", ["listed"=>0])->fetch();
           
           if(count($res) < 1) return  0;
                    
           return $res[0]['amount'];
       }
        
        
       public function confirm($id){
                    
          
           $match = $this->db->select()->from("match_queue")->where(["id"=>$id])->fetch();
           
           $receiver_id = $match[0]['receiver_id'];
           
           
           $amount_owed_still = $this->get_pending_payment($receiver_id);
           
           if($amount_owed_still <1){
           
           	$this->db->delete("receive_queue")->where(["idu"=>$receiver_id]);
           }
                  
           $this->db->t_begin(); 
               
               //$this->reduce_pledge($match[0]['payer_id'], $match[0]['amount']);
               
               $remaining_payer_debt = 0;
                
               
               if($remaining_payer_debt == 0){
               
                   $amount_to_award = $this->get_amount_due_to_payer($match[0]['payer_id']);
                         
               $this->db->saveInto("receive_queue",
                       [
                         ":id"=>0,
                         ":idu"=>$match[0]['payer_id'],
                         ":amount"=>$amount_to_award,
                         ":complete"=>0,
                         ":section"=>"",
                         ":listed"=>0
                           
                       ], "INSERT")->execute();
               
                    $sender_id = $match[0]['payer_id'];
                   
                   $this->db->delete("pay_queue")->where(["idu"=>$match[0]['payer_id']])->execute();
           
                
               }
         
                    
           
           $this->db->saveInto("paid", [
               
               ":id"=>0,
               ":idu"=>$match[0]['payer_id'],
               ":amount"=>$match[0]['amount'],
               ":time_paid"=>time()
           ], "INSERT")->execute();
           
           
            $this->db->saveInto("received", [
               
               ":id"=>0,
               ":idu"=>$match[0]['receiver_id'],
               ":amount"=>$match[0]['amount'],
               ":time_paid"=>time()
           ], "INSERT")->execute();
            
            
           $this->db->delete("match_queue")->where(["id"=>$id])->execute();
           
           $this->db->t_commit();
           
           
           
           
                   
        }
        
        function reduce_pledge($sender_id, $amount){
                    
            $current_pledge = $this->get_current_pledge($sender_id);
                    
            $new_pledge = $current_pledge - $amount;
            
            $this->db->saveInto("pay_queue", [
                    "pledged"=>$new_pledge
            ], "UPDATE")->where(['idu'=>$sender_id])->execute();
            
        }
        
        
        function get_current_pledge($sender_id){
            
            $result = $this->db->select()->from("pay_queue")->where(["idu"=>$sender_id])->fetch();
            
            if(count($result)  < 1 ) return 0;
            
            return $result[0]['pledged'];
        }
        
        function reduce_pay($sender_id, $amount){
           
            $current_debt = $this->get_current_debt($sender_id);
                    
            $new_debt = $current_debt - $amount;
            
            $this->db->saveInto("pay_queue", [
                    "amount"=>$new_debt
            ], "UPDATE")->where(['idu'=>$sender_id])->execute();
        }
        
        
        
        function get_current_debt($sender_id){
            
            $result = $this->db->select()->from("pay_queue")->where(["idu"=>$sender_id])->fetch();
            
            if(count($result)  < 1 ) return 0;
            
            return $result[0]['amount'];
        }
        
        
        function get_amount_due_to_payer($payer_id){
            
            $pay_row = $this->db->select(["section"])->from("pay_queue")->where(["idu"=>$payer_id])->fetch();
             
              
            $section = $pay_row[0]['section'] + ($pay_row[0]['section']/2);
            
            return $section;
            
           /*     switch($section){
                    
                    case "id_one":  
                    return $CONF['section_one'] + ($CONF['section_one']/2);
                        
                    case "id_two": 
                    return $CONF['section_two'] + ($CONF['section_two']/2);
                        
                    case "id_three": 
                    return $CONF['section_three'] + ($CONF['section_three']/2);
                        
                    case "id_four": 
                    return $CONF['section_four'] + ($CONF['section_four']/2);
                        
                    case "id_five": 
                    return $CONF['section_five'] + ($CONF['section_five']/2);
                }
                
                return 0; */
        }
        
        
        
	
	public function get_no_people_per_list(){ 
		$result = $this->db->select()->from("no_of_people_list")->fetch()[0];
		
		return $result['no'];
	}
	
        
        
        function prepare_new_list(){ 
                require("./config/default.php");
                
            $existing = $this->db->select(["idu, section, amount"])->from("payment_list")->where(["complete"=>0])->fetch();
            
            $index = count($existing);
            
              
             $max = $this->get_no_people_per_list();
             
           
           
            if($index < $max){
            $new_batch = $this->db->select(["id, idu,  section, amount"])->from("receive_queue")->where(["complete"=>0])->cond("AND", ["listed"=>0])->fetch();
           
           $listed = array();
           
            //merge
            $new_index = 0;
            for($i= 0; $i < count($new_batch); $i++){
                
                 if(count($existing) >= $max){
                    
                    break;
                }
                
               	
               	if($new_batch[$i]['amount'] > 0){
                $existing[count($existing)]  = $new_batch[$i]; 
                $listed[count($listed)] = $new_batch[$i];
                }
               
            }
            
            }
            
            
               
           
            
               $this->db->delete('payment_list')->execute(); 
            $this->db->t_begin();
            
            
            //delete all in public list  
            
           
            
             //list in public view list;
            foreach($existing as $new){
                 
            $this->db->saveInto("payment_list",
                    [
                       ":id"=>0,
                       ":idu"=>$new['idu'], 
                        ":section"=>$new['section'],
                        ":amount"=>$new['amount'], 
                        ":complete"=>0
                      
                        
                    ], "INSERT")->execute();
                    
                    
            }
             
            
            //mark as listed in receive_queue;
            foreach($listed as $new){ 
            $this->db->saveInto("receive_queue",
                    [
                       
                       "listed"=>1
                      
                        
                    ], "UPDATE")->where(["id"=>$new['id']])->execute();
                    
                    
            }
            
            $this->db->delete("list_date")->execute();
            
            $time = time()."";
           
            
            $this->db->saveInto("list_date",
                     
            [":id"=>0, ":release_time"=>$time], "INSERT")->execute();
            
            
            
            $this->db->t_commit();
            
        }
        
        
        
        public function getLastPublicationTime(){ 
            $time = $this->db->select(["release_time"])->from("list_date")->fetch()[0]['release_time'];
            
           
            $dateTime = new DateTime();
            $dateTime->setTimestamp($time);
            $ago = $this->getMoments($dateTime); 
            
            return $ago;
        }
        
        
        public function getMoments($datetime){
     
    $now = new DateTime;
    $ago = $datetime;
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

   // if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';



    }
    
    public function how_much_is_receiver_owed($receiver_id){
  
       
        //get how much he should receive in the first place
        $amount = $this->db->select(["amount"])->from("payment_list")->where(["idu"=>$receiver_id])->cond("AND", ["complete"=>0])->fetch();
         
        
        $amount_due = intval($amount[0]['amount']);
         
        
        
        //get how much he has been matched to receive
        $matched_to_receive = $this->db->select(["amount"])->from("match_queue")->where(["receiver_id"=>$receiver_id])->cond("AND", ["complete"=>0])->fetch();
        
        $amount_matched = 0;
        
        foreach($matched_to_receive as $amt){
            
            $amount_matched+=$amt['amount'];
        }
          
        
        $amount_owed = $amount_due - $amount_matched; 
        
        return $amount_owed;
    }
    
    
     public function how_much_should_payer_pledge($sender_id){
  
      
        //get how much he should receive in the first place
        $amount = $this->db->select(["amount,  pledged"])->from("pay_queue")->where(["idu"=>$sender_id])->cond("AND", ["complete"=>0])->fetch();
         
        
        $amount_owed = intval($amount[0]['amount']);
         
         
        
        
        //get how much he has pledged to pay
        $matched_to_send = $amount[0]['pledged'];
                    
        $amount_pledgeable = $amount_owed - $matched_to_send; 
        
        return $amount_pledgeable;
    }
    
    
    
    public function how_much_should_payer_pay($sender_id){
        
         //get how much he should receive in the first place
        $amount = $this->db->select(["amount"])->from("pay_queue")->where(["idu"=>$sender_id])->cond("AND", ["complete"=>0])->fetch();
         
         if(count($amount) < 1) return 0;
        
        $amount_owed = intval($amount[0]['amount']);
         
         
                    
        return $amount_owed;
        
    }
       
    
    public function increase_pledge($sender_id, $pledged){
       
       $current_pledge = $this->get_how_much_pledged($sender_id);
                    
        $total_pledge = $current_pledge+$pledged;
        $this->db->saveInto("pay_queue",
                ["pledged"=>$total_pledge], "UPDATE")->where(["idu"=>$sender_id])->execute();
        
    }
    
    
    public function decrease_pledge($sender_id, $deduction){
        
         $current_pledge = $this->get_how_much_pledged($sender_id);
        
        $total_pledge = $current_pledge-$deduction;
        $this->db->saveInto("pay_queue",
                ["pledged"=>$total_pledge], "UPDATE")->where(["idu"=>$sender_id])->execute();
 
    }
    
    
    public function get_how_much_pledged($sender_id){
        
        $result = $this->db->select(["pledged"])->from("pay_queue")->where(["idu"=>$sender_id])->fetch();
        if(count($result) <1)return 0;
        
        return $result[0]['pledged'];
    }
    
    
        public function get_payment_list(){
            
             $result = $this->db->select(["id, idu, section, amount, complete"])->from("payment_list")->fetch();
           
            $list = array();
            
            $counter = 0;
             
            foreach($result as $r){ 
                
                $list[$counter++] = $this->decorateList($r); 
            }
             
            
            return $list;
            
            
        }
        
        
        
        private  function decorateList($r){
            
            $list_user =  $this->db->select(["username, phonenumber, bank_name"])->from("members")->where(["idu"=>$r['idu']])->fetch();
            
            if(!empty($list_user)){
            $r['user'] = $list_user[0];
            }
            
            return $r;
        }

        public function set_action_time($time, $repeat_time){

		$this->db->t_begin();

		$this->db->delete('action_queue')->execute();

		 
 
 
 		$this->db->saveInto('action_queue', [':id'=>0, ':action_time'=>$time, ':action_repeat'=>$repeat_time], 'INSERT')->execute();

 		$this->db->t_commit();



	}
	
	
	public function get_action_time(){
	
		return intval($this->db->select()->from("action_queue")->fetch()[0]['action_time']);
	}

        
        public function get_queue($id){
            
            $data = $this->db->select(["idu, payto, section_id, section"])->from("queue")->where(["idq"=>$id])->fetch();
            
            if(count($data) > 0) return $data[0];
            
            return null;
        }

	public function get_user_to_pay($id) {


		$get = $this->db->select(["payer_id, receiver_id, expiry_date, amount, confirmed"])->from("match_queue")->where(["payer_id"=>$id])->fetch();

		if (count($get) < 1) {
			return false; 
		}
		return $get; 

	}



	public function section_one($id) {
                
            return false;
            $one = $this->db->select(["amount"])->from("pay_queue")->where(["idu"=>$id])->cond("AND", ["section"=>"id_one"])->fetch();
            
            
		//$one = $this->db->select(['amount'])->from("pay_queue")->fetch();

		if (empty($one)) { 
			return false;
		} 

		return true;
	}

	public function section_two($id) {
                return false;
		 $one = $this->db->select(["amount"])->from("pay_queue")->where(["idu"=>$id])->cond("AND", ["section"=>"id_two"])->fetch();
            

		if (empty($one)) {
			return false;
		} 

		return true;
	}

	public function section_three($id) {
return false;
		 $one = $this->db->select(["amount"])->from("pay_queue")->where(["idu"=>$id])->cond("AND", ["section"=>"id_three"])->fetch();
            

		if (empty($one)) {
			return false;
		} 

		return true;
	}

	public function section_four($id) {

            return false;
		 $one = $this->db->select(["amount"])->from("pay_queue")->where(["idu"=>$id])->cond("AND", ["section"=>"id_four"])->fetch();
            

		if (empty($one)) {
			return false;
		} 

		return true;
	}

	public function section_five($id) {
            return false;
		 $one = $this->db->select(["amount"])->from("pay_queue")->where(["idu"=>$id])->cond("AND", ["section"=>"id_five"])->fetch();
            

		if (empty($one)) {
			return false;
		} 

		return true;
	}


	public function get_sent($id) {
		$amt =  $this->db->select(["amount"])->from("paid")->where(["idu"=>$id])->fetch();
                $total = 0;
                foreach($amt as $am){
                    
                    $total+=$am['amount'];
                }
                    
                
                return $total;
                
	}
        
                    
        
        
        public function purge($id){
            
            $match = $this->db->select()->from("match_queue")->where(["id"=>$id])->fetch()[0];
            
            //for user
            //if his occurence on payment_list is unlisted
            
            
           
            $amt = $this->how_much_user_queued_to_receive($match['receiver_id']);
            
           
            $amt+=$match['amount'];

             
            $this->db->t_begin();

            $receiver_id = $match['receiver_id'];
 
            

            $this->db->saveInto("receive_queue", [
                "amount"=>$amt,
                "listed"=>0
        ], "UPDATE")->where(["idu"=>$receiver_id])->cond("AND", ["listed"=>0])->execute();

            //for payer
             //remove entire row from match
            $this->db->delete("match_queue")->where(["id"=>$id])->execute();
            
            
            //deduct amount from pledged
           $this->db->delete("pay_queue")->where(["idu"=>$match['payer_id']])->execute();
      
            $this->db->t_commit();
                    
            
        }
        
        
        
        function how_much_user_queued_to_receive($receiver_id){
            
            $ans = $this->db->select(["amount"])->from("receive_queue")->where(["idu"=>$receiver_id])->cond("AND", ["listed"=>0])->fetch();
            
            if(count($ans) < 1) return 0;
            
            return $ans[0]['amount'];
            
           
        }
        
                    
        
	public function get_recieved($id) {
		$amt =  $this->db->select(["amount"])->from("received")->where(["idu"=>$id])->fetch();
                $total = 0;
                 
                foreach($amt as $am){
                    
                    $total+=$am['amount'];
                }
                    
                
                return $total;
	}


	public function remove($id, $idu, $type) {

		$peer = $this->db->select(["complete"])->from("section_$type")->where(["idu"=>$id])->fetch()[0]["complete"];

		if ($peer == '1') {
	
			//echo $data[$i]["payto"] . "is now open for re-pair<br>";
			
			$this->db->saveInto("section_$type", ["complete"=>'0'], "UPDATE")->where(["idu"=>$id])->execute();
		}

		$this->db->delete("queue")->where(["idu"=>$idu])->execute();
		//$this->db->saveInto("members", ["block"=>'1'], "UPDATE")->where(["idu"=>$idu])->execute();
	}




}





?>