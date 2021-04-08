<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {	

	public function __construct()

       {

            parent::__construct();
            
            $user = $this->session->userdata('user_info');
            if($user['user_id']!= 1 || $user['is_login'] != 1 || $user['role'] !='admin'){
                $this->session->set_flashdata("alert", "You Must Login With Valid Username/Password! ('~') ");
                redirect('authentication/');
                 
            }
            $this->operator = $user['user_id'];
            $this->load->model('common_model', 'model', true);
             $this->load->library('cart');                  
       }

	public function index()	{
		$data= array('title'=> 'Dashboard', 'subtitle'=>'');
		
		$data['scredit'] = $this->db->query("SELECT (SUM(credit)-SUM(debit)) as scredit FROM `account_supplier` WHERE `status` = 'verified' ")->row_array()['scredit'];


		// deposit or loan
		$advance = 0;
		$post = 0;
		$type = $this->model->getData('users', 'role','buyer');
		if(!empty($type)){
			foreach($type as $key=>$val){

				$sql = "SELECT (SUM(credit)-SUM(debit)) as bal FROM `account` WHERE `status` = 'verified' AND `user_id` =".$val['id'];
				$info = floatval($this->db->query($sql)->row_array()['bal']);
				if($info >= 0){
					$advance += $info;
				}else{ 
					$post += $info;
				}
			}		
		}
		$data['advance'] = $advance;
		$data['post'] = $post;
		//stock break
		$autoStock= $this->db->query("SELECT SUM(`weight`) as astock FROM `product_stock` WHERE `product_type_id` = 1 AND `status` = 'verified' ")->row_array();
		$autoSale = $this->db->query("SELECT SUM(`weight` ) as asale FROM `product_sell` WHERE `product_type_id` = 1 AND `status` = 'verified' ")->row_array();

		$aluStock= $this->db->query("SELECT SUM(`weight`) as alustock FROM `product_stock` WHERE `product_type_id` = 2 AND `status` = 'verified' ")->row_array();
		$aluSale = $this->db->query("SELECT SUM(`weight` ) as alusale FROM `product_sell` WHERE `product_type_id` = 2 AND `status` = 'verified' ")->row_array();

		$finStock= $this->db->query("SELECT SUM(`weight` ) as finstock FROM `product_stock` WHERE `product_type_id` = 3 AND `status` = 'verified' ")->row_array();
		$finSale = $this->db->query("SELECT SUM(`weight` ) as finsale FROM `product_sell` WHERE `product_type_id` = 3 AND `status` = 'verified' ")->row_array();



		$data['autoG'] = floatval($autoStock['astock']) - floatval($autoSale['asale']);
		$data['aluC'] = floatval($aluStock['alustock']) - floatval($aluSale['alusale']);
		$data['finG'] = floatval($finStock['finstock']) - floatval($finSale['finsale']);

		//stock
		$rawMaterial = $this->db->query("SELECT SUM(`totweight`) as totWeight FROM `raw_material_chalan` WHERE `status` = 'verified' ")->row_array();

		$waste = $this->db->query("SELECT SUM(`qty`) as qty FROM `waste` WHERE `status` = 'verified' ")->row_array();
		
		$finishGoods = $this->db->query("SELECT SUM(`totweight`) as totWeight FROM `product_stock_chalan` WHERE `status` = 'verified' ")->row_array();

		$sale = $this->db->query("SELECT SUM(`totweight`) as totWeight FROM `product_sale_chalan` WHERE `status` = 'verified'  ")->row_array();
		 
		$data['rawBalance'] = floatval($rawMaterial['totWeight']) - floatval($finishGoods['totWeight']) - floatval($waste['qty']);


		$data['finishGBalance'] = floatval($finishGoods['totWeight']) - floatval($sale['totWeight']);


		
		$this->load->view('dashboard', $data);	
	}


	function chalan_raw_material_chalan($dep=0){
			$data = array();
		$chalans= $this->db->get('raw_material_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_material_chalan/'.$val['chalan_no'].'"  class="btn btn-info btn-sm" >View</a> ';
				
				$supplier = get_user_info_by_id($val['supplier_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}


	function view_material_chalan($id=''){
		$data= array('title'=> 'workstationone', 'subtitle'=>'material');
		if($id!=''){	
			
			$data['material'] = $this->db->where('material_chalan_id',$id)->get('raw_material')->result_array();
			$data['chalan'] = $this->db->where('id',$id)->get('raw_material_chalan')->row_array();	

			$this->load->view('report/view_material_chalan',$data);
		}else{
			redirect('view');
		}
		

	}
	function getTotal($cartTotal,$additional,$sub){
    	$total = $cartTotal + $additional;
    	$total  = $total - $sub;
    	return $total;
 	}

	function update_material_chalan(){
		//echo '<pre>';
		//print_r($_POST);
		
		//$material_table_id = $this->input->post('material_table_id');
		$chalan_table_id = $this->input->post('chalan_table_id');
		$chalan = $this->db->where('id',$chalan_table_id)->get('raw_material_chalan')->row_array();
		if($chalan){
			$other_expense = 0; //floatval($this->input->post('other_expense'));
        	$discount = 0; //floatval($this->input->post('discount'));
			$price = 1; //$this->input->post('price');
			$qty = $this->input->post('qty');
			$materialids = $this->input->post('type_id');
			$total = 0;
			for($i=0;$i<count($materialids);$i++){

				$subtotal = $qty[$i] * 1; //$price[$i];

				$update_array = array(
					'price'=>$price,
					'quantity'=>$qty[$i],
					'subtotal'=>$subtotal	

					);

				$this->db->where('id',$materialids[$i]);
				$this->db->update('raw_material',$update_array);
				$total += $subtotal;
				}

			$rcdata['other_expense'] = $other_expense;
        	$rcdata['total']= $this->getTotal(floatval($total),$other_expense,$discount);
        	$rcdata['discount'] = $discount;
        	$rcdata['updated_at'] = date('Y-m-d');	
			$this->db->where('id',$chalan['id']);
			$this->db->update('raw_material_chalan', $rcdata);
			//update account 
			/*$sale_account = $this->db->where('chalan_id',$chalan['id'])->where('purpose','sale')->where('user_id',$chalan['supplier_id'])->get('account_supplier')->row_array();
			if($sale_account){
			$this->db->where('id',$sale_account['id'])->update('account_supplier',array('credit'=>$rcdata['total']));
			}	
			//add to account 
			$amount = floatval($this->input->post('amount'));
			if($amount > 0 ){
				//get supplier				
			 	$payment = array(
	              'payment_date'=>date('Y-m-d', strtotime($this->input->post('paymentdate'))),
	              'debit'=>$this->input->post('amount'),
	              'user_id'=>$chalan['supplier_id'],
	              'type'=>$this->input->post('payment_type'),
	              'user_type'=>'supplier',
	              'purpose'=>'payment',
	              'chalan_id'=> $chalan['id'],
	              'chalan_no'=> $chalan['chalan_no'],
	              'operator_id'=>$this->operator
	              
	            );
	          if($this->input->post('payment_type') =='cheque'){
	         		$payment['details'] = json_encode(array('bank'=>$this->input->post('bankname'),'cheque'=>$this->input->post('chequenumber'),'cdate'=>$this->input->post('checkdate')));
	         	} 
	          	$this->db->insert('account_supplier', $payment);
        	}*/
      }    
       $this->session->set_flashdata(array('alert'=>'Chalan Updated ! ', 'alert_type'=>'alert alert-success'));
		redirect('report/material_receive_chalans');


	}




	function chalan_spare_parts_chalan($dep=0){
			$data = array();
		$chalans= $this->db->where('department',1)->get('spare_parts_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_spare_parts_chalan/'.$val['chalan_no'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				
				$supplier = get_user_info_by_id($val['supplier_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}


function view_spare_parts_chalan($cid=''){
		$data= array('title'=> 'Report', 'subtitle'=>'view_spare_parts_chalan');
		if($cid!=''){			
			$data['chalan_no']=$cid;		
			$data['chalan'] = $this->db->where('chalan_no',$cid)->get('spare_parts_chalan')->row_array();
			$data['parts'] = $this->db->where('chalan_no',$cid)->get('spare_parts_receive')->row_array();	
			$this->load->view('report/view_spare_parts_chalan',$data);	
			
		}else{
			redirect('view');
		}
		

	}

function update_parts_chalan(){

		$receive_table_id = $this->input->post('receive_table_id');
		$chalan_table_id = $this->input->post('chalan_table_id');
		$price =$this->input->post('price');
		$qty = $this->input->post('qty');
		$subtotal = $qty * $price;

		$update_array = array(
			'price'=>$price,
			'qty'=>$qty,
			'subtotal'=>$subtotal	

			);

		$this->db->where('id',$receive_table_id);
		$this->db->update('spare_parts_receive',$update_array);
		$this->db->where('id',$chalan_table_id);
		$this->db->update('spare_parts_chalan',array('total'=> $subtotal,'status'=>'verified'));

		redirect('report/chalans/spare_parts_chalans/spare_parts_chalan');


	}



	function chalan_product_sale_chalan($dep=0){
		$data = array();
		$chalans= $this->db->where('from_dep',$dep)->get('product_sale_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_material_chalan/'.$val['chalan_no'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				$supplier = get_user_info_by_id($val['buyer_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}


	function chalan_scrab_delivery_chalan($dep=0){
		$data = array();
		$chalans= $this->db->where('from_dep',$dep)->get('scrab_delivery_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_material_chalan/'.$val['chalan_no'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				$supplier = get_user_info_by_id($val['buyer_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function chalan_accessories_receive_chalan($dep=0){
		$data = array();
		$chalans= $this->db->get('accessories_receive_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_material_chalan/'.$val['chalan_no'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				$supplier = get_user_info_by_id($val['supplier_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function chalan_goods_receive_chalan($dep=0){
		$data = array();
		$chalans= $this->db->where('department_id',$dep)->get('goods_receive_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_material_chalan/'.$val['chalan_no'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				$supplier = get_user_info_by_id($val['supplier_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}




	 function update_cart($page){
       		
       		$cid = $this->input->post('cid');
            foreach($this->input->post() as $item){
                $data = array(
                        'rowid' => $item['rowid'],
                        'price' => $item['price']
                );

                $this->cart->update($data);
            }
               
            redirect('view/'.$page.'/'.$cid);
       }



	function chalan_details($table,$table2,$cid){
		if($cid==''){
			redirect('view');
		}
		$data= array('title'=> 'Report', 'subtitle'=>'','chalan_no'=>$cid);	
		$data['items'] = $this->db->where('chalan_no',$cid)->get($table);
		$this->load->view('report/view_chalan_details',$data);


	}

	function material_chalan_table(){
		$data = array();
		$chalans= $this->db->get('raw_material_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_material_chalan/'.$val['id'].'"  class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				$supplier = get_user_info_by_id($val['supplier_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					$val['totweight'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}




	function finish_goods_chalan_table(){
		$data = array();
		$chalans= $this->db->get('product_stock_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_finish_goods_chalan/'.$val['id'].'"  class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				
				$data[$key] = array(
					
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],					
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function view_finish_goods_chalan($id){
		if($id==''){
			redirect('view');
		}
		$data= array('title'=> 'workstationone', 'subtitle'=>'finishGoods','chalan_no'=>$id);	
		$data['chalan'] = $this->db->where('id',$id)->get('product_stock_chalan')->row_array();
		$data['items'] = $this->db->where('stock_chalan_id',$id)->get('product_stock')->result_array();
		$this->load->view('report/finish_goods_chalan_view',$data);

	}


	function update_finish_goods_chalan(){
		//echo '<pre>';
		//print_r($_POST);
		$chalan_id = $this->input->post('chalan_id');
		$price =$this->input->post('price');
		$qty = $this->input->post('qty');
		$product_stock_ids = $this->input->post('type_id');
		$total = 0;
		for($i=0;$i<count($product_stock_ids);$i++){

			$subtotal = $qty[$i] * $price[$i];
			$update_array = array(
				'price'=>$price[$i],
				'qty'=>$qty[$i],
				'subtotal'=>$subtotal
				);

			$this->db->where('id',$product_stock_ids[$i]);
			$this->db->update('product_stock',$update_array);
			$total += $subtotal;
	}


		$this->db->where('id',$chalan_id);
		$this->db->update('product_stock_chalan',array('total'=> $total,'status'=>'verified','updated_at'=>date('Y-m-d')));

		redirect('report/finish_goods_chalans');
	}














	function sales_chalan_table(){
		$data = array();
		$chalans= $this->db->order_by('id','DESC')->get('product_sale_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_sales_chalan/'.$val['id'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				$buyer = get_user_info_by_id($val['buyer_id']);
				$operator = get_user_info_by_id($val['operator_id']);

				$data[$key] = array(					
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($buyer['full_name']).'<br/>'.$buyer['mobile'],
					$val['total'],
					$val['totweight'],
					ucfirst($operator['username']),
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));	

	}

	function view_sales_chalan($id){
		if($id==''){
			redirect('view');
		}
		$data= array('title'=> 'workstationtwo', 'subtitle'=>'Sales');	
		$data['chalan'] = $this->db->where('id',$id)->get('product_sale_chalan')->row_array();
		$data['items'] = $this->db->where('chalan_id',$id)->get('product_sell')->result_array();

		$this->load->view('report/view_sales_chalan',$data);

	}

	function accessories_chalan_table(){
		$data = array();
		$chalans= $this->db->get('accessories_receive_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_accessories_chalan/'.$val['chalan_no'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}
				$supplier = get_user_info_by_id($val['supplier_id']);

				$data[$key] = array(
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],
					ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));

	}

	function view_accessories_chalan($cid){
		if($cid==''){
			redirect('view');
		}
		$data= array('title'=> 'view_accessories_chalan', 'subtitle'=>'','chalan_no'=>$cid);	
		$data['items'] = $this->db->where('chalan_no',$cid)->get('accessories_receive');
		$this->load->view('report/view_accessories_chalan',$data);

	}

	function transfer_chalan_table(){
		$data = array();
		$chalans= $this->db->get('product_transfer_chalan')->result_array();
		if(!empty($chalans)){
			foreach($chalans as $key=>$val){
				$action='<a href="'.base_url().'view/view_transfer_chalan/'.$val['chalan_no'].'" target="_blank" class="btn btn-info btn-sm" >View</a> ';
				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" data-chalanno="'.$val['chalan_no'].'" >Verify</span>';
				}				

				$data[$key] = array(
					ucwords(get_department_name($val['from_dep'])),
					ucwords(get_department_name($val['to_dep'])),
					date('d-m-Y', strtotime($val['chalan_date'])),
					$val['chalan_no'],					
					$val['total'],
					ucfirst($val['status']),
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));


	}

	function view_transfer_chalan($cid){
		if($cid==''){
			redirect('view');
		}
		$data= array('title'=> 'view_transfer_chalan', 'subtitle'=>'','chalan_no'=>$cid);	
		$data['items'] = $this->db->where('chalan_no',$cid)->get('product_transfer');
		$this->load->view('report/view_transfer_chalan',$data);

	}


	function customer_payment_list(){
		$data= array('title'=> 'People', 'subtitle'=>'buyerpayment');
		$this->load->view('buyer/customer_payment_list', $data);
	}

	function customer_paymets_table(){
		$data=array();
		$accounts= $this->db->where('purpose','payment')->or_where('purpose','old')->order_by('id','DESC')->get('account')->result_array();
		if(!empty($accounts)){
			foreach($accounts as $key=>$val){
				$action='';
				$customer = get_user_info_by_id($val['user_id']);
				$operator = get_user_info_by_id($val['operator_id']);
				$buyer = ucfirst($customer['full_name']);

				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-info btn-sm verify_btn" data-id="'.$val['id'].'" data-buyer="'.$buyer.'" >Verify</span> <span class="ml-1 btn btn-default btn-xs delete_btn" data-id="'.$val['id'].'" data-buyer="'.$buyer.'" ><i class="fa fa-trash"></i></span>';

				}else{
					$action='<i class="fa fa-check" aria-hidden="true"></i> Verified';
				}
				$details = $val['type'];
				if($val['details']!=null){
					$info = json_decode($val['details']);
					$details = '<span class="blue" title="'.$info->bank.'/'.$info->cheque.'/'.date('d-m-Y',strtotime($info->cdate)).'">'.$val['type'].'</span>';
				}
				
				$data[$key] = array(
				'<a href="'.base_url().'view/buyer_ladger/'.$customer['id'].'">'.$buyer.'</a>',
					date('d-m-Y', strtotime($val['payment_date'])),
					$details,
					$val['purpose'],							
					$val['debit'],
					$val['credit'],
					$operator['username'],
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}



	function supplier_payment_list(){
		$data= array('title'=> 'People', 'subtitle'=>'supplierpayment');
		$this->load->view('supplier/supplier_payment_list', $data);
	}

	function supplier_paymets_table(){
		$data=array();
		$accounts= $this->db->order_by('id','DESC')->get('account_supplier')->result_array();
		if(!empty($accounts)){
			foreach($accounts as $key=>$val){
				$action='';
				$customer = get_user_info_by_id($val['user_id']);
				$material = '';
				if($val['material'] != '0'){
					$material = get_material_type_name($val['material']);
					$material .= '<br/>'.$val['weight'];
				}
				$supplier = ucfirst($customer['full_name']);

				if(strcmp($val['status'],'unverified')===0){
					$action .= '<span class="btn btn-info btn-sm verify_btn" data-id="'.$val['id'].'" data-buyer="'.$supplier.'" >Verify</span> <span class="ml-1 btn btn-default btn-xs delete_btn" data-id="'.$val['id'].'" data-buyer="'.$supplier.'" ><i class="fa fa-trash"></i></span>';

				}else{
					$action='<i class="fa fa-check" aria-hidden="true"></i> Verified';
				}
				$details = $val['type'];
				if($val['details']!=null){
					$info = json_decode($val['details']);
					$details = '<span class="blue" title="'.$info->bank.'/'.$info->cheque.'/'.date('d-m-Y',strtotime($info->cdate)).'">'.$val['type'].'</span>';
				}
				
				$data[$key] = array(
				'<a href="'.base_url().'view/buyer_ladger/'.$customer['id'].'">'.$supplier.'</a>',
					date('d-m-Y', strtotime($val['payment_date'])),
					$details,
					$val['purpose'],							
					$val['debit'],
					$val['credit'],
					$material,
					$action
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function employee_account(){
            $data= array('title'=> 'Account', 'subtitle'=>'employee','error'=>'');
             $data['dep'] = $this->model->getData('department');                                              
             $this->load->view('employee/account_view', $data);
                
     }  


	function recycle_raw_material(){
		$data= array('title'=> 'Material', 'subtitle'=>'recycle','error'=>'');             

		$this->load->view('raw_material/recycle_view', $data);
	}

	function getRecycle(){
		$data = array();
		$recycle = $this->db->get('recycle')->result_array();
		if(!empty($recycle)){
			foreach($recycle as $key=>$val){
				
				$data[$key] = array(
					date('d-m-Y', strtotime($val['created_at'])),
					get_material_type_name($val['material_type_id']),
					$val['recycle_qty'].' '.$val['unit'],
					$val['from_waste_qty'].' '.$val['unit'],
					$val['final_waste_qty'].' '.$val['unit'],
					$val['uncountable_qty'].' '.$val['unit'],

					'<a class="action badge badge-danger" href="'.base_url().'delete/recycle/'.$val['id'].'">Delete</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	
	function getConsume(){
		$data = array();
		$consume = $this->db->get('material_consume')->result_array();
		if(!empty($consume)){
			foreach($consume as $key=>$val){
				
				$material_type = get_material_type_name($val['material_type_id']);
				$data[$key] = array(
					date('d-m-Y', strtotime($val['created_at'])),

					$material_type,
					$val['qty'].' '.$val['unit'],
										
					'<a class="action badge badge-danger" href="'.base_url().'delete/consume/'.$val['id'].'">Delete</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function raw_material(){
		$data= array('title'=> 'Raw Material', 'subtitle'=>'');

		$this->load->view('raw_material/raw_material_table', $data);
	}


	function spare_parts(){
			$data= array('title'=> 'Raw Material', 'subtitle'=>'');

		$this->load->view('parts/spare_parts_table', $data);

	}

	function get_all_parts_name(){
			$type = $this->model->getData('spare_parts');
		if(!empty($type)){
			foreach($type as $key=>$val){
				
				$data[$key] = array(
					$val['name'],
					
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>')
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));

	}

	function get_all_material(){
		$data = array();
		$material = $this->model->getMaterialData();
		if(!empty($material)){
			foreach($material as $key=>$val){
				$user = get_user_info_by_id($val['supplier_id']);
				$material_type = get_material_type_name($val['type_id']);
				$data[$key] = array(
					date('d-m-Y', strtotime($val['create_date'])),
					'<a href="#" alt="'.$val['description'].'">'.$val['name'].'</a>',					
					$material_type,
					$user['full_name'],
					$val['quantity'],
					$val['unit'],
					$val['unit_price'],
					$val['sub_total'],
					
					'<a class="action badge badge-danger" href="'.base_url().'delete/raw_material/'.$val['raw_material_id'].'">Delete</a> <a class="action badge badge-primary" href="'.base_url().'edit/raw_material/'.$val['raw_material_id'].'">Edit</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function branch_list(){
		$data= array('title'=> 'Setting', 'subtitle'=>'branch');

		$this->load->view('setting/branch_list', $data);
	}


	function get_all_Branch(){
		$data = array();
		$type = $this->model->getData('branch');
		if(!empty($type)){
			foreach($type as $key=>$val){
				
				$data[$key] = array(
					$val['name'],
					
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>')
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function expense_type_list(){
		$data= array('title'=> 'Settings', 'subtitle'=>'expense_type');

		$this->load->view('setting/expense_list_form', $data);
	}

	function get_all_expense_type(){
		$data = array();
		$type = $this->model->getData('expense_type');
		if(!empty($type)){
			foreach($type as $key=>$val){
				
				$data[$key] = array(
					$val['name'],
					
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>')
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function department_list(){
		$data= array('title'=> 'Setting', 'subtitle'=>'department');

		$this->load->view('setting/department_form', $data);
	}

	function get_all_department(){
		$data = array();
		$type = $this->model->getData('department');
		if(!empty($type)){
			foreach($type as $key=>$val){
				
				$data[$key] = array(
					$val['department_name'],
					
					(($val['department_status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>')
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}
	function raw_material_type(){
		$data= array('title'=> 'Settings', 'subtitle'=>'RawMaterial');

		$this->load->view('raw_material/raw_material_type_table', $data);
	}

	function get_all_material_type(){
		$data = array();
		$type = $this->model->getData('raw_material_type');
		if(!empty($type)){
			foreach($type as $key=>$val){
				
				$data[$key] = array(
					$val['type_name'],
					$val['type_desc'],
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>')
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));

	}

	

	function accessories_name(){
		$data= array('title'=> 'accessories', 'subtitle'=>'Name','error'=>'');

		$this->load->view('setting/accessories_name', $data);
	}

	function get_all_accessories_name(){
		$data = array();
		$accessories = $this->model->getData('accessories');
		if(!empty($accessories)){
			$i=1;
			$str = "Are you sure ? ";
			
			foreach($accessories as $key=>$val){
			$action="<a href= '".base_url()."delete/delete_accessories_name/".$val['id']."' onClick=' return confirm();'  class='btn btn-default btn-sm'>Delete</a>";				
				$data[$key] = array(
					$i,
					$val['name'],					
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>'),
					$action
				);
				$i++;
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));

	}
	function get_all_accessories_stock(){
		$data = array();
		$accessories = $this->model->getData('accessories_stock');
		if(!empty($accessories)){
			$i=1;
			$str = "Are you sure ? ";
			
			foreach($accessories as $key=>$val){
			$action="<a href= '".base_url()."delete/delete_accessories_stock/".$val['id']."' onClick=' return confirm();'  class='btn btn-default btn-sm'>Delete</a>";				
				$data[$key] = array(
					$i,
					get_accessories_name($val['accessories_id']),
					$val['add_qty'],
					$val['remove_qty'],
					date('d-m-Y', strtotime($val['created_at'])),
					$action
				);
				$i++;
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));

	}

	function product(){
		$data= array('title'=> 'Settings', 'subtitle'=>'product');

		$this->load->view('product/product_list', $data);
	}

	function get_product(){
		$data = array();
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('product_type', 'product_type.product_type_id = product.product_type_id');
		$query = $this->db->get();

		if(!empty($query->result_array())){
			foreach($query->result_array() as $key=>$val){
				
				$data[$key] = array(
					$val['type_name'],
					$val['product_name'],
					$val['weight'].' '.$val['unit'],
					(($val['status'] == '1') ? '<span class="badge" data="'.$val['product_type_id'].'">Active</span>':'<span class="badge" data="'.$val['product_type_id'].'">Inactive</span>'),
					'Edit'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));

	}

	function product_type(){
		$data= array('title'=> 'Settings', 'subtitle'=>'ProductType');

		$this->load->view('product/product_type', $data);
	}

	function get_all_product_type(){
			$data = array();
		$type = $this->model->getData('product_type');
		if(!empty($type)){
			foreach($type as $key=>$val){
				
				$data[$key] = array(
					$val['type_name'],
					$val['description'],
					(($val['status'] == '1') ? '<span class="badge" data="'.$val['product_type_id'].'">Active</span>':'<span class="badge" data="'.$val['product_type_id'].'">Inactive</span>')
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));

	}

	function get_employee_by_department(){
		$dept_id = $this->input->post('dept_id');

		$str='<option value="">Select Employee</option>';
		$this->db->where('department_id', $dept_id);
		$this->db->where('salary_type_id', 2);
		$sql = $this->db->get('users');
		if(!empty($sql->result_array())){
			foreach($sql->result_array() as $row){
				$str .='<option value="'.$row['id'].'">'.$row['full_name'].'</option>';
			}
		}
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('str'=>$str));
	}

	function get_product_by_department(){
		$dept_id = $this->input->post('dept_id');

		$str='<option value="">Select Product</option>';
		$this->db->where('department_id', $dept_id);
		$sql = $this->db->get('product_type');
		if(!empty($sql->result_array())){
			foreach($sql->result_array() as $row){
				$str .='<option value="'.$row['product_type_id'].'">'.$row['type_name'].'</option>';
			}
		}
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('str'=>$str));
	}

	function get_emloyee_by_product_type(){
		$id = $this->input->post('pid');

		$str='<option value="">Select Employee</option>';
		$this->db->where('product_type_id', $id);
		$sql = $this->db->get('employee');
		if(!empty($sql->result_array())){
			foreach($sql->result_array() as $row){
				$user = get_user_info_by_id($row['user_id']);
				$str .='<option value="'.$user['id'].'">'.$user['full_name'].'</option>';
			}
		}
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('str'=>$str));
	}

	function get_all_product(){
		$data = array();
		$type = $this->model->getProductData();
		if(!empty($type)){
			foreach($type as $key=>$val){

				//$user = get_user_info_by_id($val['employee_id']);
				$product = get_product_type_name($val['product_type_id']);
				$data[$key] = array(
					date('d-m-Y H:i a', strtotime($val['making_time'])),
					$product,
					//$user['full_name'],
					$val['quantity'],
					$val['unit'],
					'<a class="badge badge-danger" href="'.base_url().'delete/ready_product/'.$val['product_type_id'].'">
					Delete</a> <a class="action badge badge-success" href="'.base_url().'edit/ready_product/'.$val['product_type_id'].'">
					Edit</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function sell_product(){
		$data= array('title'=> 'Product', 'subtitle'=>'sell');

		$this->load->view('product/sell_product', $data);
	}


	function ready_product(){
		$data= array('title'=> 'Product', 'subtitle'=>'');

		$this->load->view('product/ready_product', $data);
	}

	function staff_list(){
		$this->session->set_userdata('prev_page', 'staff_list');
		$data= array('title'=> 'People', 'subtitle'=>'staff');

		$this->load->view('staff/staff_list', $data);

	}

	function supplier_list(){
		
		$this->session->set_userdata('prev_page', 'supplier_list');	
		$data= array('title'=> 'People', 'subtitle'=>'supplier');

		$this->load->view('supplier/supplier_list', $data);

	}
	function customer_list(){
		$this->session->set_userdata('prev_page', 'customer_list');
		$data= array('title'=> 'People', 'subtitle'=>'buyer');

		$this->load->view('buyer/buyer_list', $data);

	}

	function employee_list(){
		$this->session->set_userdata('prev_page', 'employee_list');
		$data= array('title'=> 'People', 'subtitle'=>'employee');

		$this->load->view('employee/employee_list', $data);
	}

	


	function employee_salary_done($employee_id, $salary_type_id){
			$result = FALSE;
			switch($salary_type_id){
				case 1:
							$data = $this->model->getData('fixed_salary', 'user_id', $employee_id);
							if(!empty($data)){
								$result = TRUE;
							}
				break;
				case 2:
							$data = $this->model->getData('hour_salary', 'user_id', $employee_id);
							if(!empty($data)){
								$result = TRUE;
							}

				break;
				case 3:
							$data = $this->model->getData('employee', 'user_id', $employee_id);
							if(!empty($data)){
								$result = TRUE;
							}

				break;
				default:
					$result = FALSE;
				break;
			}

			return $result;
	}

	function get_all_employee(){
		$data = array();
		$type = $this->model->getEmployeeData();
		if(!empty($type)){
			foreach($type as $key=>$val){

				if($this->employee_salary_done($val['id'] , $val['salary_type_id'])){
					$btns='<a class="action badge badge-success" href="'.base_url().'edit/people/'.$val['id'].'">
					<span class="glyphicon glyphicon-edit"></span>Edit</a>';
				}else{
					$btns = '<a class="badge badge-primary" href="'.base_url().'new_add/employee_product/'.$val['id'].'">
					<span class="action glyphicon glyphicon-ok"></span>Assign</a>  <a class="action badge badge-success" href="'.base_url().'edit/people/'.$val['id'].'">
					<span class="glyphicon glyphicon-edit"></span>Edit</a>';
				}

				$product_name = '';
				$product_type = get_all_product_type_by_user_id($val['id']);
				if(!empty($product_type)){
					foreach($product_type as $type){
						$id = $type['product_type_id'];
					$product_name .= '<a href="javascript: void(0)" alt="'.$type['salary_per_unit_product'].'">'.get_product_type_name($id).'</a>, ';
					}
				}	

				$department = get_department_name($val['department_id']);
				$data[$key] = array(
					date( 'd-m-Y', strtotime($val['created_at'])),
					$val['full_name'],				
					$val['mobile'],
					$department,
					$product_name,
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>'),
					$btns
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function buyer_ladger($id){

		$data= array('title'=> 'People', 'subtitle'=>'buyer');
		$data['accounts'] = $this->db->where('user_id',$id)->where('status','verified')->order_by('payment_date','ASC')->get('account')->result_array();
		$data['buyer'] = get_user_info_by_id($id);
		$this->load->view('buyer/buyer_ladger', $data);
	}


	function get_all_buyer(){
		$data = array();
		$type = $this->model->getData('users', 'role','buyer');
		if(!empty($type)){
			foreach($type as $key=>$val){

				$sql = "SELECT (SUM(credit)-SUM(debit)) as bal FROM `account` WHERE `status` = 'verified' AND `user_id` =".$val['id'];
				$info = $this->db->query($sql)->row_array();
				if($info['bal'] > 0){
					$balance = "<span class=''>".$info['bal']."</span>";
				}else{ $balance = "<span class='focustd text-danger'>".$info['bal']."</span>";}
					
				$data[$key] = array(
					date( 'd-m-Y', strtotime($val['created_at'])),
					'<a href="'.base_url().'view/buyer_ladger/'.$val['id'].'">'.$val['full_name'].'</a>',				
					$val['mobile'],
					$val['address'],
					$balance,
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>'),
					'<a class="action badge badge-success" href="'.base_url().'edit/people/'.$val['id'].'">
					<span class="glyphicon glyphicon-edit"></span>Edit</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function get_all_supplier(){
		$data = array();
		$type = $this->model->getData('users', 'role','supplier');
		if(!empty($type)){
			foreach($type as $key=>$val){

				$sql = "SELECT (SUM(credit)-SUM(debit)) as bal FROM `account_supplier` WHERE `status` = 'verified' AND `user_id` =".$val['id'];
				$info = $this->db->query($sql)->row_array();
				if($info['bal'] > 0){
					$balance = "<span class=''>".$info['bal']."</span>";
				}else{ $balance = "<span class='focustd text-danger'>".$info['bal']."</span>";}
					
				$data[$key] = array(
					date( 'd-m-Y', strtotime($val['created_at'])),
					'<a href="'.base_url().'view/supplier_ladger/'.$val['id'].'">'.$val['full_name'].'</a>',				
					$val['mobile'],
					$val['address'],
					$balance,
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>'),
					'<a class="action badge badge-success" href="'.base_url().'edit/people/'.$val['id'].'">
					<span class="glyphicon glyphicon-edit"></span>Edit</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}
	function supplier_ladger($id){

		$data= array('title'=> 'People', 'subtitle'=>'supplier');
		$data['accounts'] = $this->db->where('user_id',$id)->where('status','verified')->order_by('payment_date','ASC')->get('account_supplier')->result_array();
		$data['buyer'] = get_user_info_by_id($id);
		$this->load->view('supplier/supplier_ladger', $data);
	}

	function get_all_staff(){
		$data = array();		
		$type = $this->model->getData('users', 'role','staff');
		
		if(!empty($type)){
			foreach($type as $key=>$val){
					
				$data[$key] = array(
					date( 'd-m-Y', strtotime($val['created_at'])),
					$val['full_name'],				
					$val['mobile'],
					$val['address'],
					(($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>'),
					(($val['username'] != '0') ? '<span class="badge">SET</span>':'<span class="badge">NOT SET</span>'),
					
					'<a class="action badge badge-success" href="'.base_url().'edit/people/'.$val['id'].'">
					<span class="glyphicon glyphicon-edit"></span>Edit</a> <a class="action badge badge-info" href="'.base_url().'new_add/staff_info_add/'.$val['id'].'">
					<span class="glyphicon glyphicon-star"></span>Access info</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function reject(){
		$data= array('title'=> 'Asset', 'subtitle'=>'');
		$this->load->view('product/reject', $data);
	}

	function getAllRejects(){
			$data = array();		
		$type = $this->model->getData('reject_product');
		
		if(!empty($type)){
			foreach($type as $key=>$val){
					$user = get_user_info_by_id($val['buyer_id']);
					$product = get_product_type_name($val['product_id']);
				$data[$key] = array(
					date( 'd-m-Y', strtotime($val['created_at'])),
					$user['full_name'],
					$product,				
					$val['qty'],
					$val['note'],				
					' <a class="action btn btn-info" href="#">
					<span class="glyphicon glyphicon-star"></span>Review</a>'
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

	function asset(){
		$data= array('title'=> 'Settings', 'subtitle'=>'Asset');
		$this->load->view('company/asset', $data);
	}

	function asset_history($id=''){
		$data= array('title'=> 'Settings', 'subtitle'=>'Asset');
		if($id==''){
			redirect('view/asset', 'refresh');
		}else{
			$data['id'] = $id;
			$this->load->view('company/asset_history', $data);
		}
	}

	function getAllAssets(){
		$data = array();		
		$type = $this->model->getData('assets');
		
		if(!empty($type)){
			foreach($type as $key=>$val){
					
				$data[$key] = array(
					date( 'd-m-Y', strtotime($val['created_at'])),
					$val['name'],				
					$val['qty'],
					$val['cost'],
					$val['description'],					
					' <a class="action badge badge-info" href="'.base_url().'delete/assets/'.$val['id'].'">
					<span class="glyphicon glyphicon-star"></span>Delete</a>  <a class="action badge badge-success" href="'.base_url().'edit/assets/'.$val['id'].'">
					<i class="fa fa-reply"></i>Edit</a> <a class="action badge badge-primary" href="'.base_url().'view/asset_history/'.$val['id'].'">
					history</a> '
				);
			}
		}

		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('data'=>$data));
	}

function getWaste(){
      $data = array();
    $waste = $this->db->order_by('id','desc')->get('waste')->result_array();
    if(!empty($waste)){
      foreach($waste as $key=>$val){
      	
      	$action='';
		if(strcmp($val['status'],'unverified')===0){
			$action .= '<span class="btn btn-success btn-sm verify_btn" data-id="'.$val['id'].'" >Verify</span><span class="ml-1 btn btn-default btn-xs delete_btn" data-id="'.$val['id'].'"  ><i class="fa fa-trash"></i></span>';
		}else{
			$action .='Verified'; 
		}
        
        $data[$key] = array(
          date('d-m-Y', strtotime($val['created_at'])),
          $val['qty'].' '.$val['unit'],
          $action      );
      }
    }

    header('Content-Type: application/json;charset=utf-8');
    echo json_encode(array('data'=>$data));
  }

//end 
}
