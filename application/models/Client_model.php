<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	//Get  Client by email and password 
	public function get_client_by_email_and_password($email, $password){
		$client = 0;
		$this->db->where(array('email' => $email, 'password' => $password)); 
		$this->db->limit(1);
		$result = $this->db->get("ss_client");
		
		if($result){
			foreach($result->result() as $row){
				$client = $row;
			}
		}else{
			return false;
		}
		
		if($client){
			return $client;
		}else{
			return false;
		}
	}
	
	
	//Count total record of client 
	public function client_record_count() {
		return $this->db->count_all("ss_client");
	}
	
	
	//Get  Client  by email and password 
	/* public function get_client_by_email_and_password($email, $password){
		$rider = 0;
		$result = $this->db->get_where('ss_client', array('email' => $email, 'password' => $password), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$client = $row;
			}
		}else{
			return false;
		}
		
		if($client){
			return $client;
		}else{
			return false;
		}
	} */
	
	
	
	//Count total record of client company 
	public function client_company_record_count(){
		$this->db->where('client_type', 'company');
		$query = $this->db->get("ss_client");
		return $query->num_rows();
	}
	
	//Count total record of client restaurant  
	public function client_restaurant_record_count(){
		$this->db->where('client_type', 'restaurant');
		$query = $this->db->get("ss_client");
		return $query->num_rows();
	}
	
	//insert client data
	public function insert_client_data($data){
		$inseringData = array(
		   'company_name' => trim($data['client-company-name']) ,
		   'email' => strtolower(trim($data['client-company-email'])) ,
		   'password' => trim($data['client-company-password']) ,
		   'location' => trim($data['client-company-location']) ,
		   'contact_number' => trim($data['client-contact-number']),
		   'company_postal_code' => trim($data['client-postal-code']),
		   'company_unit_number' => trim($data['client-unite-number']),
		   'billing_address' => trim($data['client-billing-address']),
		   'contact_person_name' => trim($data['client-cp-name']),
		   'contact_person_number' => trim($data['client-cp-number']),
		   'contact_person_email' => strtolower(trim($data['client-cp-email'])),
		   'contact_person_postal_code' => trim($data['client-cp-postal-code']),
		   'contact_person_unit_number' => trim($data['client-cp-unite-number']),
		   'contact_person_address' => trim($data['client-cp-address']),
		   'client_type' => trim($data['client-type']),
		   'created_date' => date('M-d-Y h:i:s A'),
		);

		$result = $this->db->insert('ss_client', $inseringData); 
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//Get all client
	public function get_all_client(){
		$allClient = array();
		$this->db->order_by("id", "desc"); 
		$result = $this->db->get('ss_client'); 
		
		if($result){
			foreach($result->result() as $row){
				$allClient[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($allClient) > 0){
			return $allClient;
		}else{
			return false;
		}
	}
	
	//get client list 
	public function get_clients($limit, $start) {
		//$this->db->limit($limit);
		//$this->db->where('id', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get("ss_client", $limit, $start-1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	
	//get client company list 
	public function get_clients_company($limit, $start) {
		//$this->db->limit($limit);
		$this->db->where('client_type', 'company');
		$this->db->order_by("id", "desc");
		$query = $this->db->get("ss_client", $limit, $start-1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	
	//get client restaurant list 
	public function get_clients_restaurant($limit, $start){
		//$this->db->limit($limit);
		$this->db->where('client_type', 'restaurant');
		$this->db->order_by("id", "desc");
		$query = $this->db->get("ss_client", $limit, $start-1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	
	//Get client by id
	public function get_client_by_id($id){
		$client = 0;
		$result = $this->db->get_where('ss_client', array('id' => $id), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$client = $row;
			}
		}else{
			return false;
		}
		
		if($client){
			return $client;
		}else{
			return false;
		}
	}
	
	//Get multiple client by id
	public function get_multiple_client_by_id($ids){
		$client = array();
		foreach($ids as $id){
			$result = $this->db->get_where('ss_client', array('id' => $id)); 
		
			if($result){
				foreach($result->result() as $row){
					$client[] = $row;
				}
			}else{
				return false;
			}
		}
		
		if(count($client) > 0){
			return $client;
		}else{
			return false;
		}
	}
	
	//Get client restaurant by id
	public function get_multiple_client_restaurant_by_id($ids){
		$client = array();
		foreach($ids as $id){
			$result = $this->db->get_where('ss_client', array('id' => $id, 'client_type' => 'restaurant')); 
		
			if($result){
				foreach($result->result() as $row){
					$client[] = $row;
				}
			}else{
				return false;
			}
		}
		
		if(count($client) > 0){
			return $client;
		}else{
			return false;
		}
	}
	
	//Get client company  by id
	public function get_multiple_client_company_by_id($ids){
		$client = array();
		foreach($ids as $id){
			$result = $this->db->get_where('ss_client', array('id' => $id, 'client_type' => 'company')); 
		
			if($result){
				foreach($result->result() as $row){
					$client[] = $row;
				}
			}else{
				return false;
			}
		}
		
		if(count($client) > 0){
			return $client;
		}else{
			return false;
		}
	}
	
	//Delete client by id 
	public function delete_client_by_id($id){
		$result = $this->db->delete('ss_client', array('id' => $id));
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Delete multiple  client 
	public function delete_clients($clients){
		foreach($clients as $id){
			$result = $this->db->delete('ss_client', array('id' => $id));
		}
		
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Edit client by id 
	public function edit_client_by_id($id, $updatingData){
		$data = array(
		   'company_name' => trim($updatingData['client-company-name']) ,
		   'email' => strtolower(trim($updatingData['client-company-email'])) ,
		   'password' => trim($updatingData['client-company-password']) ,
		   'location' => trim($updatingData['client-company-location']) ,
		   'contact_number' => trim($updatingData['client-contact-number']),
		   'company_postal_code' => trim($updatingData['client-postal-code']),
		   'company_unit_number' => trim($updatingData['client-unite-number']),
		   'billing_address' => trim($updatingData['client-billing-address-name']),
		   'contact_person_name' => trim($updatingData['client-cp-name']),
		   'contact_person_number' => trim($updatingData['client-cp-number']),
		   'contact_person_email' => strtolower(trim($updatingData['client-cp-email'])),
		   'contact_person_address' => trim($updatingData['client-cp-address']),
		   'client_type' => trim($updatingData['client-type']),
		   'created_date' => date('y-m-d'),
		);
		$result = $this->db->update('ss_client', $data,  array('id' => $id));
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Get all restaurant 
	public function get_all_restaurant(){
		$allClient = array();
		$this->db->order_by("id", "desc"); 
		$result = $this->db->get_where('ss_client', array('client_type' => 'restaurant')); 
		
		if($result){
			foreach($result->result() as $row){
				$allClient[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($allClient) > 0){
			return $allClient;
		}else{
			return false;
		}
	}
	
	//Get all restaurant 
	public function get_all_company(){
		$allClient = array();
		$this->db->order_by("id", "desc"); 
		$result = $this->db->get_where('ss_client', array('client_type' => 'company')); 
		
		if($result){
			foreach($result->result() as $row){
				$allClient[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($allClient) > 0){
			return $allClient;
		}else{
			return false;
		}
	}
	
	//Search client by keyword 
	public function search_client_by_keyword($keyword){
		//$this->db->select('*');
		//$this->db->from('ss_client');
		$this->db->like('company_name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$query = $this->db->get('ss_client');
		if($query){
			return $query;
		}else{
			return false;
		}
	}
	
	//Search client by keyword with pagination
	public function search_client_by_keyword_with_pagination($keyword, $limit, $start){
		$this->db->like('company_name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$query = $this->db->get('ss_client', $limit, $start-1 );
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	//Search client restaurant by keyword 
	public function search_client_restaurant_by_keyword($keyword){
		$this->db->like('company_name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$this->db->where('client_type', 'restaurant');
		$query = $this->db->get('ss_client');
		if($query){
			return $query;
		}else{
			return false;
		}
	}
	
	//Search client restaurant by keyword  with pagination
	public function search_client_restaurant_by_keyword_with_pagination($keyword, $limit, $start){
		$this->db->like('company_name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$this->db->where('client_type', 'restaurant');
		$query = $this->db->get('ss_client', $limit, $start-1 );
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	//Search client company by keyword 
	public function search_client_company_by_keyword($keyword){
		$this->db->like('company_name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$this->db->where('client_type', 'company');
		$query = $this->db->get('ss_client');
		if($query){
			return $query;
		}else{
			return false;
		}
	}
	
	//Search client company by keyword  with pagination
	public function search_client_company_by_keyword_with_pagination($keyword, $limit, $start){
		$this->db->like('company_name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$this->db->where('client_type', 'company');
		$query = $this->db->get('ss_client', $limit, $start-1 );
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	
	//Change client status by id 
	public function change_client_status_by_id($id, $status){
		$updatingData = array(
			'status'=> $status
		);
		$result = $this->db->update('ss_client', $updatingData, array('id' => $id)); 
		
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	
	//Get postal code by id 
	public function get_postal_code_by_id($id){
		$postalCode = 0;
		$result = $this->db->get_where('ss_client', array('id' => $id), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$postalCode = $row;
			}
		}else{
			return false;
		}
		
		if($postalCode){
			return $postalCode->company_postal_code;
		}else{
			return false;
		}
	}
	
	//Register Client Device by id 
	public function register_client_device($clientId, $deviceRegId){
		$updatingData = array(
			'device_reg_id'=> $deviceRegId
		);
		$result = $this->db->update('ss_client', $updatingData, array('id' => $clientId)); 
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	
	
} //End of Controller 