<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {	

	public function __construct()

       {

            parent::__construct();

            $user = $this->session->userdata('user_info');
            if($user['user_id']!= 1 || $user['is_login'] != 1 || $user['role'] !='admin'){
            //if($user['is_login'] != 1){
                $this->session->set_flashdata("alert", "You Must Login With Valid Username/Password! ('~') ");
                redirect('authentication/');
            }
             $this->load->model('common_model', 'model', true);                    

       }

    public function delete_accessories_stock($id){
    	$this->db->where('id', $id)->delete('accessories_stock');
 		 $this->session->set_flashdata(array('alert'=>'Deleted  ! ', 'alert_type'=>'alert alert-warning'));
    	redirect('new_add/accessories_add_orremove');
    }   
    public function delete_accessories_name($id){

    	$this->db->where('id', $id)->delete('accessories');
 		 $this->session->set_flashdata(array('alert'=>'Deleted  ! ', 'alert_type'=>'alert alert-warning'));
    	redirect('view/accessories_name');
    }   

     public function people_delete_form(){
     	 $this->load->library('form_validation');		
		$this->form_validation->set_rules('people_id', 'Select People ', 'required|trim');
     	$this->form_validation->set_rules('type', 'Select Buyer or Supplier', 'required|trim');
     	$this->form_validation->set_rules('info', 'Type of Delete', 'required|trim');

      if ($this->form_validation->run() == FALSE)
      	{
      		$data= array('title'=> 'People', 'subtitle'=>'delete','error'=>validation_errors());
      		$this->load->view('setting/people_delete_form', $data);
      	}else{
      		
      		//print_r($_POST);      		
      		$people_id = $this->input->post('people_id');
      		$type= $this->input->post('type');
      		$info = $this->input->post('info');
      		$str = '';
      		if(strcmp($type,'buyer')===0){
      			//del sale  + chalan + account
      			if(strcmp($info,'account')===0){
      				$this->db->where('user_id', $people_id)->delete('account');
					$str .= ' Account, ladger ';
      			}else{

	      			$chalans = $this->db->where('buyer_id', $people_id)->get('product_sale_chalan');
	      			if($chalans->num_rows()>0){
	      				foreach($chalans->result_array() as $chalan){
	      					$this->db->where('chalan_id', $chalan['id'])->delete('product_sell');
	      				}
	      			}
					$this->db->where('buyer_id', $people_i)->delete('product_sale_chalan');
					$this->db->where('user_id', $people_id)->delete('account');
					$str .= 'Buyer Chalan, Account, ladger ';
				}
      		}else{
      			//supplier , so del raw material + chalan + account
      			if(strcmp($info,'account')===0){
      				$this->db->where('user_id', $people_id)->delete('account_supplier');
					$str .= '  Supplier Account, ladger ';
      			}else{
					$chalans = $this->db->where('supplier_id', $people_id)->get('raw_material_chalan');
	      			if($chalans->num_rows()>0){
	      				foreach($chalans->result_array() as $chalan){
	      					$this->db->where('material_chalan_id', $chalan['id'])->delete('raw_material');
	      				}
	      			}
	      			$this->db->where('supplier_id', $people_id)->delete('raw_material_chalan');
					$this->db->where('user_id', $people_id)->delete('account_supplier');
					$str .= 'Supplier Chalan, Account, ladger ';
				}
      		}
      		

      		if(strcmp($info,'all')===0){
      			$this->db->where('id', $people_id)->delete('users');
      			$str .= 'and  Information';
      		}

      		$str .= ' Deleted ! ';
      		$this->session->set_flashdata(array('alert'=>$str, 'alert_type'=>'alert alert-success'));

      		redirect('delete/people_delete_form');
      	}	

	}

	public function get_people_with_type(){

  //print_r($_POST);
  $type_id = $this->input->post('type_id');
  $str ='';
  if($type_id!=''){
      $sql = $this->db->where('role',$type_id)->order_by('full_name', 'ASC')->get('users');
      if($sql->num_rows() > 0){
        foreach($sql->result_array() as $people){
          $str .='<option value="'.$people['id'].'">'.$people['full_name'].'</option>';
        }
      }else{
        $str .= '<option valur="0">No '.$type_id.' Found ! </option>';
      }
  }else{
    $str .= '<option valur="0">Problem with Select People</option>';
  }

  echo $str;
}


public function delete_waste(){
	$id = $this->input->post('waste_id');
		$this->db->where('id',$id)->delete('waste');
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>'Waste Deleted ! '));
}

    public function delete_buyer_payments(){
		$id = $this->input->post('payment_id');
		$this->db->where('id',$id)->delete('account');
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>'Payment Was Deleted ! '));
	}
	public function delete_supplier_payments(){
		$id = $this->input->post('payment_id');
		$this->db->where('id',$id)->delete('account_supplier');
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode(array('rs'=>1,'msg'=>'Payment Was Deleted ! '));
	}



    public function delete_sale_chalan($id){
    	$str='';
		$chalan = $this->db->where('id', $id)->get('product_sale_chalan')->row_array();
		if($chalan){
			//delete Chalan
			$this->db->where('id', $id);
			if($this->db->delete('product_sale_chalan')){
				$str .=' Chalan Deleted ! ';				
				//delete product sell
				$this->db->where('chalan_id', $id);
				$this->db->delete('product_sell');
				$str .= 'Product Sale Deleted ! ';
				//debit/credit delete
				$this->db->where('chalan_id',$id)->where('chalan_no', $chalan['chalan_no'])->where('purpose','buy')->where('user_id',$chalan['buyer_id']);					
				$this->db->delete('account');
				$str .= 'Buyer Debit Deleted ( if any ) ! ';

			}


		}else{
			$str .= 'Chalan Not Found ! ';
		}
		
		$this->session->set_flashdata(array('alert'=>$str, 'alert_type'=>'alert alert-warning'));
		redirect('report/sale_chalans');
		}

	public function delete_raw_material_chalans($id){
			$str = '';
			
			$this->db->where('id', $id);
			$chalan = $this->db->get('raw_material_chalan')->row_array();
			if($chalan){
				//delete Chalan
				$this->db->where('id', $id);
				if($this->db->delete('raw_material_chalan')){
					$str .= 'Chalan Deleted ! ';
					//material delete
					$this->db->where('material_chalan_id', $id);
					$this->db->delete('raw_material');
					$str .= 'Material Deleted !';
					//debit/credit delete
					$this->db->where('chalan_id',$id)->where('chalan_no', $chalan['chalan_no'])->where('purpose','sale')->where('user_id',$chalan['supplier_id']);					
					$this->db->delete('account_supplier');
					$str .= 'Supplier Credit Deleted ( if any ) ! ';

				};				
			}else{
				$str .= 'Chalan Not Found !';
			}
			

			$this->session->set_flashdata(array('alert'=>$str, 'alert_type'=>'alert alert-warning'));
			redirect('report/material_receive_chalans');
		}

	public function delete_finish_goods_chalans($id){
			$this->db->where('stock_chalan_id', $id);
			$this->db->delete('product_stock');
			$this->db->where('id', $id);
			$this->db->delete('product_stock_chalan');
			$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-warning'));
			redirect('report/finish_goods_chalans');
		}

    public function assets($id){
       	$status = $this->model->delete('assets', 'id',$id);
		if($status){
				$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-success'));
		}else{
				$this->session->set_flashdata(array('alert'=>'Can not Delete ! ', 'alert_type'=>'alert alert-warning'));
		}
		redirect('view/asset');
       }

	public function product_type($id){
		$status = $this->model->delete('product_type', 'product_type_id',$id);
		if($status){
				$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-success'));
		}else{
				$this->session->set_flashdata(array('alert'=>'Can not Delete ! ', 'alert_type'=>'alert alert-warning'));
		}
		redirect('view/product_type');
	}

	function consume($id){
		$status = $this->model->delete('material_consume', 'id',$id);
		if($status){
				$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-success'));
		}else{
				$this->session->set_flashdata(array('alert'=>'Can not Delete ! ', 'alert_type'=>'alert alert-warning'));
		}
		redirect('new_add/raw_material_consume');
	}
	function waste($id){
		$status = $this->model->delete('waste', 'id',$id);
		if($status){
				$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-success'));
		}else{
				$this->session->set_flashdata(array('alert'=>'Can not Delete ! ', 'alert_type'=>'alert alert-warning'));
		}
		redirect('new_add/waste_material');
	}

	function recycle($id){
			$status = $this->model->delete('recycle', 'id',$id);
		if($status){
				$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-success'));
		}else{
				$this->session->set_flashdata(array('alert'=>'Can not Delete ! ', 'alert_type'=>'alert alert-warning'));
		}
		redirect('view/recycle_raw_material');	
	}

	public function raw_material_type($id){
		$status = $this->model->delete('raw_material_type', 'type_id',$id);
		if($status){
				$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-success'));
		}else{
				$this->session->set_flashdata(array('alert'=>'Can not Delete ! ', 'alert_type'=>'alert alert-warning'));
		}
		redirect('view/raw_material_type');
	}

	public function raw_material($id){
		$status = $this->model->delete('raw_material', 'raw_material_id',$id);
		if($status){
				$this->session->set_flashdata(array('alert'=>'Delete Successful ! ', 'alert_type'=>'alert alert-success'));
		}else{
				$this->session->set_flashdata(array('alert'=>'Can not Delete ! ', 'alert_type'=>'alert alert-warning'));
		}
		redirect('view/raw_material');
	}







}



