<?php 

class admin_model extends model {


	
	
	function __construct(){
	
		parent::__construct();
		ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
	
	}
	
	
	public function add_announcement($announcement){
	 
		$this->db->saveInto("announcements", ["news"=>$announcement], "UPDATE")->execute();
	
	}
	
	public function get_announcement(){
	
	return $this->db->select()->from("announcements")->fetch()[0]['news'];
	
	}
	
	public function get_list_status(){
	
	return $this->db->select()->from("list_status")->fetch()[0]['status'];
	
	}
	
	
	public function set_list_status($st){
	
		$this->db->saveInto('list_status', ['status'=>$st], 'UPDATE')->execute();
	}
	
	
	public function get_no_people_per_list(){ 
		$result = $this->db->select()->from("no_of_people_list")->fetch()[0];
		
		return $result['no'];
	}
	
	
	public function update_no_people_list($no){
		
		$this->db->saveInto("no_of_people_list", ["no"=>$no], "UPDATE")->execute();
	
	}
	
	
        
        
	public function set_action_time($time, $repeat){

		$this->db->t_begin();

		$this->db->delete('action_queue')->execute();
                
                                                
		$arr =  explode(':', $time);


		$hour = $arr[0];
		$minutes = $arr[1];


		$time =  mktime($hour, $minutes);
 		
 		$repeat_time = intval($repeat)*(60*60);
 
 
 		$this->db->saveInto('action_queue', [':id'=>0, ':action_time'=>$time, ':action_repeat'=>$repeat_time], 'INSERT')->execute();

 		$this->db->t_commit();
                                                
	}
        public function get_action_time(){
            
            $result = $this->db->select(['action_time, action_repeat'])->from('action_queue')->fetch();
            
            $r_result = array();
            
            $r_result['action_time'] = date("H:i", $result[0]['action_time']);
            $r_result['action_repeat'] = intval($result[0]['action_repeat']/3600);
            return $r_result;
        }
        public function check_logged_in(){
            
            $true = session::get("admin_user"); 
            return $true==1;
        }
        
        
        public function getUsername($id){
        
        $result = $this->db->select(["username"])->from("members")->where(["idu"=>$id])->fetch();
        
        if(count($result) < 1) return null;
        
        return $result[0]['username'];
        
        }
        
        
        
        
        public function get_admins(){
            
            $this->db->t_begin();
            
            $data = $this->db->select(["username, idu"])->from("members")->where(["admin_user"=>1])->fetch();
            
            $result = array();
            $counter = 0;
            foreach($data as $d){
                
                $pendingIncome = $this->db->select(['amount, idq, idu, paid'])->from("queue")->where(['payto'=>$d['idu']])->fetch();
                
                if(count($pendingIncome) > 0 && $pendingIncome[0]['paid']==0){
                    
                    $d['pending_income'][0] = $pendingIncome[0]['amount'];
                    $d['pending_income_id'][0] = $pendingIncome[0]['idq']; 
                    $d['payee'][0] = $this->getUsername($pendingIncome[0]['idu']);
                    
                    if(count($pendingIncome) > 1 && $pendingIncome[1]['paid']==0){
                        
                        $d['pending_income'][1] = $pendingIncome[1]['amount'];
                        $d['pending_income_id'][1] = $pendingIncome[1]['idq'];
                        $d['payee'][1] = $pendingIncome[1]['idu'];
                    }
                }
                else{
                    
                    $d['pending_income'] = NULL;
                    $d['pending_income_id'] = NULL;
                    
                }
               
                
                $result[$counter++] = $d;
                
              
            }
            
            $this->db->t_commit();
            
            return $result; 
            
        }
        
        
         public function get_members(){
                                                
            
            $data = $this->db->select(["username, idu"])->from("members")->where(["admin_user"=>0])->fetch();
            
            $result = array();
            $counter = 0;
            
            $total_i = 0;
            $total_s = 0;
            foreach($data as $d){
                
                $total_receieved = $this->get_received($d['idu']);
                $total_sent = $this->get_sent($d['idu']);
                
                               
                $d['income'] = $total_receieved;
                $d['sent'] = $total_sent;
                
                $total_i+=$total_receieved;
                $total_s +=$total_sent;
               
                
                $result[$counter++] = $d; 
                
                
              
            }
            
            $result[0]['total_received'] = $total_i;
            $result[0]['total_paid'] = $total_s;
            
            return $result;    
        }
        
        
        
