<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {	

	public function __construct()

       {

            parent::__construct();
                   

       }


public function index(){
	$this->load->view('auth/login');
}


public function login(){
    $data = array('rs'=>'', 'msg'=>'');
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$this->db->where('username', $username);
	$this->db->where('password', md5($password));
	$user = $this->db->get('users');
	if($user->num_rows() == 1){
	    $user_info = $user->row_array();
	    $this->session->set_userdata('user_info',array('user_id'=>$user_info['id'] ,'branch_id'=>$user_info['branch_id'] ,'role'=>$user_info['role'],'full_name'=>$user_info['full_name'],'is_login'=>'1','pic'=>'default.jpg'));
	    $rs = 1;    

		 $ms = base_url();
	    switch ($user_info['role']) {
	    	case 'admin':
	    		 $ms = base_url().'view/';
	    		break;
	    	case 'staff':
	    		 $ms = base_url().$user_info['username'].'/';
	    	default:	    		
	    		break;
	    }


	   // $ms = base_url().'view/';
	   // redirect('view/');
	    
	    
	}else{
	    $rs= 0;
	    $ms = 'Username or Password Invalid !';
	    //redirect('authentication/');
	}
    
	
 	$data = array('rs'=>$rs, 'msg'=>$ms);
 	header('Content-Type: application/json');
 	echo json_encode($data);
	
}

function logout(){
  
     $this->load->library('cart');
    $this->cart->destroy();
      $this->session->unset_userdata('user_info');
    redirect('authentication/');
    
    
}






}       