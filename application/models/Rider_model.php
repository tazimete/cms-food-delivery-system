<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rider_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	public function index(){
		
	}
	
	//Get  Rider by email and password 
	public function get_rider_by_email_and_password($email, $password){
		$rider = 0;
		$this->db->where(array('email' => $email, 'password' => $password)); 
		$this->db->limit(1);
		$result = $this->db->get("ss_rider");
		
		if($result){
			foreach($result->result() as $row){
				$rider = $row;
			}
		}else{
			return false;
		}
		
		if($rider){
			return $rider;
		}else{
			return false;
		}
	}
	
	//Count total record of rider 
	public function rider_record_count() {
		return $this->db->count_all("ss_rider");
	}
	
	//Get all rider
	public function get_all_rider(){
		$allRider = array();
		$this->db->order_by("id", "desc"); 
		$result = $this->db->get('ss_rider'); 
		
		if($result){
			foreach($result->result() as $row){
				$allRider[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($allRider) > 0){
			return $allRider;
		}else{
			return false;
		}
	}
	
	//Get all signedin  rider
	public function get_all_signed_in_rider(){
		$allRider = array();
		$this->db->order_by("id", "desc"); 
		$this->db->where(array('status' => 1)); 
		$result = $this->db->get('ss_rider'); 
		
		if($result){
			foreach($result->result() as $row){
				$allRider[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($allRider) > 0){
			return $allRider;
		}else{
			return false;
		}
	}
	
	//get rider list 
	public function get_riders($limit, $start) {
		//$this->db->limit($limit);
		//$this->db->where('id', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get("ss_rider", $limit, $start-1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	
	//insert rider data
	public function insert_rider_data($data){
		$inseringData = array(
		   'name' => trim($data['rider-name']) ,
		   'email' => trim($data['rider-email']) ,
		   'password' => trim($data['rider-password']) ,
		   'bike_number' => trim($data['rider-bike-number']) ,
		   'contact_number' => trim($data['rider-contact-number']),
		   'profile_picture' => trim($data['upload_data']['file_name']),
		   'created_date' => date('M-d-Y h:i:s A')
		);

		$result = $this->db->insert('ss_rider', $inseringData); 
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//Update rider data
	public function edit_rider_by_id($data, $id){
		$updatingData = array(
		   'name' => trim($data['rider-name']) ,
		   'email' => trim($data['rider-email']) ,
		   'password' => trim($data['rider-password']) ,
		   'bike_number' => trim($data['rider-bike-number']) ,
		   'contact_number' => trim($data['rider-contact-number']),
		   'created_date' => date('M-d-Y h:i:s A')
		);
		
		if($data['upload_data']['file_name']){
			$updatingData['profile_picture'] = trim($data['upload_data']['file_name']);
		}

		$result = $this->db->update('ss_rider', $updatingData, array('id' => $id)); 
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//Delete Rider by id 
	public function delete_rider_by_id($id){
		$result = $this->db->delete('ss_rider', array('id' => $id));
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Delete multiple rider 
	public function delete_riders($riders){
		foreach($riders as $id){
			$result = $this->db->delete('ss_rider', array('id' => $id));
		}
		
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Get Rider by id
	public function get_rider_by_id($id){
		$rider = 0;
		$result = $this->db->get_where('ss_rider', array('id' => $id), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$rider = $row;
			}
		}else{
			return false;
		}
		
		if($rider){
			return $rider;
		}else{
			return false;
		}
	}
	
	//Get multiple rider  by id
	public function get_multiple_rider_by_id($ids){
		$rider = array();
		foreach($ids as $id){
			$result = $this->db->get_where('ss_rider', array('id' => $id)); 
		
			if($result){
				foreach($result->result() as $row){
					$rider[] = $row;
				}
			}else{
				return false;
			}
		}
		
		if(count($rider) > 0){
			return $rider;
		}else{
			return false;
		}
	}
	
	//Search rider by keyword 
	public function search_rider_by_keyword($keyword){
		//$this->db->select('*');
		//$this->db->from('ss_rider');
		$this->db->like('name', $keyword);
		$this->db->or_like('bike_number', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$query = $this->db->get('ss_rider');
		if($query){
			return $query;
		}else{
			return false;
		}
	}
	
	//Search rider by keyword with pagination
	public function search_rider_by_keyword_with_pagination($keyword, $limit, $start){
		$this->db->like('name', $keyword);
		$this->db->or_like('bike_number', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$query = $this->db->get('ss_rider', $limit, $start-1 );
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	//Change rider status by id 
	public function change_rider_status_by_id($id, $status){
		$updatingData = array(
			'status'=> $status
		);
		$result = $this->db->update('ss_rider', $updatingData, array('id' => $id)); 
		
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	
	//Change rider location by id 
	public function change_rider_location_by_id($id, $lat, $lng){
		$updatingData = array(
			'latitude'=> $lat,
			'longitude'=> $lng
		);
		$result = $this->db->update('ss_rider', $updatingData, array('id' => $id)); 
		
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	
	//Register Rider Device by id 
	public function register_rider_device($riderId, $deviceRegId){
		$updatingData = array(
			'device_reg_id'=> $deviceRegId
		);
		$result = $this->db->update('ss_rider', $updatingData, array('id' => $riderId)); 
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Set rider status by id 
	public function set_rider_status_by_id($riderId, $status){
		$updatingData = array(
			'status'=> $status
		);
		
		$result = $this->db->update('ss_rider', $updatingData, array('id' => $riderId)); 
		if($result){
			return true;
		}else{
			return false;
		}
	}
	

} //End of rider model 