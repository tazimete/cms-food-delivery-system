<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	
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
		
	}

	public function index(){
		$data['title']= 'SmartSend::Manage Client';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_client_page($data);
	}
	
	//load client company page 
	public function client_company_page(){
		$data['title']= 'SmartSend::Manage Client';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_client_company_page($data);
	}
	
	//load client restaurant page 
	public function client_restaurant_page(){
		$data['title']= 'SmartSend::Manage Client';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_client_restaurant_page($data);
	}
	
	//load client restaurant page 
	public function client_report_page(){
		$data['title']= 'SmartSend::Manage Client';
		$this->welcome_to_client_report_page($data);
	}
	
	//load add company page 
	public function add_client_company_page(){
		$data['form_name']= 'Add Company';
		$data['title']= 'SmartSend::Add Company';
		$data['client_type']= 'company';
		$this->welcome_to_add_client_page($data);
	}
	
	//load add restaurant page 
	public function add_client_restaurant_page(){
		$data['form_name']= 'Add Restaurant';
		$data['title']= 'SmartSend::Add Restaurant';
		$data['client_type']= 'restaurant';
		$this->welcome_to_add_client_page($data);
	}
	
	//Add Client 
	public function add_client(){
		$this->form_validation->set_error_delimiters('<div class="failed-message">', '</div>');
		$this->form_validation->set_rules('client-contact-number', 'Contact Number', 'required|trim|is_unique[ss_client.contact_number]');
		$this->form_validation->set_rules('client-company-email', 'Company email', 'required|trim|is_unique[ss_client.email]');
		$this->form_validation->set_rules('client-company-password', 'Company password', 'required|trim|is_unique[ss_client.password]');
		$this->form_validation->set_rules('client-cp-email', 'Contact Person Email', 'required|trim|is_unique[ss_client.contact_person_email]');
		$clientType = $this->input->post('client-type');
		$clientType = ucfirst($clientType);
		
		if($this->form_validation->run() == false){
			$data['form_name']= 'Add '.$clientType;
			$data['title']= 'SmartSend::Add '.$clientType;
			$data['client_type']= $clientType;
			$this->welcome_to_add_client_page($data);
		}else{
			$data = $this->input->post();
			if($data){
				$result = $this->ClientModel->insert_client_data($data);
		
				if($result){
					$data['success_message'] = 'Client is added successfully';
				}else{
					$data['failed_message'] = 'Failed to add client';
				}
			}
			$data['title']= 'SmartSend::Add Client';
			$this->welcome_to_client_page($data);
		}
	}
	
	//Edit Client Page 
	public function edit_client_page($id){
		$result = $this->ClientModel->get_client_by_id($id);
		//print_r($result); exit;
		if($result){
			if($result->client_type == 'restaurant'){
				$data['form_name']= 'Edit Restaurant';
			}else if($result->client_type == 'company'){
				$data['form_name']= 'Edit Company';
			}
			$data['title']= 'SmartSend::Edit Client';
			$data['client_data']= $result;
			$this->welcome_to_edit_client_page($data);
		}else{
			$data['title']= 'SmartSend::Edit Client';
			$this->welcome_to_client_page($data);
		}
	}
	
	//Edit Client by id 
	public function edit_client_by_id($id){
		$updatingData = $this->input->post();
		if($updatingData){
			$result = $this->ClientModel->edit_client_by_id($id, $updatingData);
		
			if($result){
				$data['success_message'] = 'Client is edited successfully';
			}else{
				$data['failed_message'] = 'Failed to edit client';
			}
		}
		$data['title']= 'SmartSend::Manage Client';
		$this->session->set_userdata('user_data', $data);
		//redirect('client/welcome_to_client_page/'.$data);
		//$this->welcome_to_client_page($data);
		redirect('client/index');
	}
	
	//Edit Client by id (Not Used)
	public function edit_client($id){
		$updatingData = $this->input->post();
		if($updatingData){
			$result = $this->ClientModel->edit_client_by_id($id, $updatingData);
		
			if($result){
				$data['success_message'] = 'Client is edited successfully';
			}else{
				$data['failed_message'] = 'Failed to edit client';
			}
		}
		$data['title']= 'SmartSend::Manage Client';
		$this->welcome_to_client_page($data);
	}
	
	//Edit Client Restaurant Page 
	public function edit_client_restaurant_page($id){
		$result = $this->ClientModel->get_client_by_id($id);
		//print_r($result); exit;
		if($result){
			$data['client_data']= $result;
		}
		$data['form_name']= 'Edit Restaurant';
		$data['title']= 'SmartSend::Edit Client';
		$this->welcome_to_edit_client_restaurant_page($data);
	}
	
	//Edit Client restaurant by id 
	public function edit_client_restaurant_by_id($id){
		$updatingData = $this->input->post();
		if($updatingData){
			$result = $this->ClientModel->edit_client_by_id($id, $updatingData);
		
			if($result){
				$data['success_message'] = 'Restaurant is edited successfully';
			}else{
				$data['failed_message'] = 'Failed to edit restaurant';
			}
		}
		$data['title']= 'SmartSend::Manage Client';
		$this->session->set_userdata('user_data', $data);
		//$this->welcome_to_client_restaurant_page($data);
		redirect('client/client_restaurant_page');
	}
	
	//Edit Client Company Page 
	public function edit_client_company_page($id){
		$result = $this->ClientModel->get_client_by_id($id);
		//print_r($result); exit;
		if($result){
			$data['client_data']= $result;
		}
		$data['form_name']= 'Edit Company';
		$data['title']= 'SmartSend::Edit Client';
		$this->welcome_to_edit_client_company_page($data);
	}
	
	//Edit Client company by id 
	public function edit_client_company_by_id($id){
		$updatingData = $this->input->post();
		if($updatingData){
			$result = $this->ClientModel->edit_client_by_id($id, $updatingData);
		
			if($result){
				$data['success_message'] = 'Company is edited successfully';
			}else{
				$data['failed_message'] = 'Failed to edit company';
			}
		}
		$data['title']= 'SmartSend::Manage Client';
		//$this->welcome_to_client_company_page($data);
		$this->session->set_userdata('user_data', $data);
		redirect('client/client_company_page');
	}
	
	//Edit multiple Client (Not Used)
	public function edit_clients(){
		$clients = $this->input->post('clients');
		$result = $this->ClientModel->delete_clients($clients);
		
		if($result){
			$data['success_message'] = 'Clients are  deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete clients';
		}
		
		$data['title']= 'SmartSend::Delete Client';
		$this->welcome_to_client_page($data);
	}
	
	//Delete Client  by id 
	public function delete_client_by_id($id){
		$result = $this->ClientModel->delete_client_by_id($id);
		
		if($result){
			$data['success_message'] = 'Client is deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete client';
		}
		
		$data['title']= 'SmartSend::Delete Client';
		$this->session->set_userdata('user_data', $data);
		//$this->welcome_to_client_page($data);
		redirect('client/index');
	}
	
	//Delete multiple Client
	public function delete_clients(){
		$clients = $this->input->post('clients');
		$result = $this->ClientModel->delete_clients($clients);
		
		if($result){
			$data['success_message'] = 'Clients are  deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete clients';
		}
		
		$data['title']= 'SmartSend::Delete Client';
		$this->welcome_to_client_page($data);
	}
	
	//Delete multiple Client restaurant 
	public function delete_clients_restaurant(){
		$clients = $this->input->post('restaurants');
		$result = $this->ClientModel->delete_clients($clients);
		
		if($result){
			$data['success_message'] = 'Restaurants are  deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete restaurants';
		}
		
		$data['title']= 'SmartSend::Delete Client';
		$this->welcome_to_client_restaurant_page($data);
	}
	
	//Delete Restaurant   by id
	public function delete_restaurant_by_id($id){
		$result = $this->ClientModel->delete_client_by_id($id);
		
		if($result){
			$data['success_message'] = 'Restaurant is deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete restaurant';
		}
		
		$data['title']= 'SmartSend::Manage Restaurant';
		//$this->welcome_to_client_restaurant_page($data);
		$this->session->set_userdata('user_data', $data);
		redirect('client/client_restaurant_page');
	}
	
	//Delete multiple Client company 
	public function delete_clients_company(){
		$clients = $this->input->post('company');
		$result = $this->ClientModel->delete_clients($clients);
		
		if($result){
			$data['success_message'] = 'Companies are  deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete companies';
		}
		
		$data['title']= 'SmartSend::Delete Client';
		$this->welcome_to_client_company_page($data);
	}
	
	//Delete Company by id
	public function delete_company_by_id($id){
		$result = $this->ClientModel->delete_client_by_id($id);
		
		if($result){
			$data['success_message'] = 'Company is deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete company';
		}
		
		$data['title']= 'SmartSend::Manage Company';
		//$this->welcome_to_client_company_page($data);
		$this->session->set_userdata('user_data', $data);
		redirect('client/client_company_page');
	}
	
	//Go to client page 
	public function welcome_to_client_page($data){ 
		$config = array();
		$config["base_url"] = base_url() . "client/index";
		$total_row = $this->ClientModel->client_record_count();
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
			//$clientList = $this->ClientModel->get_all_client();
			$clientList = $this->ClientModel->get_clients($config["per_page"], $page);
			$data['client_list'] = $clientList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Go to client company page 
	public function welcome_to_client_company_page($data){
		$config = array();
		$config["base_url"] = base_url() . "client/client_company_page";
		$total_row = $this->ClientModel->client_company_record_count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 3;
		//$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row/$config["per_page"];
		$config['cur_tag_open'] = '&nbsp;<a class="current" id="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		
		if($this->uri->segment(3)){
			$page = $this->uri->segment(3);
		}
		else{
			$page = 1;
		}
		
		if(($this->session->userdata('user_email')!= "")){
			//$clientList = $this->ClientModel->get_all_company();
			$clientList = $this->ClientModel->get_clients_company($config["per_page"], $page);
			$data['client_list'] = $clientList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_company_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Go to client restaurant page 
	public function welcome_to_client_restaurant_page($data){
		$config = array();
		$config["base_url"] = base_url() . "client/client_restaurant_page";
		$total_row = $this->ClientModel->client_restaurant_record_count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 3;
		//$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row/$config["per_page"];
		$config['cur_tag_open'] = '&nbsp;<a class="current" id="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		
		if($this->uri->segment(3)){
			$page = $this->uri->segment(3);
		}
		else{
			$page = 1;
		}
		
		if(($this->session->userdata('user_email')!= "")){
			$clientList = $this->ClientModel->get_clients_restaurant($config["per_page"], $page);
			$data['client_list'] = $clientList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_restaurant_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Go to client report page 
	public function welcome_to_client_report_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('report_client_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Go to add client  page 
	public function welcome_to_add_client_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_add', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Go to edit client  page 
	public function welcome_to_edit_client_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_edit', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Go to edit client restaurant  page 
	public function welcome_to_edit_client_restaurant_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_restaurant_edit', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Go to edit client company  page 
	public function welcome_to_edit_client_company_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_company_edit', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Search client 
	public function search_client(){
		$keyword = trim($this->input->post('keyword-search-client'));
		
		if(!empty($keyword)){
			$this->session->unset_userdata('search_keyword_client');
			$this->session->set_userdata('search_keyword_client', $keyword);
		}elseif($this->session->userdata('search_keyword_client')){
			$keyword = $this->session->userdata('search_keyword_client');
		}else{
			return false;
		}
		
		$result = $this->ClientModel->search_client_by_keyword($keyword);
		
		if($result->num_rows() > 0){
			$this->search_client_page($keyword, $result->num_rows());
		}else{
			$data['title']= 'SmartSend::Manage Client';
			$this->welcome_to_client_page($data);
		}
	}
	
	//Search client page 
	public function search_client_page($keyword, $numRow){
		$config = array();
		$config["base_url"] = base_url() . "client/search_client";
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
			$clientList = $this->ClientModel->search_client_by_keyword_with_pagination($keyword, $config["per_page"], $page);
			$data['client_list'] = $clientList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
				
			$data['title'] = 'SmartSend::Search Client';
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_list', $data);
			$this->load->view('footer/footer', $data);
			}else{
				$this->session->set_flashdata('error_message', 'Please Login');
				redirect('dashboard/index');
			}
	}
	
	//Search client restaurant
	public function search_client_restaurant(){
		$keyword = trim($this->input->post('keyword-search-client-restaurant'));
		
		if(!empty($keyword)){
			$this->session->unset_userdata('search_keyword_client_restaurant');
			$this->session->set_userdata('search_keyword_client_restaurant', $keyword);
		}elseif($this->session->userdata('search_keyword_client_restaurant')){
			$keyword = $this->session->userdata('search_keyword_client_restaurant');
		}else{
			return false;
		}
		
		$result = $this->ClientModel->search_client_restaurant_by_keyword($keyword);
		
		if($result->num_rows() > 0){
			$this->search_client_restaurant_page($keyword, $result->num_rows());
		}else{
			$data['title']= 'SmartSend::Manage Restaurant';
			$this->welcome_to_client_restaurant_page($data);
		}
	}
	
	//Search client restaurant page 
	public function search_client_restaurant_page($keyword, $numRow){
		$config = array();
		$config["base_url"] = base_url() . "client/search_client_restaurant";
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
			$clientList = $this->ClientModel->search_client_restaurant_by_keyword_with_pagination($keyword, $config["per_page"], $page);
			$data['client_list'] = $clientList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
				
			$data['title'] = 'SmartSend::Search Client';
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_restaurant_list', $data);
			$this->load->view('footer/footer', $data);
			}else{
				$this->session->set_flashdata('error_message', 'Please Login');
				redirect('dashboard/index');
			}
	}
	
	//Search client company 
	public function search_client_company(){
		$keyword = trim($this->input->post('keyword-search-client-company'));
		
		if(!empty($keyword)){
			$this->session->unset_userdata('search_keyword_client_company');
			$this->session->set_userdata('search_keyword_client_company', $keyword);
		}elseif($this->session->userdata('search_keyword_client_company')){
			$keyword = $this->session->userdata('search_keyword_client_company');
		}else{
			return false;
		}
		
		$result = $this->ClientModel->search_client_company_by_keyword($keyword);
		
		if($result->num_rows() > 0){
			$this->search_client_company_page($keyword, $result->num_rows());
		}else{
			$data['title']= 'SmartSend::Manage Restaurant';
			$this->welcome_to_client_company_page($data);
		}
	}
	
	//Search client company page 
	public function search_client_company_page($keyword, $numRow){
		$config = array();
		$config["base_url"] = base_url() . "client/search_client_company";
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
			$clientList = $this->ClientModel->search_client_company_by_keyword_with_pagination($keyword, $config["per_page"], $page);
			$data['client_list'] = $clientList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
				
			$data['title'] = 'SmartSend::Search Company';
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_company_list', $data);
			$this->load->view('footer/footer', $data);
			}else{
				$this->session->set_flashdata('error_message', 'Please Login');
				redirect('dashboard/index');
			}
	}
	
	//View details client page 
	public function view_details_client_page($id){
		$clientDetails[] = $this->ClientModel->get_client_by_id($id);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Client Details';
			$data['client_list'] = $clientDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//View details multiple client page 
	public function view_details_multiple_client_page(){
		$clients = $this->input->post('clients');
		$clientDetails = $this->ClientModel->get_multiple_client_by_id($clients);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Client Details';
			$data['client_list'] = $clientDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//View details multiple client restaurant page 
	public function view_details_multiple_client_restaurant_page(){
		$clients = $this->input->post('restaurants');
		$clientDetails = $this->ClientModel->get_multiple_client_restaurant_by_id($clients);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Restaurant Details';
			$data['client_list'] = $clientDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//View details multiple client company page 
	public function view_details_multiple_client_company_page(){
		$clients = $this->input->post('company');
		$clientDetails = $this->ClientModel->get_multiple_client_company_by_id($clients);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Company Details';
			$data['client_list'] = $clientDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('client_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	
}
