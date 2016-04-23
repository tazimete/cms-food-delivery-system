<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rider extends CI_Controller {
	
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
		
	}

	public function index(){
		$data['title']= 'SmartSend::Manage Rider';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_rider_page($data);
	}
	
	//Rider page 
	public function welcome_to_rider_page($data){
		$config = array();
		$config["base_url"] = base_url() . "rider/index";
		$total_row = $this->RiderModel->rider_record_count();
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
			$RiderList = $this->RiderModel->get_riders($config["per_page"], $page);
			$data['rider_list'] = $RiderList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('rider_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//load add rider page 
	public function add_rider_page(){
		$data['form_name']= 'Add Rider';
		$data['title']= 'SmartSend :: Add Rider';
		$this->welcome_to_add_rider_page($data);
	}
	
	//Go to add rider  page 
	public function welcome_to_add_rider_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('rider_add', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Add Rider 
	public function add_rider(){
		$this->form_validation->set_error_delimiters('<div class="failed-message">', '</div>');
		$this->form_validation->set_rules('rider-profile-picture', 'profile picture', 'file_required');
		$this->form_validation->set_rules('rider-name', 'name', 'required|trim');
		$this->form_validation->set_rules('rider-email', 'email', 'required|trim|is_unique[ss_rider.email]');
		$this->form_validation->set_rules('rider-password', 'password', 'required|trim|is_unique[ss_rider.password]');
		$this->form_validation->set_rules('rider-bike-number', 'bike number', 'required|trim|is_unique[ss_rider.bike_number]');
		$this->form_validation->set_rules('rider-contact-number', 'contact number', 'required|trim|is_unique[ss_rider.contact_number]');
		
		$config['upload_path'] = './static/images/profile-pictures/';
		$config['upload_url'] = base_url().'static/images/profile-pictures/';
		$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PNG|jpeg';
		$config['max_size']	= '0';
		//$config['max_width'] = '768';
		//$config['max_height'] = '1024';
		$config['file_name'] = $this->input->post('rider-name').'_'.$this->input->post('rider-bike-number');

		$this->load->library('upload', $config);

		if ( $this->upload->do_upload('rider-profile-picture') == false || $this->form_validation->run() == false ){
			$data = array('error_picture' => $this->upload->display_errors('<div class="failed-message">', '</div>'));
			$data['form_name']= 'Add Rider';
			$data['title']= 'SmartSend :: Add Rider';
			$this->welcome_to_add_rider_page($data);
		}else{
			$data = $this->input->post();
			if($data){
				$data['upload_data'] = $this->upload->data();
				$result = $this->RiderModel->insert_rider_data($data);
			
				if($result){
					$data['success_message'] = 'Rider is added successfully';
				}else{
					$data['failed_message'] = 'Failed to add rider';
				}
			}
			$data['title']= 'SmartSend :: Manage Rider';
			$this->welcome_to_rider_page($data);
		}		
	}
	
	//Edit Rider Page 
	public function edit_rider_page($id){
		$result = $this->RiderModel->get_rider_by_id($id);
		//print_r($result); exit;
		if($result){
			$data['title']= 'SmartSend :: Edit Rider';
			$data['form_name']= 'Edit Rider';
			$data['rider_data']= $result;
			$this->welcome_to_edit_rider_page($data);
		}else{
			$data['title']= 'SmartSend::Edit Client';
			$this->welcome_to_rider_page($data);
		}
	}
	
	//Edit Rider 
	public function edit_rider_by_id($id){
		//Declaration
		$uploadImage = true;
		$uploadError = false;
		
		//Validation 
		$this->form_validation->set_error_delimiters('<div class="failed-message">', '</div>');
		//$this->form_validation->set_rules('rider-profile-picture', 'profile picture', 'file_required');
		$this->form_validation->set_rules('rider-name', 'name', 'required|trim');
		$this->form_validation->set_rules('rider-email', 'email', 'required|trim');
		$this->form_validation->set_rules('rider-password', 'password', 'required|trim');
		$this->form_validation->set_rules('rider-bike-number', 'bike number', 'required|trim');
		$this->form_validation->set_rules('rider-contact-number', 'contact number', 'required|trim');
		
		$config['upload_path'] = './static/images/profile-pictures/';
		$config['upload_url'] = base_url().'static/images/profile-pictures/';
		$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PNG|jpeg';
		$config['max_size']	= '0';
		//$config['max_width'] = '768';
		//$config['max_height'] = '1024';
		$config['file_name'] = $this->input->post('rider-name').'_'.$this->input->post('rider-bike-number');

		//Loading upload library 
		$this->load->library('upload', $config);
		
		//get uploading file info if file is uploaded
		if($_FILES['rider-profile-picture']['tmp_name']){
			$imageData = $this->upload->data();
		
			if($imageData['file_name']){
				$uploadImage = $this->upload->do_upload('rider-profile-picture');
				$uploadError = $this->upload->display_errors('<div class="failed-message">', '</div>');
			}
		}

		if ( $uploadImage == false || $this->form_validation->run() == false ){
			$data = array('error_picture' => $uploadError);
			$data['form_name']= 'Update Rider';
			$data['title']= 'SmartSend :: Update Rider';
			$this->welcome_to_edit_rider_page($data);
		}else{
			$data = $this->input->post();
			if($data){
				if($_FILES['rider-profile-picture']['tmp_name']){
					$data['upload_data'] = $this->upload->data();
				}
				$result = $this->RiderModel->edit_rider_by_id($data, $id);
			
				if($result){
					$data['success_message'] = 'Rider is updated successfully';
				}else{
					$data['failed_message'] = 'Failed to update rider';
				}
			}
			$data['title']= 'SmartSend :: Manage Rider';
			//$this->welcome_to_rider_page($data);
			$this->session->set_userdata('user_data', $data);
			redirect('rider/index');
		}		
	}
	
	//Delete Rider  by id 
	public function delete_rider_by_id($id){
		$result = $this->RiderModel->delete_rider_by_id($id);
		
		if($result){
			$data['success_message'] = 'Rider is deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete rider';
		}
		
		$data['title']= 'SmartSend::Delete Rider';
		$this->session->set_userdata('user_data', $data);
		//$this->welcome_to_rider_page($data);
		redirect('rider/index');
	}
	
	//Delete multiple Rider
	public function delete_riders(){
		$riders = $this->input->post('riders');
		$result = $this->RiderModel->delete_riders($riders);
		
		if($result){
			$data['success_message'] = 'Riders are deleted successfully';
		}else{
			$data['failed_message'] = 'Failed to delete riders';
		}
		
		$data['title']= 'SmartSend::Delete Rider';
		$this->welcome_to_rider_page($data);
	}
	
	//Go to edit Rider  page 
	public function welcome_to_edit_rider_page($data){
		if(($this->session->userdata('user_email')!= "")){
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('rider_edit', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//Search rider 
	public function search_rider(){
		$keyword = trim($this->input->post('keyword-search-rider'));
		
		if(!empty($keyword)){
			$this->session->unset_userdata('search_keyword_rider');
			$this->session->set_userdata('search_keyword_rider', $keyword);
		}elseif($this->session->userdata('search_keyword_rider')){
			$keyword = $this->session->userdata('search_keyword_rider');
		}else{
			return false;
		}
		
		$result = $this->RiderModel->search_rider_by_keyword($keyword);
		
		if($result->num_rows() > 0){
			$this->search_rider_page($keyword, $result->num_rows());
		}else{
			$data['title']= 'SmartSend::Manage Rider';
			$this->welcome_to_rider_page($data);
		}
	}
	
	//Search rider page 
	public function search_rider_page($keyword, $numRow){
		$config = array();
		$config["base_url"] = base_url() . "rider/search_rider";
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
			$riderList = $this->RiderModel->search_rider_by_keyword_with_pagination($keyword, $config["per_page"], $page);
			$data['rider_list'] = $riderList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
				
			$data['title'] = 'SmartSend::Search Rider';
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('rider_list', $data);
			$this->load->view('footer/footer', $data);
			}else{
				$this->session->set_flashdata('error_message', 'Please Login');
				redirect('dashboard/index');
			}
	}
	
	//View details rider page 
	public function view_details_rider_page($id){
		$riderDetails[] = $this->RiderModel->get_rider_by_id($id);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Rider Details';
			$data['rider_list'] = $riderDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('rider_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//View details multiple rider page 
	public function view_details_multiple_rider_page(){
		$riders = $this->input->post('riders');
		$riderDetails = $this->RiderModel->get_multiple_rider_by_id($riders);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Rider Details';
			$data['rider_list'] = $riderDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('rider_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
} //End of controller 