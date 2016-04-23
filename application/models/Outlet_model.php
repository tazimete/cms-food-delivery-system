<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	//Count total record of outlet 
	public function outlet_record_count() {
		return $this->db->count_all("ss_outlet");
	}
	
	//Get all outlet
	public function get_all_outlet(){
		$allOutlet = array();
		$this->db->order_by("id", "desc"); 
		$result = $this->db->get('ss_outlet'); 
		
		if($result){
			foreach($result->result() as $row){
				$allOutlet[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($allOutlet) > 0){
			return $allOutlet;
		}else{
			return false;
		}
	}
	
	//get outlet list 
	public function get_outlets($limit, $start) {
		//$this->db->limit($limit);
		//$this->db->where('id', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get("ss_outlet", $limit, $start-1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	
	//insert outlet data
	public function insert_outlet_data($data){
		$inseringData = array(
		   'client_id' => trim($data['client-id']) ,
		   'name' => trim($data['outlet-name']) ,
		   'location' => trim($data['outlet-location']) ,
		   'contact_number' => trim($data['outlet-contact-number']),
		   'postal_code' => trim($data['outlet-postal-code']),
		   'unit_number' => trim($data['outlet-unite-number']),
		   'billing_address' => trim($data['outlet-billing-address']),
		   'contact_person_name' => trim($data['outlet-cp-name']),
		   'contact_person_number' => trim($data['outlet-cp-number']),
		   'contact_person_email' => strtolower(trim($data['outlet-cp-email'])),
		   'contact_person_postal_code' => trim($data['outlet-cp-postal-code']),
		   'contact_person_unit_number' => trim($data['outlet-cp-unite-number']),
		   'contact_person_address' => trim($data['outlet-cp-address']),
		   'created_date' => date('M-d-Y h:i:s A'),
		);

		$result = $this->db->insert('ss_outlet', $inseringData); 
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//Get outlet by id
	public function get_outlet_by_id($id){
		$outlet = 0;
		$result = $this->db->get_where('ss_outlet', array('id' => $id), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$outlet = $row;
			}
		}else{
			return false;
		}
		
		if($outlet){
			return $outlet;
		}else{
			return false;
		}
	}
	
	//Get multiple outlet by id
	public function get_multiple_outlet_by_id($ids){
		$outlet = array();
		foreach($ids as $id){
			$result = $this->db->get_where('ss_outlet', array('id' => $id)); 
		
			if($result){
				foreach($result->result() as $row){
					$outlet[] = $row;
				}
			}else{
				return false;
			}
		}
		
		if(count($outlet) > 0){
			return $outlet;
		}else{
			return false;
		}
	}
	
	//Edit outlet by id 
	public function edit_outlet_by_id($id, $updatingData){
		$data = array(
		   'client_id' => trim($updatingData['client-id']) ,
		   'name' => trim($updatingData['outlet-name']) ,
		   'location' => trim($updatingData['outlet-location']) ,
		   'contact_number' => trim($updatingData['outlet-contact-number']),
		   'postal_code' => trim($updatingData['outlet-postal-code']),
		   'unit_number' => trim($updatingData['outlet-unite-number']),
		   'billing_address' => trim($updatingData['outlet-billing-address']),
		   'contact_person_name' => trim($updatingData['outlet-cp-name']),
		   'contact_person_number' => trim($updatingData['outlet-cp-number']),
		   'contact_person_email' => strtolower(trim($updatingData['outlet-cp-email'])),
		   'contact_person_postal_code' => trim($updatingData['outlet-cp-postal-code']),
		   'contact_person_unit_number' => trim($updatingData['outlet-cp-unite-number']),
		   'contact_person_address' => trim($updatingData['outlet-cp-address']),
		   'created_date' => date('M-d-Y h:i:s A'),
		);
		$result = $this->db->update('ss_outlet', $data,  array('id' => $id));
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Delete outlet by id 
	public function delete_outlet_by_id($id){
		$result = $this->db->delete('ss_outlet', array('id' => $id));
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//Search outlet by keyword 
	public function search_outlet_by_keyword($keyword){
		//$this->db->select('*');
		//$this->db->from('ss_client');
		$this->db->like('name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$this->db->or_like('postal_code', $keyword);
		$query = $this->db->get('ss_outlet');
		if($query){
			return $query;
		}else{
			return false;
		}
	}
	
	//Search outlet by keyword with pagination
	public function search_outlet_by_keyword_with_pagination($keyword, $limit, $start){
		$this->db->like('name', $keyword);
		$this->db->or_like('location', $keyword);
		$this->db->or_like('contact_number', $keyword);
		$this->db->or_like('postal_code', $keyword);
		$query = $this->db->get('ss_outlet', $limit, $start-1 );
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	//Delete multiple  outlet 
	public function delete_outlets($outlets){
		foreach($outlets as $id){
			$result = $this->db->delete('ss_outlet', array('id' => $id));
		}
		
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	
	//Get all outlet by client id
	public function get_all_outlet_by_client_id($id){
		$outlet = array();
		$this->db->where(array('client_id' => $id)); 
		$result = $this->db->get("ss_outlet");
		
		if($result){
			foreach($result->result() as $row){
				$outlet[] = $row;
			}
		}else{
			return false;
		}
		
		if(count($outlet) > 0){
			return $outlet;
		}else{
			return false;
		}
	}
	
	//Get postal code by id 
	public function get_postal_code_by_id($id){
		$postalCode = 0;
		$result = $this->db->get_where('ss_outlet', array('id' => $id), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$postalCode = $row;
			}
		}else{
			return false;
		}
		
		if($postalCode){
			return $postalCode->postal_code;
		}else{
			return false;
		}
	}

} //End of rider model 