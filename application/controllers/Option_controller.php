<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_controller extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		
		//Loading Helper 
		$this->load->helper(array('form', 'url'));
		
		//Loading Library 
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		//Loading Model
		$this->load->model('user_model', 'UserModel');
		$this->load->model('client_model', 'ClientModel');
		$this->load->model('rider_model', 'RiderModel');
		$this->load->model('option_model', 'OptionModel');
		
	}

	public function index(){
		$data['title']= 'SmartSend :: Setting';
		$data['form_name']= 'Settings';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_setting_page($data);
	}
	
	//Setting Page 
	public function welcome_to_setting_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('setting', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Add option 
	public function add_option(){
		$this->form_validation->set_error_delimiters('<div class="failed-message">', '</div>');
		$this->form_validation->set_rules('max-distance-order', 'maximum distance for order', 'required|trim|numeric');
		$this->form_validation->set_rules('max-distance-rider', 'maximum distance for order', 'required|trim|numeric');
	
		if($this->form_validation->run() == false){
			$data['form_name']= 'Setting';
			$data['title']= 'SmartSend :: Setting';
			$this->welcome_to_setting_page($data);
		}else{
			$values = $this->input->post();
			
			foreach($values as $key => $val){
				$result = $this->OptionModel->add_option($key, $val);
			}
			
			if($result){
				$data['success_message'] = 'Setting updated successfully';
			}else{
				$data['failed_message'] = 'Failed to update setting';
			}
			
			$data['title']= 'SmartSend :: Setting';
			$data['form_name']= 'Settings';
			$this->session->set_userdata('user_data', $data);
			redirect('option_controller/index');
		}
	}
	
	
} //End of controller 