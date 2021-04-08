<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workstationtwo extends CI_Controller {	

	public function __construct()

       {

            parent::__construct();
           
            $user = $this->session->userdata('user_info');
            if($user['is_login'] != 1){
                $this->session->set_flashdata("alert", "You Must Login With Valid Username/Password ! ('~') ");
                redirect('authentication/');
            }
            
            $this->load->model('common_model', 'model', true);  
             $this->load->library('cart');
              $this->load->library('form_validation');
          
            $this->operator = $user['user_id'];                
       }

	public function index()	{
		$data= array('title'=> 'Dashboard', 'subtitle'=>'');
		$this->load->view('workstationtwo/dashboard', $data);	
	}


 


  function buyer_ladger($id){

    $data= array('title'=> 'People', 'subtitle'=>'buyer');
    $data['accounts'] = $this->db->where('user_id',$id)->where('status','verified')->order_by('payment_date','ASC')->get('account')->result_array();
    $data['buyer'] = get_user_info_by_id($id);
    $this->load->view('workstationtwo/buyer_ladger', $data);
  }  

  function buyer_table(){
    $data = array();
    $type = $this->model->getData('users', 'role','buyer');
    if(!empty($type)){
      foreach($type as $key=>$val){

        $sql = "SELECT (SUM(credit)-SUM(debit)) as bal FROM `account` WHERE `status`='verified' AND `user_id` =".$val['id'];
        $info = $this->db->query($sql)->row_array();
        if($info['bal'] > 0){
          $balance = "<span class=''>".$info['bal']."</span>";
        }else{ $balance = "<span class='focustd text-danger'>".$info['bal']."</span>";}
          
        $data[$key] = array(
          date( 'd-m-Y', strtotime($val['created_at'])),
          '<a href="'.base_url().'workstationtwo/buyer_ladger/'.$val['id'].'">'.$val['full_name'].'</a>',       
          $val['mobile'],
          $val['address'],
          $balance,
          (($val['status'] == '1') ? '<span class="badge">Active</span>':'<span class="badge">Inactive</span>')
        );
      }
    }

    header('Content-Type: application/json;charset=utf-8');
    echo json_encode(array('data'=>$data));
  }


  function sale_product(){
 		$data= array('title'=> 'Sale', 'subtitle'=>'','error'=>'');   
      $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');
     $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
      if ($this->form_validation->run() == FALSE)
      {
              $data['error'] = validation_errors();                      
              $data['product_type'] = $this->model->getData('product_type');                     
              $this->load->view('workstationtwo/product_sale_form', $data);
      }else{
         $quantity = $this->input->post('qty');
         $price = $this->input->post('price');;  
         $unit = $this->input->post('unit');
         $product_id =  $this->input->post('product_id');
        $product = get_product_info($product_id);
          $cdata = array(
                  'id'      => $product_id,
                  'qty'     => $quantity,
                  'price'   => $price,                           
                 'name'    => $product['product_name'],
                'options'=>array('unit'=>$unit,'weight'=>$product['weight'],'type_id'=>$product['product_type_id'])
          );
              
          $this->cart->insert($cdata);   
          redirect(current_url());
      }
   }

        function update_sale_cart(){
       		foreach($this->input->post() as $item){
                $data = array(
                        'rowid' => $item['rowid'],
                        'qty'   => $item['qty']
                );

                $this->cart->update($data);
            }
               
            redirect('workstationtwo/sale_product');
       }

function saleChalan(){
       		$data= array('title'=> 'Sale', 'subtitle'=>'','error'=>'');
          	$this->load->view('workstationtwo/sale_input', $data);
 }
 function getTotal($cartTotal,$additional,$sub){
    $total = $cartTotal + $additional;
    $total  = $total - $sub;
    return $total;
 }
function final_sale_chalan(){               
       
  $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
   $this->form_validation->set_rules('payment_type', 'Payment type', 'required|callback_type_check');
  $this->form_validation->set_rules('chalan_no', 'Chalan Number ', 'required|min_length[3]|is_unique[product_sale_chalan.chalan_no]', array('is_unique' => 'This %s  already Exists !'));
  if ($this->form_validation->run() == FALSE)
  {
    $data= array('title'=> '', 'subtitle'=>'','error'=> validation_errors());
    $this->load->view('workstationtwo/sale_input', $data);
  }
  else
  {  
     //$user = $this->session->userdata('user_info');
     $items =  $this->cart->contents();
     $insert_id = 0;
     if(!empty($items)){
        $payment =  floatval($this->input->post('payment'));       
        $payment_type =  $this->input->post('payment_type');
        $other_expense = floatval($this->input->post('other_expense'));
        $discount = floatval($this->input->post('discount'));
      
        $data['chalan_no'] = $this->input->post('chalan_no');                       
        $data['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
        $data['from_dep'] = 3;//replace if need 
        $data['buyer_id'] = $this->input->post('to_customer');
        $data['operator_id']=$this->operator;
        $data['other_expense'] = $other_expense;
        $data['total']= $this->getTotal(floatval($this->cart->total()),$other_expense,$discount);
        $data['discount'] = $discount;
        $this->db->insert('product_sale_chalan',$data);
        $chalan_id = $this->db->insert_id(); 
        $totWht=0;
            foreach($items as $item){
              $item_weight =  floatval($item['options']['weight']);
                if($item_weight > 0.00){
                  $weight =  $item['qty'] * $item_weight;
                }else{
                  $weight = $item['qty'] * 1;
                }

                $sale= array(
                    'chalan_id'=> $chalan_id,
                    'chalan_no'=>  $data['chalan_no'],                                  
                    'product_id'=> $item['id'],
                    'product_type_id'=>$item['options']['type_id'],
                    'department_id'=>$data['from_dep'],                    
                    'qty'=>$item['qty'],
                    'price'=>$item['price'],
                    'weight'=>$weight,
                    'unit'=>$item['options']['unit'],
                    'subtotal'=>$item['subtotal']                            
                );
               $this->model->save('product_sell', $sale);
                $totWht += $weight;
            }
        
            $account_data = array('user_id'=>$data['buyer_id'],'debit'=>$data['total'],'purpose'=>'buy','user_type'=>'buyer','chalan_id'=>$chalan_id,'chalan_no'=>$data['chalan_no'],'payment_date'=>$data['chalan_date'],'operator_id'=> $this->operator);

            $this->db->insert('account',$account_data);
            if(intval($payment) > 0){
              $payment_data = array('user_id'=>$data['buyer_id'],'credit'=>$payment,'purpose'=>'payment','user_type'=>'buyer','payment_date'=>$data['chalan_date'],'type'=>$payment_type,'operator_id'=>$this->operator);

                 if($payment_type =='cheque' || $payment_type =='TT'){
                        $payment_data['details'] = json_encode(array('bank'=>$this->input->post('bankname'),'cheque'=>$this->input->post('chequenumber'),'cdate'=>$this->input->post('checkdate')));
                  } 

                $this->db->insert('account',$payment_data);
              }
            
            $updateData = array('totweight' => $totWht );
            $this->db->where('id',$chalan_id);
            $this->db->update('product_sale_chalan', $updateData);
             
            $this->cart->destroy();	

            $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));      
                                  
           }else{
                $this->session->set_flashdata(array('alert'=>'No Item In Chalan  ! ', 'alert_type'=>'alert alert-danger'));
                
           }

           redirect('workstationtwo/sale_product');
        } 

}
public function type_check($str)
{
    if ($str == 'cheque')
    {
        if($this->input->post('bankname')=='' | $this->input->post('chequenumber')=='' |$this->input->post('checkdate')==''){    
            $this->form_validation->set_message('type_check', 'The {field} field Need Bank Name, Cheque Number , Date ! ');
            return FALSE;
          }else{ return TRUE;}
            
    }
    else
    {
            return TRUE;
    }
}
function add_payment(){

  
  $this->form_validation->set_rules('buyer_id', 'Select Buyer', 'required|trim');
   $this->form_validation->set_rules('payment', 'Payment', 'required|trim');
    $this->form_validation->set_rules('payment_type', 'Payment type', 'required|callback_type_check');
    $this->form_validation->set_rules('paymentdate', 'Date ', 'required|trim');
  if ($this->form_validation->run() == FALSE)
    {
        $data= array('title'=> 'Payment', 'subtitle'=>'','error'=>validation_errors());
        $this->load->view('workstationtwo/payment_form', $data); 
    }else{
        //print_r($_POST);
        $payment_type = $this->input->post('payment_type');
         $payment = array(
                    'payment_date'=>date('Y-m-d', strtotime($this->input->post('paymentdate'))),
                    'credit'=>$this->input->post('payment'),
                    'user_id'=>$this->input->post('buyer_id'),
                    'type'=>$payment_type,
                      'user_type'=>'buyer',
                    'purpose'=>'payment',
                    'operator_id'=>$this->operator 
                  );
         if($payment_type =='cheque' || $payment_type =='TT'){
          $payment['details'] = json_encode(array('bank'=>$this->input->post('bankname'),'cheque'=>$this->input->post('chequenumber'),'cdate'=>$this->input->post('checkdate')));
         } 

        $this->db->insert('account', $payment);        
        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
        redirect('workstationtwo/add_payment');
    }
    
}

     
   function asset(){
    $data= array('title'=> 'Asset', 'subtitle'=>'');
    $this->load->view('workstationtwo/asset', $data);
  }
   function assets(){
       
        
         $this->form_validation->set_rules('name', 'Assets Name ', 'required|trim');
          $this->form_validation->set_rules('cost', 'Cost', 'trim');
          $this->form_validation->set_rules('qty', 'quantity', 'required|trim|greater_than[0]|numeric');
          $this->form_validation->set_rules('desc', 'Description', 'trim');
           $this->form_validation->set_rules('date', 'Date', 'required|trim');

         if ($this->form_validation->run() == FALSE)
              {
                   $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-success'));
              }else{

                  $assets = array(
                    'name'=>$this->input->post('name'),
                    'cost'=>$this->input->post('cost'),
                    'qty'=>$this->input->post('qty'),
                    'description'=>$this->input->post('desc'),
                    'created_at'=>date('Y-m-d', strtotime($this->input->post('date')))
                  );

                  $this->db->insert('assets', $assets);
                   $this->session->set_flashdata(array('alert'=>'Assets Saved  ! ', 'alert_type'=>'alert alert-success'));

              }
           redirect('workstationtwo/asset','refresh');   
      }

  function asset_history($id=''){
    if($id==''){
      redirect('workstationtwo/asset', 'refresh');
    }else{
      $this->load->view('workstationtwo/asset_history', array('id'=> $id));
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
          '  <a class="action badge badge-primary" href="'.base_url().'workstationtwo/asset_history/'.$val['id'].'">
          history</a> '
        );
      }
    }

    header('Content-Type: application/json;charset=utf-8');
    echo json_encode(array('data'=>$data));
  }





   public function daily_expense(){
            $data= array('title'=> 'Expense', 'subtitle'=>'','error'=>'');              
             $data['type'] = $this->model->getData('expense_type');
             $data['branch'] = $this->model->getData('branch');
                $this->form_validation->set_rules('type_id', 'Type Name ', 'required');
                $this->form_validation->set_rules('branch_id', 'Branch Name ', 'required');
                $this->form_validation->set_rules('amount', 'Amount ', 'required|trim|numeric');
                $this->form_validation->set_rules('note', 'Note ', 'trim');                               

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                       
                }
                else
                {
                        $expense= array(
                            'expense_type_id'=>$this->input->post('type_id'),
                            'amount'=> $this->input->post('amount'),
                            'note'=>$this->input->post('note'),
                            'branch_id'=>$this->input->post('branch_id'),
                            'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
                            'operator_id'=>$this->operator
                        );

                        $this->model->save('expense', $expense);
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                       
              }
                 $this->load->view('workstationtwo/expense_form', $data);

     }  
       
     function getAllexpenses(){
          $data = array();
          $this->db->order_by('id','desc');
          $expense = $this->db->get('expense')->result_array();
          if(!empty($expense)){
            foreach($expense as $key=>$val){
             // $user = get_user_info_by_id($val['operator_id']);
              $expense_type = get_expense_type_name($val['expense_type_id']);

              $branch_name = get_branch_name($val['branch_id']);
              $data[$key] = array(
                date('d-m-Y', strtotime($val['date'])),
                $expense_type,
                $val['amount'],
                $branch_name,
                $val['note']

              );
            }
          }

          header('Content-Type: application/json;charset=utf-8');
          echo json_encode(array('data'=>$data));
     }



        function receive_finish_goods(){               
               $pdata= array('title'=> '', 'subtitle'=>'','error'=>'');             
                $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                        
               $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');                
              
                $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
                $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[goods_receive_chalan.chalan_no]', array('is_unique' => 'This %s  name already added !'));
                if ($this->form_validation->run() == FALSE)
                {
                         $pdata['error']= validation_errors(); 
                }
                else
                {  
                  
                   $quantity = $this->input->post('qty');
                   $price = 0;  
                  $product_id =  $this->input->post('product_id');
                   
                        $data['chalan_no'] = $this->input->post('chalan_no');                       
                        $data['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
                        $data['supplier_id'] = $this->input->post('supplier_id');
                       $data['department_id']=3;
                        $data['operator_id']=$this->operator;
                        $data['total']= 0; 
                        
                                $material= array(
                                    'chalan_no' =>  $data['chalan_no'],
                                    'chalan_date'=>date('Y-m-d',strtotime($this->input->post('chalan_date'))),
                                    'product_id'=> $product_id,
                                    'supplier_id'=>$data['supplier_id'], 
                                    'department_id'=>$data['department_id'],                                   
                                    'qty'=>$quantity,
                                    'price'=>0,
                                    'unit'=>$this->input->post('unit'),
                                    'subtotal'=>0                            
                                );
                        $insert_id =  $this->model->save('goods_receive', $material);
                          
                        $this->db->insert('goods_receive_chalan',$data);    
                        
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                         
                      
                } 

                 $pdata['product_type'] = $this->model->getData('product_type');  
                
                 $this->load->view('workstationtwo/chalan_input_receive', $pdata);

       }


 function report(){

        $data= array('title'=> 'Report', 'subtitle'=>'','error'=>'');
        $this->load->view('workstationtwo/report', $data);

    } 



 function receive_goods_chalan(){
      $data=array();
        $chalans= $this->db->get('goods_receive_chalan')->result_array();
          if(!empty($chalans)){
            $i=1;
            foreach($chalans as $key=>$val){
             
              $supplier = get_user_info_by_id($val['supplier_id']);

              $data[$key] = array(
                $i,
                date('d-m-Y', strtotime($val['chalan_date'])),
                $val['chalan_no'],
                ucfirst($supplier['full_name']).'<br/>'.$supplier['mobile'],               
                ucfirst($val['status'])            
              );
              $i++;
            }
          }

          header('Content-Type: application/json;charset=utf-8');
          echo json_encode(array('data'=>$data));
    } 


  function sales_chalan(){
      $data=array();
        $chalans= $this->db->get('product_sale_chalan')->result_array();
          if(!empty($chalans)){
            $i=1;
            foreach($chalans as $key=>$val){
             //echo 'NEW<br/>';
              $buyer = get_user_info_by_id($val['buyer_id']);
              if(empty($buyer)){
                $name = $val['buyer_id'];
              }else{

                 $info = ucfirst($buyer['full_name']).'<br/>'.$buyer['mobile'];
                 $name = '<a href="'.base_url().'workstationtwo/buyer_ladger/'.$val['buyer_id'].'">'.$info.'</a>';
              }
             // print_r($buyer);

              $action='<a class="btn btn-xs btn-default" href="'.base_url().'workstationtwo/viewSaleChalan/'.$val['id'].'" >View</a>';
              $data[$key] = array(
                $i,
                date('d-m-Y', strtotime($val['chalan_date'])),
                $val['chalan_no'],
                $name,
                $val['total'], 
                $val['totweight'],             
                ucfirst($val['status']),
                $action
              );
              $i++;
            }
          }
          header('Content-Type: application/json;charset=utf-8');
          echo json_encode(array('data'=>$data));
    }

    function buyer_payments(){
      $data=array();
        $payments= $this->db->where('credit >', 0)->where('purpose','payment')->where('user_type','buyer')->get('account')->result_array();
          if(!empty($payments)){
            $i=1;
            foreach($payments as $key=>$val){
             
              $buyer = get_user_info_by_id($val['user_id']);
              $name = ucfirst($buyer['full_name']).'<br/>'.$buyer['mobile'];
              $info = '<a href="'.base_url().'workstationtwo/buyer_ladger/'.$val['user_id'].'">'.$name.'</a>';
              $action='<a class="btn btn-xs btn-default" href="'.base_url().'workstationtwo/viewSaleChalan/'.$val['id'].'" >View</a>';
              $data[$key] = array(
                $i,
                date('d-m-Y', strtotime($val['create_at'])),                
                $info, 
                $val['type'],              
                number_format($val['credit'],2)
              );
              $i++;
            }
          }
          header('Content-Type: application/json;charset=utf-8');
          echo json_encode(array('data'=>$data));
    }

function viewSaleChalan($id){
  $data['title'] = 'Report';
  $data['chalan'] = $this->db->where('id',$id)->get('product_sale_chalan')->row_array();
  $data['items'] = $this->db->where('chalan_id',$id)->get('product_sell')->result_array();
  $this->load->view('chalans/product_sale_chalan', $data);
}


      










//end 
}
