<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct(){
		parent:: __construct();
	}
	
	public function index(){
		
	}
	
	//login by email and password 
	public function login($data){
		$this->db->where(array('email' => $data['user-email'], 'password' => $data['user-password']));
		$user=$this->db->get("ss_users");
		  if($user->num_rows()>0)
		  {
		   foreach($user->result() as $rows)
		   {
			//add all data to session
			$userData = array(
			  'user_id'  => $rows->id,
			  'user_name'  => $rows->user_name,
			  'user_email'    => $rows->email,
			  'first_name'    => $rows->first_name,
			  'last_name'    => $rows->last_name,
			  'logged_in'  => TRUE
			);
		   }
		   $this->session->set_userdata($userData);
		   return true;
		  }
	}
	
}