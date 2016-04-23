<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Singpost_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	//Get Address by postal code
	public function get_address_by_postal_code($postalCode){
		$address = 0;
		$result = $this->db->get_where('ss_singpost', array('zip_code' => $postalCode), 1); 
		
		if($result){
			foreach($result->result() as $row){
				$address = $row;
			}
		}else{
			return false;
		}
		
		if($address){
			return $address;
		}else{
			return false;
		}
	}
	
}//ENd of Model 