        public function get_sent($id) {
		$amt =  $this->db->select(["amount"])->from("paid")->where(["idu"=>$id])->fetch();
                $total = 0;
                foreach($amt as $am){
                    
                    $total+=$am['amount'];
                }
                    
                
                return $total;
                
	}
        
        
        public function get_received($id) {
		$amt =  $this->db->select(["amount"])->from("received")->where(["idu"=>$id])->fetch();
                $total = 0;
                foreach($amt as $am){
                    
                    $total+=$am['amount'];
                }
                    
                
                return $total;
	}
        
        
        
	public function remove_user() {



		$data = $this->db->select(["date_expire, idu, payto, section"])->from("queue")->fetch();

		if (!empty($data)) {
			global $CONF;


			for ($i=0; $i < count($data); $i++) { 
				
				if ($CONF["datetime"] >= $data[$i]["date_expire"]) {

					//echo $data[$i]["payto"] . "Was purged -----" . $data[$i]["section"] . "<br>";

					switch ($data[$i]["section"]) {

						case '1':
							$peer = $this->db->select(["complete"])->from("section_one")->where(["idu"=>$data[$i]["payto"]])->fetch();

							if(!empty($peer)) {
								$peer = $peer[0]["complete"];
								if ($peer == '1') {
									$this->db->saveInto("section_one", ["complete"=>'0'], "UPDATE")->where(["idu"=>$data[$i]["payto"]])->execute();
								}
							}
							$this->db->delete("queue")->where(["idu"=>$data[$i]["idu"]])->cond("AND",["section"=>'1'])->execute();
							break;


						case '2':
							$peer = $this->db->select(["complete"])->from("section_two")->where(["idu"=>$data[$i]["payto"]])->fetch();

							if(!empty($peer)) {
								$peer = $peer[0]["complete"];
								if ($peer == '1') {
									$this->db->saveInto("section_two", ["complete"=>'0'], "UPDATE")->where(["idu"=>$data[$i]["payto"]])->execute();
								}
							}
							$this->db->delete("queue")->where(["idu"=>$data[$i]["idu"]])->cond("AND",["section"=>'2'])->execute();
							break;


						case '3':
							$peer = $this->db->select(["complete"])->from("section_three")->where(["idu"=>$data[$i]["payto"]])->fetch();

							if(!empty($peer)) {
								$peer = $peer[0]["complete"];
								if ($peer == '1') {
									$this->db->saveInto("section_three", ["complete"=>'0'], "UPDATE")->where(["idu"=>$data[$i]["payto"]])->execute();
								}
							}
							$this->db->delete("queue")->where(["idu"=>$data[$i]["idu"]])->cond("AND",["section"=>'3'])->execute();
							break;



						case '4':
							$peer = $this->db->select(["complete"])->from("section_four")->where(["idu"=>$data[$i]["payto"]])->fetch();

							if(!empty($peer)) {
								$peer = $peer[0]["complete"];
								if ($peer == '1') {
									$this->db->saveInto("section_four", ["complete"=>'0'], "UPDATE")->where(["idu"=>$data[$i]["payto"]])->execute();
								}
							}
							$this->db->delete("queue")->where(["idu"=>$data[$i]["idu"]])->cond("AND",["section"=>'4'])->execute();
							break;



						case '5':
							$peer = $this->db->select(["complete"])->from("section_five")->where(["idu"=>$data[$i]["payto"]])->fetch();

							if(!empty($peer)) {
								$peer = $peer[0]["complete"];
								if ($peer == '1') {
									$this->db->saveInto("section_five", ["complete"=>'0'], "UPDATE")->where(["idu"=>$data[$i]["payto"]])->execute();
								}
							}
							$this->db->delete("queue")->where(["idu"=>$data[$i]["idu"]])->cond("AND",["section"=>'5'])->execute();
							break;		
					}

					echo "Purge completeed<br>";
				} else {


					echo "no purge<br>";
				}
			}
		} 
		
		

	}

