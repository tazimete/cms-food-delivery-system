<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	//Count total record of order table 
	public function order_record_count() {
		return $this->db->count_all("ss_outlet");
	}
	
	//store order data 
	public function store_order_data($data){
		$inseringData = array(
		   'rider_id' => (int) trim($data['rider_id']) ,
		   'client_id' => (int) trim($data['outlet_id']) ,
		   'outlet_type' => trim($data['outlet_type']) ,
		   'pickup_datetime' => trim($data['pickup_datetime']) ,
		   'deliver_datetime' => trim($data['deliver_datetime']) ,
		   'mobile_number' => trim($data['mobile_number']) ,
		   'customer_name' => trim($data['customer_name']) ,
		   'postal_code' => trim($data['postal_code']) ,
		   'address' => trim($data['address']) ,
		   'food_cost' => trim($data['food_cost']) ,
		   'receipt_number' => trim($data['receipt_number']),
		   'created_date' => date('M-d-Y h:i:s A')
		);

		$result = $this->db->insert('ss_order', $inseringData); 
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//get order list 
	public function get_orders($limit, $start) {
		//$this->db->limit($limit);
		//$this->db->where('id', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get("ss_order", $limit, $start-1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}
	
	//Get order by id
	public function get_order_by_id($id){
		$order = 0;
		$result = $this->db->get_where('ss_order', array('id' => $id), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$order = $row;
			}
		}else{
			return false;
		}
		
		if($order){
			return $order;
		}else{
			return false;
		}
	}
	
	//Get multiple order by id
	public function get_multiple_order_by_id($ids){
		$order = array();
		foreach($ids as $id){
			$result = $this->db->get_where('ss_order', array('id' => $id)); 
		
			if($result){
				foreach($result->result() as $row){
					$order[] = $row;
				}
			}else{
				return false;
			}
		}
		
		if(count($order) > 0){
			return $order;
		}else{
			return false;
		}
	}
	
	//Search order by keyword 
	public function search_order_by_keyword($keyword){
		//$this->db->select('*');
		//$this->db->from('ss_client');
		$this->db->like('id', (int) $keyword);
		$this->db->or_like('customer_name', $keyword);
		$this->db->or_like('address', $keyword);
		$this->db->or_like('mobile_number', $keyword);
		$this->db->or_like('postal_code', $keyword);
		$this->db->or_like('receipt_number', $keyword);
		$query = $this->db->get('ss_order');
		if($query){
			return $query;
		}else{
			return false;
		}
	}
	
	//Search order by keyword with pagination
	public function search_order_by_keyword_with_pagination($keyword, $limit, $start){
		$this->db->like('id', (int) $keyword);
		$this->db->or_like('customer_name', $keyword);
		$this->db->or_like('address', $keyword);
		$this->db->or_like('mobile_number', $keyword);
		$this->db->or_like('postal_code', $keyword);
		$this->db->or_like('receipt_number', $keyword);
		$query = $this->db->get('ss_order', $limit, $start-1 );
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
} //End of class 