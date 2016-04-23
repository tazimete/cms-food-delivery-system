<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	//Add option 
	public function add_option($key, $val){
		$data = array(
		   'option_key' => trim($key) ,
		   'option_value' => trim($val) ,
		   'changed_date' => date('M-d-Y h:i:s A')
		);

		$result = $this->db->update('ss_option', $data, array('option_key' => $key));
		
		if(!$result){
			$result = $this->db->insert('ss_option', $data);
		}
		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//Get option by key 
	public function get_option_by_key($key){
		$option = 0;
		$result = $this->db->get_where('ss_option', array('option_key' => $key), 1);
		
		if($result){
			foreach($result->result() as $row){
				$option = $row;
			}
		}else{
			return false;
		}
		
		if($option){
			return $option->option_value;
		}else{
			return false;
		}
	}
	

} //End of rider model 