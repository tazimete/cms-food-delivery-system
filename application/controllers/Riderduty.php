<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riderduty extends CI_Controller {
	
	public function  __construct(){
		parent::__construct();
		
		//Loading Helper 
		$this->load->helper(array('form', 'url'));
		
		//Loading Library 
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		//Loading Model
		$this->load->model('client_model', 'ClientModel');
		$this->load->model('rider_model', 'RiderModel');
		$this->load->model('outlet_model', 'OutletModel');
		$this->load->model('riderduty_model', 'RiderDutyModel');
		
	}

	//Rider Duty Page 
	public function index(){
		$data['title']= 'SmartSend :: Duty of Rider';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_rider_duty_page($data);
	}
	
	//Rider Duty page 
	public function welcome_to_rider_duty_page($data){
		$config = array();
		$config["base_url"] = base_url() . "riderduty/index";
		$total_row = $this->RiderDutyModel->rider_duty_record_count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 3;
		//$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current" id="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		
		if(is_numeric($this->uri->segment(3))){
			$page = $this->uri->segment(3);
		}else{
			$page = 1;
		}
		
		if(($this->session->userdata('user_email')!= "")){
			$RiderDutyList = $this->RiderDutyModel->get_rider_duty_list($config["per_page"], $page);
			$data['rider_duty_list'] = $RiderDutyList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('riderduty_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//load add rider duty page 
	public function add_rider_duty_page(){
		$data['form_name']= 'Add Rider Duty';
		$data['title']= 'SmartSend :: Add Rider Duty';
		$this->welcome_to_add_rider_duty_page($data);
	}
	
	//Go to add rider  duty page 
	public function welcome_to_add_rider_duty_page($data){
		$ClientList = $this->ClientModel->get_all_client();
		$RiderList = $this->RiderModel->get_all_rider();
		$OutletList = $this->OutletModel->get_all_outlet();
		$data['client_list'] = $ClientList;
		$data['outlet_list'] = $OutletList;
		$data['rider_list'] = $RiderList;
		
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('riderduty_add', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Add Outlet rider duty   
	public function add_rider_duty(){		
		$data = $this->input->post();
		
		if($data){
			$result = $this->RiderDutyModel->insert_rider_duty_data($data);
		
			if($result){
				$data['success_message'] = 'Rider Duty is added successfully';
			}else{
				$data['failed_message'] = 'Failed to add rider duty';
			}
		}
		$data['title']= 'SmartSend::Manage Rider Duty';
		$this->welcome_to_rider_duty_page($data);
	}
	
	//Edit rider duty Page 
	public function edit_rider_duty_page($id){
		$ClientList = $this->ClientModel->get_all_client();
		$RiderList = $this->RiderModel->get_all_rider();
		$OutletList = $this->OutletModel->get_all_outlet();
		$RiderDuty = $this->RiderDutyModel->get_rider_duty_by_id($id);
		
		if($RiderDuty){
			$data['form_name']= 'Edit Rider Duty';
			$data['title']= 'SmartSend :: Edit Rider Duty';
			$data['client_list'] = $ClientList;
			$data['outlet_list'] = $OutletList;
			$data['rider_list'] = $RiderList;
			$data['rider_duty']= $RiderDuty;
			$this->welcome_to_edit_rider_duty_page($data);
		}else{
			$data['title']= 'SmartSend :: Manage Rider Duty';
			$this->welcome_to_rider_duty_page($data);
		}
	}
	
	//Edit rider duty by id 
	public function edit_rider_duty_by_id($id){
		$updatingData = $this->input->post();
		if($updatingData){
			$result = $this->RiderDutyModel->edit_rider_duty_by_id($id, $updatingData);
		
			if($result){
				$data['success_message'] = 'Rider duty is edited successfully';
			}else{
				$data['failed_message'] = 'Failed to edit rider duty';
			}
		}
		$data['title']= 'SmartSend::Manage Outlet';
		$this->session->set_userdata('user_data', $data);
		redirect('riderduty/index');
	}
	
	//Go to edit rider duty  page 
	public function welcome_to_edit_rider_duty_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('riderduty_edit', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}

	//Delete rider duty  by id 
	public function delete_rider_duty_by_id($id){
		$result = $this->RiderDutyModel->delete_rider_duty_by_id($id);
		
		if($result){
			$data['success_message'] = 'Rider duty is deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete rider duty';
		}
		
		$data['title']= 'SmartSend :: Manage Rider Duty';
		$this->session->set_userdata('user_data', $data);
		redirect('riderduty/index');
	}
	
	//View details rider duty page 
	public function view_details_rider_duty_page($id){
		$ClientList = $this->ClientModel->get_all_client();
		$RiderList = $this->RiderModel->get_all_rider();
		$OutletList = $this->OutletModel->get_all_outlet();
		$RiderDuty[] = $this->RiderDutyModel->get_rider_duty_by_id($id);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View RIder Duty Details';
			$data['client_list'] = $ClientList;
			$data['outlet_list'] = $OutletList;
			$data['rider_list'] = $RiderList;
			$data['rider_duty_list']= $RiderDuty;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('riderduty_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
} //End of controller 