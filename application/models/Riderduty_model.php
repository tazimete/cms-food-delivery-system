<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riderduty_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	//Count total record of outlet 
	public function rider_duty_record_count() {
		return $this->db->count_all("ss_rider_duty");
	}
	
	//Get all rider duty 
	public function get_all_rider_duty(){
		$allRiderDuty = array();
		$this->db->order_by("id", "desc"); 
		$result = $this->db->get('ss_rider_duty'); 
		
		if($result){
			foreach($result->result() as $row){
				$allRiderDuty[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($allRiderDuty) > 0){
			return $allRiderDuty;
		}else{
			return false;
		}
	}
	
	//get rider duty list 
	public function get_rider_duty_list($limit, $start) {
		//$this->db->limit($limit);
		//$this->db->where('id', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get("ss_rider_duty", $limit, $start-1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	
	//insert rider duty data
	public function insert_rider_duty_data($data){
		$inseringData = array(
		   'rider_id' => trim($data['rider-id']) ,
		   'outlet_type' => trim($data['ss-outlet-type']),
		   'created_date' => date('M-d-Y h:i:s A')
		);

		if($data['ss-outlet-type'] == 1){
			$inseringData['client_id'] = trim($data['outlet-id']);
		}else if($data['ss-outlet-type'] == 2){
			$inseringData['outlet_id'] = trim($data['outlet-id']);
		}
		
		$result = $this->db->insert('ss_rider_duty', $inseringData); 
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//Get rider duty by id
	public function get_rider_duty_by_id($id){
		$riderDuty = 0;
		$result = $this->db->get_where('ss_rider_duty', array('id' => $id), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$riderDuty = $row;
			}
		}else{
			return false;
		}
		
		if($riderDuty){
			return $riderDuty;
		}else{
			return false;
		}
	}
	
	//Edit rider duty by id 
	public function edit_rider_duty_by_id($id, $data){
		$updatingData = array(
		   'rider_id' => trim($data['rider-id']) ,
		   'outlet_type' => trim($data['ss-outlet-type']),
		   'created_date' => date('M-d-Y h:i:s A')
		);

		if($data['ss-outlet-type'] == 1){
			$updatingData['client_id'] = trim($data['outlet-id']);
		}else if($data['ss-outlet-type'] == 2){
			$updatingData['outlet_id'] = trim($data['outlet-id']);
		}
		
		$result = $this->db->update('ss_rider_duty', $updatingData,  array('id' => $id));
		
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Delete rider duty by id 
	public function delete_rider_duty_by_id($id){
		$result = $this->db->delete('ss_rider_duty', array('id' => $id));
		if($result){
			return true;
		}else{
			return false;
		}
	}

} //End of rider model 