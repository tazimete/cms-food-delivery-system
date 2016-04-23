<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	
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
		$this->load->model('outlet_model', 'OutletModel');
		$this->load->model('singpost_model', 'SingpostModel');
		$this->load->model('singpost_model', 'SingpostModel');
		$this->load->model('option_model', 'OptionModel');
		$this->load->model('order_model', 'OrderModel');
		
	}

	public function index(){
		$data['title']= 'SmartSend :: Outlet';
		
		if($this->session->userdata('user_data')){
			$data = $this->session->userdata('user_data');
			$this->session->unset_userdata('user_data');
		}
		
		$this->welcome_to_order_page($data);
	}
	
	//Order page 
	public function welcome_to_order_page($data){
		$config = array();
		$config["base_url"] = base_url() . "order/index";
		$total_row = $this->OrderModel->order_record_count();
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
			$OrderList = $this->OrderModel->get_orders($config["per_page"], $page);
			$data['order_list'] = $OrderList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('order_list', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//View details order page 
	public function view_details_order_page($id){
		$orderDetails[] = $this->OrderModel->get_order_by_id($id);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend :: View Order Details';
			$data['order_list'] = $orderDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('order_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	//View details multiple order page 
	public function view_details_multiple_order_page(){
		$orders = $this->input->post('orders');
		$orderDetails = $this->OrderModel->get_multiple_order_by_id($orders);
		
		if(($this->session->userdata('user_email')!= "")){				
			$data['title'] = 'SmartSend::View Order Details';
			$data['order_list'] = $orderDetails;
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('order_details', $data);
			$this->load->view('footer/footer', $data);
		}else{
			$this->session->set_flashdata('error_message', 'Please Login');
			redirect('dashboard/index');
		}
	}
	
	
	//Search order 
	public function search_order(){
		$keyword = trim($this->input->post('keyword-search-order'));
		
		if(!empty($keyword)){
			$this->session->unset_userdata('search_keyword_order');
			$this->session->set_userdata('search_keyword_order', $keyword);
		}elseif($this->session->userdata('search_keyword_order')){
			$keyword = $this->session->userdata('search_keyword_order');
		}else{
			return false;
		}
		
		$result = $this->OrderModel->search_order_by_keyword($keyword);
		
		if($result->num_rows() > 0){
			$this->search_order_page($keyword, $result->num_rows());
		}else{
			$data['title']= 'SmartSend :: Manage Order';
			$this->welcome_to_order_page($data);
		}
	}
	
	//Search order page 
	public function search_order_page($keyword, $numRow){
		$config = array();
		$config["base_url"] = base_url() . "order/search_order";
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
			$orderList = $this->OrderModel->search_order_by_keyword_with_pagination($keyword, $config["per_page"], $page);
			$data['order_list'] = $orderList;
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
				
			$data['title'] = 'SmartSend::Search Order';
			$this->load->view('header/header', $data);
			$this->load->view('common/nav', $data);
			$this->load->view('order_list', $data);
			$this->load->view('footer/footer', $data);
			}else{
				$this->session->set_flashdata('error_message', 'Please Login');
				redirect('dashboard/index');
			}
	}

	
} //End of controller 