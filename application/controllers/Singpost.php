<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Singpost extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		
		//Loading Model
		$this->load->model('user_model', 'UserModel');
		$this->load->model('client_model', 'ClientModel');
		$this->load->model('singpost_model', 'SingpostModel');
	}
	
	public function index(){
		
	}
	
	//Get address by postal code 
	public function get_address_by_postal_code(){
		$postalCode = $this->input->post('postalCode');
		$result = $this->SingpostModel->get_address_by_postal_code($postalCode);
		
		if($result){
			echo json_encode($result);
			exit;
		}else{
			echo json_encode(0);
			exit;
		}
	}

	
} //End of Controller
