<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {	

	public function __construct()

       {

            parent::__construct();
             $user = $this->session->userdata('user_info');
            if($user['user_id']!= 1 || $user['is_login'] != 1 || $user['role'] !='admin'){
                $this->session->set_flashdata("alert", "You Must Login ! ('~') ");
                redirect('authentication/');
            }
            
            $this->load->model('common_model', 'model', true);                      

       }

	public function index()	{
		$data= array('title'=> 'Report', 'subtitle'=>'');

		$this->load->view('report/list', $data);	
	}

	function wasteView(){
		$data= array('title'=> 'workstationone', 'subtitle'=>'waste');

		$this->load->view('raw_material/waste_material', $data);
	}


	function chalans($page_title,$table_name,$dep=0){
		
		
		$data= array('title'=> 'chalans', 'subtitle'=>'','page'=>$page_title,'table'=>$table_name,'dep'=>$dep);

		$this->load->view('report/chalans', $data);
	}



	function material_receive_chalans(){
		$data= array('title'=> 'workstationone', 'subtitle'=>'material');

		$this->load->view('report/material_receive_chalans', $data);
	}


	function verify_material_chalan(){
		$chid = $this->input->post('chalan_id');
		$ch = $this->db->where('id',$chid)->get('raw_material_chalan')->row_array();
		$str='';
		if($ch){
			// $acc = $this->db->where('chalan_id',$ch['id'])->where('chalan_no',$ch['chalan_no'])->where('user_id',$ch['supplier_id'])->where('purpose','sale')->get('account_supplier')->row_array();
			// if($acc){
			// 	$this->db->where('id',$acc['id'])->update('account_supplier',array('status'=>'verified'));

			// 	$str .= 'Account Updated ! ';
			// }else{
			// 	$str .='Account Not Updated ! ';
			// }

			$this->db->where('material_chalan_id',$ch['id']);
			$this->db->update('raw_material', array('status'=>'verified'));
			$str .= ' Materials updated !';
			$this->db->where('id',$ch['id'])->update('raw_material_chalan',array('status'=>'verified'));

			$str .= ' Chalan Verified ! ';
		}else{
			$str .=' Chalan not Found ! ';
		}
		

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>$str));
		
	}

	function finish_goods_chalans(){
		$data= array('title'=> 'workstationone', 'subtitle'=>'finishGoods');

		$this->load->view('report/finish_goods_chalan', $data);
	}

	function verify_finish_goods_chalan(){
		$chid = $this->input->post('chalan_id');
		$str ='';
		$this->db->where('stock_chalan_id',$chid)->update('product_stock',array('status'=>'verified'));
		$str.='Stock Verified ! ';
		$this->db->where('id',$chid)->update('product_stock_chalan',array('status'=>'verified'));
		$str .= 'Chalan Verified ! ';
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=> $str));
	}
	function verify_waste(){
		$id = $this->input->post('waste_id');
		
		$this->db->where('id',$id)->update('waste',array('status'=>'verified'));
		
		
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=> 'Verified ! '));
	}

	function sale_chalans(){
		$data= array('title'=> 'workstationtwo', 'subtitle'=>'Sales');

		$this->load->view('report/sale_chalans', $data);
	}

	function verify_sales_chalan(){
		$chid = $this->input->post('chalan_id');
		$ch = $this->db->where('id',$chid)->get('product_sale_chalan')->row_array();
		$str='';
		if($ch){
			$acc = $this->db->where('chalan_id',$ch['id'])->where('chalan_no',$ch['chalan_no'])->where('user_id',$ch['buyer_id'])->where('purpose','buy')->get('account')->row_array();
			if($acc){
				$this->db->where('id',$acc['id'])->update('account',array('status'=>'verified'));

				$str .= 'Account Updated ! ';
			}else{
				$str .='Account Not Updated ! ';
			}
			$this->db->where('chalan_id',$ch['id'])->update('product_sell',array('status'=>'verified'));
			$str.='Sale Updated ! ';
			$this->db->where('id',$ch['id'])->update('product_sale_chalan',array('status'=>'verified'));
			$str .= 'Chalan Verified ! ';

		}else{
			$str .=' Chalan not Found ! ';
		}
		

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>$str));
	}

	function verify_buyer_payments(){
		$id = $this->input->post('payment_id');
		$this->db->where('id',$id)->update('account',array('status'=>'verified'));
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>'Payment Was Verified ! '));
	}
	function verify_supplier_payments(){
		$id = $this->input->post('payment_id');
		$this->db->where('id',$id)->update('account_supplier',array('status'=>'verified'));
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>'Payment Was Verified ! '));
	}


	function transfer_chalans(){
		$data= array('title'=> 'transfer_chalans', 'subtitle'=>'');

		$this->load->view('report/transfer_chalans', $data);		
	}
	function verify_transfer_chalan(){
		$chid = $this->input->post('chalan_id');
		$this->db->where('id',$chid)->update('product_transfer_chalan',array('status'=>'verified'));
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>'Chalan Was Verified ! '));
	}

	function accessories_chalans(){
		$data= array('title'=> 'accessories_chalans', 'subtitle'=>'');

		$this->load->view('report/accessories_chalans', $data);		
	}

	function verify_accessories_chalan(){
		$chid = $this->input->post('chalan_id');
		$this->db->where('id',$chid)->update('accessories_receive_chalan',array('status'=>'verified'));
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>'Chalan Was Verified ! '));
	}













































	function buyer_ladger_form(){
    	 $data= array('title'=> 'Account', 'subtitle'=>'','error'=>'');
                                            
             $this->load->view('report/buyer_ladger_form', $data);
 
    }
    function buyer_account_details(){
    	$data['bid'] = $this->input->post('buyer_id');
	    $data['from'] = $this->input->post('from');
	    $data['to'] = $this->input->post('to');
	    
	   
	    if($data['from']!=''){
	        $form = date('Y-m-d H:i:s', strtotime($data['from']));	        
	        $this->db->where('create_at >=', $form);	     
	    }
	    if($data['to']!=''){	       
	        $to = date('Y-m-d H:i:s', strtotime($data['to']));	       
	        $this->db->where('create_at <=', $to);
	    }
	    if($data['bid']!=0){
	        $this->db->where('user_id', $data['bid']);
	    }
	    $data['sql'] = $this->db->get('account');
	    $this->load->view('report/buyer_ladger_details', $data);
    }
	
	
	function expense_details(){
	     $data['type'] = $this->input->post('type');
	    $data['from'] = $this->input->post('from');
	    $data['to'] = $this->input->post('to');
	    
	   
	    if($data['from']!='' && $data['to']!=''){
	        $form = date('Y-m-d H:i:s', strtotime($data['from']));
	        $to = date('Y-m-d H:i:s', strtotime($data['to']));
	        $this->db->where('created_at >=', $form);
	        $this->db->where('created_at <=', $to);
	    }
	    if($data['type']!=0){
	        $this->db->where('expense_type_id', $data['type']);
	    }
	    $data['sql'] = $this->db->get('expense');
	    $this->load->view('report/expense_details_view', $data);
	    
	    
	}
	function expense_report_form(){
	      $data= array('title'=> 'Report', 'subtitle'=>'');
         $data['type'] = $this->model->getData('expense_type', 'status', '1');
		$this->load->view('report/expense_report_form', $data);
	}
	
	
	function material_buy_report_form(){
	    $data= array('title'=> 'Report', 'subtitle'=>'Material');
	    $this->db->where('status',1);
	    $this->db->order_by('type_name','ASC');
         $data['type'] = $this->db->get('raw_material_type')->result_array();
         $data['supplier'] = $this->db->where('role','supplier')->get('users');
		$this->load->view('report/material_buy_report_form', $data);
	}
	
	
	function show_material_buy_details(){
		$data= array('title'=> 'Report', 'subtitle'=>'Material');
	    $data['type'] = $this->input->post('type');
	    $data['from'] = $this->input->post('from');
	    $data['to'] = $this->input->post('to');
	    $data['report_type'] = $this->input->post('report_type');
	    $data['supplier'] = $this->input->post('supplier');

	    if(strcmp($data['report_type'],'total')===0){
	    	$this->db->select('SUM(quantity) as tot_qty, SUM(subtotal) as total');

	    }else{
	    	$this->db->select('*');
		    
	    }
	    if($data['from']!='' && $data['to']!=''){
	        $form = date('Y-m-d H:i:s', strtotime($data['from']));
	        $to = date('Y-m-d H:i:s', strtotime($data['to']));
	        $this->db->where('create_at >=', $form);
	        $this->db->where('create_at <=', $to);
		    }
		 if($data['type']!=0){
		        $this->db->where('material_id', $data['type']);
		    }
		 if($data['supplier']!=0){
		        $this->db->where('supplier_id', $data['supplier']);
		    }

	    $data['sql'] = $this->db->get('raw_material');	   
	    
	    $this->load->view('report/material_buy_report_view', $data);
	    
	    
	}
	
	
	
	function production_report_form(){
	    $data= array('title'=> 'Report', 'subtitle'=>'FinishGoods');
         $data['type'] = $this->model->getData('product_type', 'status', '1');
		$this->load->view('report/production_report_form', $data);
	}
	
	
	function show_production_details(){
		
		$data= array('title'=> 'Report', 'subtitle'=>'FinishGoods');
	    $data['product_id'] = $this->input->post('product_id');
	    $data['type_id'] = $this->input->post('type_id');
	    $data['from'] = $this->input->post('from');
	    $data['to'] = $this->input->post('to');
	   
	   //stock
	    if($data['from']!="" && $data['to']!=""){
	        $from = date('Y-m-d H:i:s', strtotime($data['from']));
	        $to = date('Y-m-d', strtotime($data['to'])).' 23:59:59';
	        $this->db->where('created_at >=', $from);
	        $this->db->where('created_at <=', $to);
	    }

	   

	    if($data['type_id']!= '0'){
	        $this->db->where('product_type_id', $data['type_id']);
	    }
	    if($data['product_id'] != '0'){
	        $this->db->where('product_id', $data['product_id']);
	    }
	    $this->db->where('status','verified');
	    $this->db->order_by('chalan_no', 'ASC');

	    $data['sql'] = $this->db->get('product_stock');
	    //sale
	    if($data['from']!="" && $data['to']!=""){
	        
	        $this->db->where('create_at >=', $from);
	        $this->db->where('create_at <=', $to);
	    }
	    if($data['type_id']!= '0'){
	        $this->db->where('product_type_id', $data['type_id']);
	    }
	    if($data['product_id'] != '0'){
	        $this->db->where('product_id', $data['product_id']);
	    }
	    $this->db->where('status','verified');
	    $data['sale'] = $this->db->get('product_sell');




	    $this->load->view('report/product_report_view', $data);
	}

	function sale_report_form(){
	    $data= array('title'=> 'Report', 'subtitle'=>'SalesGoods');
         $data['type'] = $this->model->getData('product_type', 'status', '1');
		$this->load->view('report/sale_report_form', $data);
	}

	function show_sales_report(){
		$data= array('title'=> 'Report', 'subtitle'=>'SalesGoods');
	    $data['product_id'] = $this->input->post('product_id');
	    $data['type_id'] = $this->input->post('type_id');
	    $data['from'] = $this->input->post('from');
	    $data['to'] = $this->input->post('to');

	   //stock
	    if($data['from']!="" && $data['to']!=""){
	        $from = date('Y-m-d H:i:s', strtotime($data['from']));
	        $to = date('Y-m-d', strtotime($data['to'])).' 23:59:59';
	        $this->db->where('created_at >=', $from);
	        $this->db->where('created_at <=', $to);
	    }

	   
	    //sale
	    if($data['from']!="" && $data['to']!=""){
	        
	        $this->db->where('create_at >=', $from);
	        $this->db->where('create_at <=', $to);
	    }
	    if($data['type_id']!= '0'){
	        $this->db->where('product_type_id', $data['type_id']);
	    }
	    if($data['product_id'] != '0'){
	        $this->db->where('product_id', $data['product_id']);
	    }
	    $this->db->where('status','verified');
	    $data['sale'] = $this->db->get('product_sell');

	    $this->load->view('report/sale_report_view', $data);

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}