	public function admin_remove($id){

			$this->db->t_begin();
			$this->db->delete("members")->where(["idu"=>$id])->execute();  
                                                
                                                
                        $this->db->delete('receive_queue')->where(["idu"=>$id])->execute();
                        $this->db->delete('payment_list')->where(["idu"=>$id])->execute();
                        $this->db->delete('pay_queue')->where(["idu"=>$id])->execute();
                        $this->db->delete('match_queue')->where(["payer_id"=>$id])->execute(); 
                        $this->db->delete('match_queue')->where(["receiver_id"=>$id])->execute();
			$this->db->t_commit();
	}

	public function get_num_users() {


		$users = $this->db->selectCount("idu")->from("members")->fetch();

		return $users[0]["COUNT(idu)"];


	}


	public function get_num_user_in_queue() {

		$users = $this->db->selectCount("idq")->from("queue")->fetch();

		return $users[0]["COUNT(idq)"];
	}




	public function get_admin_acc_flush_one($id) {

		


		$section = $this->db->select(["idu"])->from("section_one")->where(["complete"=>2])->cond("AND", ["idu"=>$id])->fetch();



		if (empty($section)) {
			return false;
		}

		return $section[0]["idu"];

	}

	public function get_admin_acc_flush_two($id) {

		


		$section = $this->db->select(["idu"])->from("section_two")->where(["complete"=>2])->cond("AND", ["idu"=>$id])->fetch();



		if (empty($section)) {
			return false;
		}

		return $section[0]["idu"];

	}



	public function get_admin_acc_flush_three($id) {

		


		$section = $this->db->select(["idu"])->from("section_three")->where(["complete"=>2])->cond("AND", ["idu"=>$id])->fetch();



		if (empty($section)) {
			return false;
		}

		return $section[0]["idu"];

	}




	public function get_admin_acc_flush_four($id) {

		


		$section = $this->db->select(["idu"])->from("section_four")->where(["complete"=>2])->cond("AND", ["idu"=>$id])->fetch();



		if (empty($section)) {
			return false;
		}

		return $section[0]["idu"];

	}



	public function get_admin_acc_flush_five($id) {

		


		$section = $this->db->select(["idu"])->from("section_five")->where(["complete"=>2])->cond("AND", ["idu"=>$id])->fetch();



		if (empty($section)) {
			return false;
		}

		return $section[0]["idu"];

	}

                                                

	public function flood($id, $type) {



		$adm = false;


		switch ($id) {
			case '1':
			case '2':
			case '3':
			case '4':
				$adm = true;
				break;
			
			default:
				$adm = false;
				break;
		}

		//echo $adm; exit;


		//echo $adm;

		if ($adm === true) {


			//$xxyzz = $this- 

			try {

				$this->db->t_begin();


				$this->db->saveInto("section_$type", [
					"pay_one"=>"0",
					"pay_two"=>"0",
					"complete"=>"0",
					],"UPDATE")->where(["idu"=>$id])->execute();


				$this->db->t_commit();


				

			} catch (PDOException $e) {

				$this->db->t_rollback();

				header("Location: " . URL .  "/mylala");exit;
			}




		}



	}


}


/*//echo $data[$i]["idu"] . " - " . $data[$i]["section"] . "<br>";
							$peer = $this->db->select(["complete"])->from("section_one")->where(["idu"=>$data[$i]["payto"]])->fetch()[0]["complete"];

							if ($peer == '1') {
								echo $data[$i]["idu"] . "Was purged -----" . $data[$i]["section"] . "<br>";
							    //echo $data[$i]["payto"] . "is now open for re-pair<br>";
							    
							   /* $this->db->saveInto("section_one", ["complete"=>'0'], "UPDATE")->where(["idu"=>$data[$i]["payto"]])->execute();

							    $this->db->delete("queue")->where(["idu"=>$data[$i]["idu"]])->cond("AND",["section"=>'1'])->execute();*/
								//$this->db->delete("members")->where(["idu"=>$data[$i]["idu"]])->execute();
							//}

?>