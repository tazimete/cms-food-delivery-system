<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet extends CI_Controller {
	
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
		
	}

	public function index(){
		$data['title']= 'SmartSend :: Outlet';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_outlet_page($data);
	}
	
	//Outlet page 
	public function welcome_to_outlet_page($data){
		$config = array();
		$config["base_url"] = base_url() . "outlet/index";
		$total_row = $this->OutletModel->outlet_record_count();
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
		}
		else{
			$page = 1;
		}
		
		if(($this->session->userdata('user_email')!= "")){
			$OutletList = $this->OutletModel->get_outlets($config["per_page"], $page);
			$data['outlet_list'] = $OutletList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('outlet_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//load add outlet page 
	public function add_outlet_page(){
		$data['form_name']= 'Add Outlet';
		$data['title']= 'SmartSend :: Add Outlet';
		$this->welcome_to_add_outlet_page($data);
	}
	
	//Go to add outlet page 
	public function welcome_to_add_outlet_page($data){
		$clientList = $this->ClientModel->get_all_client();
		$data['client_list'] = $clientList;
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('outlet_add', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Add Outlet  
	public function add_outlet(){
		//$this->load->model('Client_Model', 'ClientModel');
		$this->form_validation->set_error_delimiters('<div class="failed-message">', '</div>');
		$this->form_validation->set_rules('outlet-contact-number', 'Contact Number', 'required|trim|is_unique[ss_outlet.contact_number]');
		$this->form_validation->set_rules('outlet-cp-email', 'Contact Person Email', 'required|trim|is_unique[ss_outlet.contact_person_email]');
		
		if($this->form_validation->run() == false){
			$data['form_name']= 'Add Outlet';
			$data['title']= 'SmartSend::Add Outlet';
			$this->welcome_to_add_outlet_page($data);
		}else{
			$data = $this->input->post();
			if($data){
				$result = $this->OutletModel->insert_outlet_data($data);
		
				if($result){
					$data['success_message'] = 'Outlet is added successfully';
				}else{
					$data['failed_message'] = 'Failed to add outlet';
				}
			}
			$data['title']= 'SmartSend::Add Outlet';
			$this->welcome_to_outlet_page($data);
		}
	}
	
	//Edit Outlet Page 
	public function edit_outlet_page($id){
		$result = $this->OutletModel->get_outlet_by_id($id);
		$clientList = $this->ClientModel->get_all_client();
		//print_r($result); exit;
		if($result){
			$data['form_name']= 'Edit Outlet';
			$data['title']= 'SmartSend :: Edit Outlet';
			$data['outlet_data']= $result;
			$data['client_list']= $clientList;
			$this->welcome_to_edit_outlet_page($data);
		}else{
			$data['title']= 'SmartSend :: Manage Outlet';
			$this->welcome_to_outlet_page($data);
		}
	}
	
	//Go to edit outlet  page 
	public function welcome_to_edit_outlet_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('outlet_edit', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Edit Outlet by id 
	public function edit_outlet_by_id($id){
		$updatingData = $this->input->post();
		if($updatingData){
			$result = $this->OutletModel->edit_outlet_by_id($id, $updatingData);
		
			if($result){
				$data['success_message'] = 'Outlet is edited successfully';
			}else{
				$data['failed_message'] = 'Failed to edit outlet';
			}
		}
		$data['title']= 'SmartSend::Manage Outlet';
		$this->session->set_userdata('user_data', $data);
		redirect('outlet/index');
	}
	
	//Delete Outlet  by id 
	public function delete_outlet_by_id($id){
		$result = $this->OutletModel->delete_outlet_by_id($id);
		
		if($result){
			$data['success_message'] = 'Outlet is deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete outlet';
		}
		
		$data['title']= 'SmartSend :: Manage Outlet';
		$this->session->set_userdata('user_data', $data);
		redirect('outlet/index');
	}
	
	//View details outlet page 
	public function view_details_outlet_page($id){
		$outletDetails[] = $this->OutletModel->get_outlet_by_id($id);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Outlet Details';
			$data['outlet_list'] = $outletDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('outlet_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Search outlet 
	public function search_outlet(){
		$keyword = trim($this->input->post('keyword-search-outlet'));
		
		if(!empty($keyword)){
			$this->session->unset_userdata('search_keyword_outlet');
			$this->session->set_userdata('search_keyword_outlet', $keyword);
		}elseif($this->session->userdata('search_keyword_outlet')){
			$keyword = $this->session->userdata('search_keyword_outlet');
		}else{
			return false;
		}
		
		$result = $this->OutletModel->search_outlet_by_keyword($keyword);
		
		if($result->num_rows() > 0){
			$this->search_outlet_page($keyword, $result->num_rows());
		}else{
			$data['title']= 'SmartSend :: Manage Outlet';
			$this->welcome_to_outlet_page($data);
		}
	}
	
	//Search outlet page 
	public function search_outlet_page($keyword, $numRow){
		$config = array();
		$config["base_url"] = base_url() . "outlet/search_outlet";
		$total_row = $numRow;
		$config["total_rows"] = $total_row;
		$config["per_page"] = 3;
		//$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $config["total_rows"] / $config["per_page"];
		$config['cur_tag_open'] = '&nbsp;<a class="current" id="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
			
		if($this->uri->segment(3)){
			$page = $this->uri->segment(3);
		}else{
			$page = 1;
		}
			
		if(($this->session->userdata('user_email')!= "")){
			$outletList = $this->OutletModel->search_outlet_by_keyword_with_pagination($keyword, $config["per_page"], $page);
			$data['outlet_list'] = $outletList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
				
			$data['title'] = 'SmartSend::Search Outlet';
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('outlet_list', $data);
			$this->load->view('footer/footer', $data);
			}else{
				$this->session->set_flashdata('error_message', 'Please Login');
				redirect('dashboard/index');
			}
	}
	
	//Delete multiple outlet
	public function delete_outlets(){
		$outlets = $this->input->post('outlets');
		$result = $this->OutletModel->delete_outlets($outlets);
		
		if($result){
			$data['success_message'] = 'Outlets are  deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete outlets';
		}
		
		$data['title']= 'SmartSend::Manage Outlet';
		$this->welcome_to_outlet_page($data);
	}
	
	//View details multiple outlet page 
	public function view_details_multiple_outlet_page(){
		$outlets = $this->input->post('outlets');
		$outletDetails = $this->OutletModel->get_multiple_outlet_by_id($outlets);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Outlet Details';
			$data['outlet_list'] = $outletDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('outlet_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}

	
} //End of controller 