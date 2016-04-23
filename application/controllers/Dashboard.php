<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		//Loading Models 
		$this->load->model('user_model', 'UserModel');
		$this->load->model('client_model', 'ClientModel');
		$this->load->model('rider_model', 'RiderModel');
		$this->load->model('outlet_model', 'OutletModel');
	}

	public function index(){
		if(($this->session->userdata('user_email')!= "")){
			$this->welcome();
		}
		else{
			$data['error_message'] = $this->session->flashdata('error_message');
			$data['title']= 'SmartSend::Signin';
			$this->load->view('header/header_signin', $data);
			$this->load->view('signin', $data);
			$this->load->view('footer/footer_signin', $data);
		}
	}
	
	//Siginin 
	public function signin(){
		$this->form_validation->set_error_delimiters('<div class="failed-message">', '</div>');
		$this->form_validation->set_rules('user-email', 'email', 'required|trim|valid_email');
		$this->form_validation->set_rules('user-password', 'password', 'required|trim|md5');
		
		if($this->form_validation->run() == FALSE){
			$data['title']= 'SmartSend::Signin';
			$this->load->view('header/header_signin', $data);
			$this->load->view('signin', $data);
			$this->load->view('footer/footer_signin', $data);
		}else{
			$loginResult = $this->UserModel->login($this->input->post());
			if($loginResult){
				$data['title']= 'SmartSend::Dashboard';
				/* $this->load->view('header/header', $data);
				$this->load->view('common/nav', $data);
				$this->load->view('index', $data);
				$this->load->view('footer/footer', $data); */
				$this->welcome();
			}else{
				$data['title']= 'SmartSend::Signin';
				$data['error_message']= 'Failed to login. Try again with valid information';
				$this->load->view('header/header_signin', $data);
				$this->load->view('signin', $data);
				$this->load->view('footer/footer_signin', $data);
			}
			
		}
	}
	
	//welcome 
	public function welcome(){
		$data['title']= 'SmartSend::Dashboard';
		$data['number_of_client']= $this->ClientModel->client_record_count();
		$data['number_of_rider']= $this->RiderModel->rider_record_count();
		$data['number_of_outlet']= $this->OutletModel->outlet_record_count();
		
		$this->load->view('header/header', $data);
		$this->load->view('common/nav', $data);
		$this->load->view('index', $data);
		$this->load->view('footer/footer', $data);
	}
	
	public function logout(){
		$userData = array('user_id' ,'user_name','user_email' ,'first_name','last_name','logged_in');
	  $this->session->unset_userdata($userData );
	  $this->session->sess_destroy();
	  $this->index();
	 }
}
