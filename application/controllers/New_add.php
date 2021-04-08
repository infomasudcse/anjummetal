<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class New_Add extends CI_Controller {	

	public function __construct()

       {

            parent::__construct();  
             $user = $this->session->userdata('user_info');
            if($user['user_id']!= 1 || $user['is_login'] != 1 || $user['role'] !='admin'){
                $this->session->set_flashdata("alert", "You Must Login With Valid Username/Password! ('~') ");
                redirect('authentication/');
            }
            
             $this->load->model('common_model', 'model', true);                    
             $this->load->library('cart');
              $this->load->library('form_validation');
            $user =   $this->session->userdata('user_info');
            $this->operator = $user['user_id'];
       }

    protected $operator;   

      function reject(){
          $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');
          $this->form_validation->set_rules('buyer_id', 'Select Buyer',  'required|trim');
          $this->form_validation->set_rules('qty', 'quantity', 'required|trim|greater_than[0]|numeric');          
           $this->form_validation->set_rules('date', 'Date', 'required|trim');
            $this->form_validation->set_rules('desc', 'Description', 'trim');
         if ($this->form_validation->run() == FALSE)
              {
                   $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-success'));
              }else{

                  $reject = array(
                    'product_id'=>$this->input->post('product_id'),
                    'buyer_id'=>$this->input->post('buyer_id'),
                    'qty'=>$this->input->post('qty'),
                    'note'=>$this->input->post('desc'),
                    'created_at'=>date('Y-m-d', strtotime($this->input->post('date')))
                  );

                  $this->db->insert('reject_product', $reject);
                   $this->session->set_flashdata(array('alert'=>'Reject Product Saved For Review  ! ', 'alert_type'=>'alert alert-success'));

              }
           redirect('view/reject','refresh');  
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
           redirect('view/asset','refresh');   
      }




     function employee_payment(){
         
          $data= array('title'=> 'Employee', 'subtitle'=>'attendence','error'=>'');
             
          $this->form_validation->set_rules('dep', 'Department ', 'required|trim');
          $this->form_validation->set_rules('employee', 'Employee Name', 'required|trim|min_length[0]');
          $this->form_validation->set_rules('amount', 'Total Hour', 'required|trim|greater_than[0]|numeric');
          $this->form_validation->set_rules('type', 'Payment Type', 'required|trim');

         if ($this->form_validation->run() == FALSE)
              {

               $data['dep'] = $this->model->getData('department');                                              
               $this->load->view('employee/employee_payment', $data);
           }else{
                    $amount = $this->input->post('amount');
                    $employee_id = $this->input->post('employee'); 
                    $date = $this->input->post('date');
                      

                    $payment = array(
                               'user_id'=> $employee_id,
                               'credit'=>$amount,
                               'type'=>$this->input->post('type'),
                             
                               'operator_id'=>$this->operator                              
                             );
                     $this->model->save('employee_account', $payment);
                     
                       
                      $this->session->set_flashdata(array('alert'=>'Payment Saved  ! ', 'alert_type'=>'alert alert-success'));
                      redirect(current_url(), 'refresh');
                      
           }
     }

     function buyer_old_balance(){
      $this->form_validation->set_rules('buyer_id', 'Buyer Selection ', 'required|trim');
       $this->form_validation->set_rules('amount', 'Payment Amount ', 'required|trim|numeric');
       $this->form_validation->set_rules('paymentdate', 'Date ', 'required|trim');
      $this->form_validation->set_rules('type', 'Payment type', 'required|trim');
          if ($this->form_validation->run() == FALSE)
          {                                              
             
              $data= array('title'=> 'People', 'subtitle'=>'buyerpayment','error'=>validation_errors());

              $data['buyer']=$this->db->where('old_account',0)->where('role','buyer')->get('users')->result_array();

              $this->load->view('buyer/old_payment_form', $data);
          }else{


            $payment = array(
              'payment_date'=>date('Y-m-d', strtotime($this->input->post('paymentdate'))),           
              'user_id'=>$this->input->post('buyer_id'),              
                'user_type'=>'buyer',
              'purpose'=>'old',
              'operator_id'=>$this->operator 
            );
            if($this->input->post('type')=='debit'){
            $payment['debit'] = floatval($this->input->post('amount'));
           }else{
              $payment['credit'] = floatval($this->input->post('amount'));
           }
            $this->db->insert('account', $payment);
            $udata=array('old_account'=>1);
            $this->db->where('id',$this->input->post('buyer_id'));
            $this->db->update('users',$udata);

             $this->session->set_flashdata(array('alert'=>'Saved', 'alert_type'=>'alert alert-info'));
            redirect('view/customer_list');

          }

          
     }

      function supplier_old_balance(){
      $this->form_validation->set_rules('buyer_id', 'Buyer Selection ', 'required|trim');
       $this->form_validation->set_rules('amount', 'Payment Amount ', 'required|trim|numeric');
       $this->form_validation->set_rules('paymentdate', 'Date ', 'required|trim');
      $this->form_validation->set_rules('type', 'Payment type', 'required|trim');
          if ($this->form_validation->run() == FALSE)
          {                                              
             
              $data= array('title'=> 'People', 'subtitle'=>'supplierpayment','error'=>validation_errors());

              $data['buyer']=$this->db->where('old_account',0)->where('role','supplier')->get('users')->result_array();

              $this->load->view('supplier/old_payment_form', $data);
          }else{


            $payment = array(
              'payment_date'=>date('Y-m-d', strtotime($this->input->post('paymentdate'))),           
              'user_id'=>$this->input->post('buyer_id'),              
              'user_type'=>'supplier',
              'purpose'=>'old',
              'operator_id'=>$this->operator 
            );
            if($this->input->post('type')=='debit'){
            $payment['debit'] = floatval($this->input->post('amount'));
           }else{
              $payment['credit'] = floatval($this->input->post('amount'));
           }
            $this->db->insert('account_supplier', $payment);
            $udata=array('old_account'=>1);
            $this->db->where('id',$this->input->post('buyer_id'));
            $this->db->update('users',$udata);

             $this->session->set_flashdata(array('alert'=>'Saved', 'alert_type'=>'alert alert-info'));
            redirect('view/supplier_list');

          }

          
     }



     function customer_payment(){
       $data= array('title'=> 'People', 'subtitle'=>'buyerpayment','error'=>'');
          $this->load->view('buyer/payment_form', $data);
     }
     public function type_check($str)
    {
        if ($str == 'cheque'){
            if($this->input->post('bankname')=='' | $this->input->post('chequenumber')=='' |$this->input->post('checkdate')==''){    
                $this->form_validation->set_message('type_check', 'The {field} field Need Bank Name, Cheque Number , Date ! ');
                return FALSE;
              }else{ return TRUE;}                
        }else{
            return TRUE;
        }
    }

     function save_customer_payment(){
      
       $this->form_validation->set_rules('buyer_id', 'Buyer Selection ', 'required|trim');
       $this->form_validation->set_rules('amount', 'Payment Amount ', 'required|trim|numeric');
       $this->form_validation->set_rules('paymentdate', 'Date ', 'required|trim');
      $this->form_validation->set_rules('payment_type', 'Payment type', 'required|callback_type_check');
          if ($this->form_validation->run() == FALSE)
          {                                              
              $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-danger'));
              $data= array('title'=> 'People', 'subtitle'=>'buyerpayment','error'=>'');
              $this->load->view('buyer/payment_form', $data);
          }else{

            $payment_type = $this->input->post('payment_type');
            $payment = array(
              'payment_date'=>date('Y-m-d', strtotime($this->input->post('paymentdate'))),
              'credit'=>$this->input->post('amount'),
              'user_id'=>$this->input->post('buyer_id'),
              'type'=>$payment_type,
                'user_type'=>'buyer',
              'purpose'=>'payment',
              'operator_id'=>$this->operator 
            );

    if( $payment_type =='cheque' || $payment_type =='TT'){
    $payment['details'] = json_encode(array('bank'=>$this->input->post('bankname'),'cheque'=>$this->input->post('chequenumber'),'cdate'=>$this->input->post('checkdate')));
   } 
            $this->db->insert('account', $payment);
            $this->session->set_flashdata(array('alert'=>'Payment Saved ! ', 'alert_type'=>'alert alert-success'));
            redirect('new_add/customer_payment', 'refresh'); 
         }

     }

     // function supplier_payment(){
     //  $data= array('title'=> 'People', 'subtitle'=>'supplierpayment','error'=>'');
     //      $this->load->view('supplier/payment_form', $data);
     // }
     function save_supplier_payment(){      
       $this->form_validation->set_rules('buyer_id', 'Buyer Selection ', 'required|trim');
       $this->form_validation->set_rules('amount', 'Payment Amount ', 'required|trim|numeric');
       $this->form_validation->set_rules('paymentdate', 'Date ', 'required|trim');
       
       $this->form_validation->set_rules('account_type', 'Account Type ', 'required|trim');
      $this->form_validation->set_rules('payment_type', 'Payment type', 'required|callback_type_check');
          if ($this->form_validation->run() == FALSE)
          {                                              
              $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-danger'));

              $data= array('title'=> 'People', 'subtitle'=>'supplierpayment','error'=>'');
              $data['material']=$this->db->get('raw_material_type')->result_array();
              $this->load->view('supplier/payment_form', $data);
          }else{
            $account_type = $this->input->post('account_type');
            $material = $this->input->post('material');
            $weight = $this->input->post('weight');
             $payment = array(
              'payment_date'=>date('Y-m-d', strtotime($this->input->post('paymentdate'))),
              'user_id'=>$this->input->post('buyer_id'),
              'type'=>$this->input->post('payment_type'),
              'user_type'=>'supplier',
              'purpose'=>'manual',
              'material'=>$material,
              'weight'=>$weight,
              'operator_id'=>$this->operator 
            );
            if($account_type =='debit'){
              $payment['debit'] = $this->input->post('amount');
            }else{
              $payment['credit'] = $this->input->post('amount');
            }

           
          if($this->input->post('payment_type') =='cheque'){
          $payment['details'] = json_encode(array('bank'=>$this->input->post('bankname'),'cheque'=>$this->input->post('chequenumber'),'cdate'=>$this->input->post('checkdate')));
         } 
            $this->db->insert('account_supplier', $payment);
            $this->session->set_flashdata(array('alert'=>'Payment Saved ! ', 'alert_type'=>'alert alert-success'));
            redirect('new_add/save_supplier_payment', 'refresh'); 
         }
     }


     public function product(){
        $data= array('title'=> 'Settings', 'subtitle'=>'product','error'=>'');
        $this->form_validation->set_rules('name', 'Product Name ', 'required|min_length[3]|is_unique[product.product_name]', array('is_unique' => 'This %s  name already added !'));
        $this->form_validation->set_rules('ptype', 'Product Type ', 'required');
                                              
      if ($this->form_validation->run() == FALSE)
      {
              $data['error'] = validation_errors();                      
              $data['product_type'] = $this->model->getData('product_type');
              $this->load->view('product/product_form', $data);
      }else{
              $product= array(
                'product_type_id'=> $this->input->post('ptype'),                         
                'product_name'=> $this->input->post('name'),
                'weight'=>$this->input->post('weight')
              );

              $this->model->save('product', $product);
              $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
              redirect(current_url(), 'refresh');
      }




     }







































      function select_buyer_for_sell(){
        $data= array('title'=> 'Sell', 'subtitle'=>'','error'=>'');
          $this->load->view('product/select_buyer_for_sell', $data);
      }


       function final_sellOut(){
               $data= array('title'=> 'Sale', 'subtitle'=>'','error'=>'');

                $this->form_validation->set_rules('buyer_id', 'Buyer Selection ', 'required|trim');
                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();                         
                         $data['product'] = $this->model->getData('product_type', 'status', 1);                   
                        $this->load->view('product/sell_out_form', $data);
                }
                else
                {  
                   $items =  $this->cart->contents();
                   $insert_id = 0;
                   if(!empty($items)){
                        $data['memo'] = '10'.substr(time(), 3);
                        $data['buyer_id'] = $this->input->post('buyer_id');
                            foreach($items as $item){
                                $sell_product= array(
                                    'memo' =>  $data['memo'],
                                    'product_type_id'=> $item['id'],
                                    'buyer_id'=> $data['buyer_id'],
                                    'quantity'=>$item['qty'],
                                    'price'=>$item['price'],
                                    'subtotal'=>$item['subtotal'],
                                    'operator_id'=>$this->operator                             
                                );
                               $insert_id =  $this->model->save('product_sell', $sell_product);
                            }

                            if($insert_id){
                              $account = array(
                                  'debit'=>$this->cart->total(),
                                  'user_id'=>$data['buyer_id'],
                                  'purpose'=>'sale',
                                    'ref_id'=>$data['memo'],
                                    'operator_id'=>$this->operator
                              );
                              $insert_id =  $this->model->save('account', $account);

                            }
                             $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                         
                             $this->load->view('product/view_invoice', $data);
                            
                   }else{
                        $this->session->set_flashdata(array('alert'=>'No Product To Sell  ! ', 'alert_type'=>'alert alert-danger'));
                        redirect('new_add/new_sellOut'); 
                   }
                } 

       }


       function new_sellOut(){
         $data= array('title'=> 'Sell', 'subtitle'=>'','error'=>'');
              
                $this->form_validation->set_rules('product_type_id', 'Product Type ', 'required|trim');
               
               $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
                $this->form_validation->set_rules('price', 'Price', 'required|trim|greater_than[0]');

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();                           
                         $data['product'] = $this->model->getData('product_type', 'status', 1);                   
                        $this->load->view('product/sell_out_form', $data);
                }
                else
                {       
                       
                        
                   $quantity = $this->input->post('qty');
                   $price = $this->input->post('price');  
                   
                  $product_id =  $this->input->post('product_type_id');
                  $product_name = get_product_type_name($product_id);
                    $cdata = array(
                            'id'      => $product_id,
                            'qty'     => $quantity,
                            'price'   => $price,
                            'name'    => $product_name
                    );
                        
                    $this->cart->insert($cdata);   
                    redirect(current_url());


                }
       }

       function update_cart(){
       
            foreach($this->input->post() as $item){
                $data = array(
                        'rowid' => $item['rowid'],
                        'qty'   => $item['qty']
                );

                $this->cart->update($data);
            }
               
            redirect('new_add/new_sellOut');
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
                       
                        $this->load->view('expense/expense_form', $data);
                }
                else
                {
                        $expense= array(
                            'expense_type_id'=>$this->input->post('type_id'),
                            'amount'=> $this->input->post('amount'),
                            'note'=>$this->input->post('note'),
                            'branch_id'=>$this->input->post('branch_id'),
                            'operator_id'=>$this->operator
                        );

                        $this->model->save('expense', $expense);
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                       
                        $this->load->view('expense/expense_form', $data);
                }

     }  
       

       function employee_suggestion($str){
        $data=array();
        $sqr = "SELECT * FROM users WHERE role = 'employee' AND full_name LIKE '%" . $str . "%' ";
        $users = $this->db->query($sqr);
       if($users->num_rows() > 0){
        
                foreach($users->result_array() as $row){
                    $data[] = $row['metal_id'].'-'.$row['full_name'];
                }            
        }       
        
        echo json_encode($data);
       }
     public function ready_product(){
            $data= array('title'=> 'Product', 'subtitle'=>'ready_product','error'=>'');
             
                $this->form_validation->set_rules('product_type', 'Product Type ', 'required|trim');
                  $this->form_validation->set_rules('dep', 'Department ', 'required|trim');
              // $this->form_validation->set_rules('employee', 'Employee Name', 'required|trim|min_length[0]');
               $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
               $this->form_validation->set_rules('date', 'Date Production', 'required|trim');

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                        $data['dep'] = $this->model->getData('department'); 
                                             
                        $this->load->view('product/ready_product_form', $data);
                }
                else
                {       
                      
                        $qty = $this->input->post('qty');
                        $unit = $this->input->post('unit');
                        $date = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
                      //  $employee_id = $this->input->post('employee'); 
                        $product_id = $this->input->post('product_type');
                        $dep_id = $this->input->post('dep');
                      //  $earn = calculate_employee_earn_for_product($product_id, $employee_id, $qty);
                      //  if($earn){

                                $ready_product= array(
                                    'product_type_id'=> $product_id,
                                    'department_id'=>$dep_id,
                                   // 'employee_id'=>$employee_id ,
                                    'quantity'=>$qty,
                                    'unit'=>$unit,
                                    'making_time'=>$date,
                                   // 'employee_earn'=>$earn,
                                    'operator_id'=>$this->operator                              
                                );
                                $this->model->save('product', $ready_product);
                               $ref_id =  $this->db->insert_id();
                               /* $account = array(
                                    'user_id'=>$employee_id,
                                    'debit'=>$earn,
                                    'type'=>'production',
                                    'ref'=>$ref_id
                                );
                                $this->model->save('employee_account', $account);*/
                                $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                               redirect(current_url());
                               
                      /*  }else{
                            $this->session->set_flashdata(array('alert'=>'Employee payment not set for this Product. First Assign Product Payment ! ', 'alert_type'=>'alert alert-danger'));
                            redirect('new_add/ready_product', 'refresh');
                        }*/              }

     }  
     public function product_type(){
            $data= array('title'=> 'Settings', 'subtitle'=>'ProductType','error'=>'');
                $this->form_validation->set_rules('name', 'Type Name ', 'required|min_length[3]|is_unique[product_type.type_name]', array('is_unique' => 'This %s  name already added !'));
                                       
                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();                      
                        $this->load->view('product/product_type_form', $data);
                }else{
                        $type= array(                            
                            'type_name'=> $this->input->post('name'),
                            'description'=>$this->input->post('desc')
                        );

                        $this->model->save('product_type', $type);
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                        redirect(current_url(), 'refresh');
                }
     }  

	public function new_material_type()	{
			$data= array('title'=> 'Settings', 'subtitle'=>'RawMaterial','error'=>'');

			

                $this->form_validation->set_rules('name', 'Type Name ', 'required|min_length[3]|is_unique[raw_material_type.type_name]', array('is_unique' => 'This %s  name already added !'));
               

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                        $this->load->view('raw_material/raw_material_type_form', $data);
                }
                else
                {
                        $type= array(
                        	'type_name'=> $this->input->post('name'),
                        	'type_desc'=>$this->input->post('desc'),
                          'operator_id'=>$this->operator
                        );

                        $this->model->save('raw_material_type', $type);
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                        redirect(current_url(), 'refresh');
                }
		

	}




  function new_accessories_name(){

    $data= array('title'=> 'accessories', 'subtitle'=>'Name','error'=>'');       

      $this->form_validation->set_rules('name', 'Accessories Name', 'required|min_length[3]|is_unique[accessories.name]', array('is_unique' => 'This %s  name already added !'));
     

      if ($this->form_validation->run() == FALSE)
      {
              $data['error'] = validation_errors();
              $this->load->view('setting/accessories_name', $data);
      }
      else
      {
              $accessories= array(
                'name'=> $this->input->post('name'),              
                'operator_id'=>$this->operator
              );

              $this->model->save('accessories', $accessories);
              $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
              redirect(current_url(), 'refresh');
      }
}

  function accessories_add_orremove(){

     $this->form_validation->set_rules('accessory', 'Accessories Name', 'required');     
     $this->form_validation->set_rules('info', 'Action Selection', 'required');     

      if ($this->form_validation->run() == FALSE)
      {
        $data= array('title'=> 'accessories', 'subtitle'=>'inout');
        $data['error'] = validation_errors();
        $data['accessories'] = $this->db->order_by('name','ASC')->get('accessories');
        $this->load->view('setting/accessories_add_orremove', $data);
      }else{
        $accessories = $this->input->post('accessory');
        $info = $this->input->post('info');
        $qty = $this->input->post('qty');
        $str = '';
        if($info == 'add'){
          $this->db->insert('accessories_stock',array('accessories_id'=>$accessories,'add_qty'=>$qty));
          $str ='Added ';
        }else if($info == 'remove'){
            $this->db->insert('accessories_stock',array('accessories_id'=>$accessories,'remove_qty'=>$qty));
          $str ='Removed ';
        }else{
          $this->db->select(" (SUM(`add_qty`) - SUM(`remove_qty`)) as stock FROM `accessories_stock` ");
          $this->db->where('accessories_id', $accessories);
          $stock = $this->db->get()->row_array()['stock'];

          $str =  'Current Stock is '.$stock; 


        }

        $this->session->set_flashdata(array('alert'=>$str, 'alert_type'=>'alert alert-success'));
              redirect(current_url(), 'refresh');

      }
  }

  

    function new_expense_type(){
       

                $this->form_validation->set_rules('name', 'Expense Type Name ', 'required|min_length[3]|is_unique[expense_type.name]', array('is_unique' => 'This %s  name already added !'));
               

                if ($this->form_validation->run() == FALSE)
                {
                       
                        $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-warning'));
                       
                }
                else
                {
                        $type= array(
                            'name'=> $this->input->post('name'),
                            'operator_id'=>$this->operator
                        );

                        $this->model->save('expense_type', $type);
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                       
                }
                 redirect('view/expense_type_list');
    }

    function spare_parts(){
         $this->form_validation->set_rules('name', 'Parts Name ', 'required|min_length[3]|is_unique[spare_parts.name]', array('is_unique' => 'This %s  name already added !'));
               

                if ($this->form_validation->run() == FALSE)
                {
                       
                        $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-warning'));
                       
                }
                else
                {
                        $type= array(
                            'name'=> $this->input->post('name'),
                            'operator_id'=>$this->operator
                        );

                        $this->model->save('spare_parts', $type);
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                       
                }
                 redirect('view/spare_parts', 'refresh');
    }


    function new_department(){           

                $this->form_validation->set_rules('name', 'Department Name ', 'required|min_length[3]|is_unique[department.department_name]', array('is_unique' => 'This %s  name already added !'));
               

                if ($this->form_validation->run() == FALSE)
                {
                       
                        $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-warning'));
                       
                }
                else
                {
                        $type= array(
                            'department_name'=> $this->input->post('name'),
                            'operator_id'=>$this->operator
                        );

                        $this->model->save('department', $type);
                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                       
                }
                 redirect('view/department_list', 'refresh');
    }

    function update_product_selection(){
            $id= $this->input->post('employee_id');
            if($id==''){
                         $this->session->set_flashdata(array('alert'=>'No Identification Detected ! ', 'alert_type'=>'alert alert-danger'));
                        redirect('view/employee_list');
                        exit();
         }
         
         $employee = $this->input->post('employee_id');
         $product = $this->input->post('product_type');
          $price = $this->input->post('price');
          if(is_array($product) && !empty($product)){

            $this->db->where('user_id', $employee);
            $this->db->delete('employee');

          }


        for($i=0; $i < count($product); $i++){
                $data = array(
                    'user_id' => $employee,
                    'product_type_id'=> $product[$i],
                    'salary_per_unit_product' => $price[$i]
                );
            $this->db->insert('employee', $data);

        }
        $this->session->set_flashdata(array('alert'=>'Employee Production Updated ! ', 'alert_type'=>'alert alert-success'));
        redirect('view/employee_list', 'refresh');



    }

    function employee_product($id=''){
        $data= array('title'=> 'Employee', 'subtitle'=>'','error'=>'');
        if($id==''){
                         $this->session->set_flashdata(array('alert'=>'No Identification Detected ! ', 'alert_type'=>'alert alert-danger'));
                        redirect('view/employee_list');
                        exit();
         }  

         $data['employee_id'] = $id;
        $this->load->view('employee/employee_product_assign_form', $data);
    }

    function new_employee(){
                $data= array('title'=> 'People', 'subtitle'=>'','error'=>'');
               
                  $this->form_validation->set_rules('type', 'Select Salary Type', 'required|trim');
                    $this->form_validation->set_rules('dep', 'Select Department', 'required|trim');
                 $this->form_validation->set_rules('name', 'Full Name', 'required|min_length[3]');
                $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[11]');

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                        $data['dep'] = $this->model->getData('department');
                        
                        $this->load->view('employee/employee_new_form', $data);
                }else{
                         $image = '';
                        $config['upload_path']          = './uploads/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 1000;
                        $config['max_width']            = 1024;
                        $config['max_height']           = 768;
                        $config['file_name']           = uniqid();

                        $this->load->library('upload', $config);

                         if ( ! $this->upload->do_upload('image')){
                                  $data['error'] = $this->upload->display_errors();
                                  
                         }else{
                            $image = $this->upload->data()['file_name'];
                         }
                           $user = $this->session->userdata('user_info');
                       $user= array(
                           
                            'full_name'=> $this->input->post('name'),
                            'dob'=> date('Y-m-d h:s:i', strtotime($this->input->post('dob'))),
                            'nid'=>$this->input->post('nid'),
                            'address'=>$this->input->post('address'),
                            'mobile'=>$this->input->post('mobile'),
                            'comments'=>$this->input->post('comments'),
                            'role'=>'employee',
                            'image'=>$image,
                            'salary_type_id'=>$this->input->post('type'),
                            'department_id'=>$this->input->post('dep'),
                            'metal_id'=>uniqid(),
                            'branch_id'=>$user['branch_id'],
                            'operator_id'=>$this->operator
                        );

                        $id =  $this->model->save('users', $user);
                        if($id > 0){
                            $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                         
                        }else{
                            $this->session->set_flashdata(array('alert'=>'Error  ! ', 'alert_type'=>'alert alert-danger'));
                         
                        }
                         redirect(current_url(), 'refresh'); 




                }  
    }


    function assign_salary(){
            
             $this->form_validation->set_rules('amount', 'Salary', 'required|min_length[1]');
              $this->form_validation->set_rules('employee_id', 'Employee Selection', 'required|min_length[1]');
              if ($this->form_validation->run() == FALSE)
                {
                       $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-danger'));
                 }else{

                    $salary = array(
                        'user_id'=>$this->input->post('employee_id'),
                        'salary'=>$this->input->post('amount'),
                        'operator_id'=>$this->operator
                    );
                    $sts = $this->db->insert('hour_salary', $salary);
                    if($sts){
                        $this->session->set_flashdata(array('alert'=>'Salary Assigned !', 'alert_type'=>'alert alert-success'));
                    }else{
                        $this->session->set_flashdata(array('alert'=>'Error ... Please Try Again !', 'alert_type'=>'alert alert-danger'));
                    }
                 } 
          redirect('view/employee_list', 'refresh');             
    }

     function assign_salary_fixed(){
       
             $this->form_validation->set_rules('amount', 'Salary', 'required|min_length[1]');
              $this->form_validation->set_rules('employee_id', 'Employee Selection', 'required|min_length[1]');
              if ($this->form_validation->run() == FALSE)
                {
                       $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-danger'));
                 }else{

                    $salary = array(
                        'user_id'=>$this->input->post('employee_id'),
                        'salary'=>$this->input->post('amount'),
                        'operator_id'=>$this->operator
                    );

                    $sts = $this->db->insert('fixed_salary', $salary);
                    
                    if($sts){
                        $this->session->set_flashdata(array('alert'=>'Monthly Salary Assigned !', 'alert_type'=>'alert alert-success'));
                    }else{
                        $this->session->set_flashdata(array('alert'=>'Error ... Please Try Again !', 'alert_type'=>'alert alert-danger'));
                    }
                 } 
          redirect('view/employee_list', 'refresh');
    }


    public function people(){

                $data= array('title'=> 'People', 'subtitle'=>'','error'=>'');

              

                $this->form_validation->set_rules('type', 'People Type', 'required|trim|min_length[3]',
        array('min_length' => 'You Must Select People Type !'));
                
                $this->form_validation->set_rules('name', 'Full Name', 'required|min_length[3]');
                $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[11]');

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                        $this->load->view('employee/employee_form', $data);
                }
                else
                {                     
                 $image = '';
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $config['file_name']           = uniqid();

                $this->load->library('upload', $config);

                 if ( ! $this->upload->do_upload('image')){
                          $data['error'] = $this->upload->display_errors();
                          
                 }else{
                    $image = $this->upload->data()['file_name'];
                 }
                         $user = $this->session->userdata('user_info');
                       $user= array(

                            'full_name'=> $this->input->post('name'),
                            'dob'=> date('Y-m-d h:s:i', strtotime($this->input->post('dob'))),
                            'nid'=>$this->input->post('nid'),
                            'address'=>$this->input->post('address'),
                            'mobile'=>$this->input->post('mobile'),
                            'comments'=>$this->input->post('comments'),
                            'role'=>$this->input->post('type'),
                            'image'=>$image,
                            'metal_id'=>uniqid(),
                            'branch_id'=>$user['branch_id'],
                            'operator_id'=>$this->operator
                        );

                        $id =  $this->model->save('users', $user);
                        if($id > 0){
                            $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                         
                        }else{
                            $this->session->set_flashdata(array('alert'=>'Error  ! ', 'alert_type'=>'alert alert-danger'));
                         
                        }
                         redirect(current_url());
                }
    }

    public function new_material(){
                $data= array('title'=> 'Raw Material', 'subtitle'=>'','error'=>'');
               
                $this->form_validation->set_rules('type_id', 'Material Type ', 'required');
                $this->form_validation->set_rules('supplier_id', 'Supplier ', 'required');
                  $this->form_validation->set_rules('date', 'Buy Date ', 'required');
                
               $this->form_validation->set_rules('name', 'Name', 'trim');
               $this->form_validation->set_rules('desc', 'Description', 'trim');
               $this->form_validation->set_rules('unit', 'Unit', 'required');
               $this->form_validation->set_rules('price', 'Unit Price ', 'required|trim|greater_than[0]');
               $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();                        
                        $data['type'] = $this->model->getData('raw_material_type', 'status', '1');
                        $this->load->view('raw_material/raw_material_form', $data);
                }
                else
                {       
                      $price = floatval($this->input->post('price')); 
                      $qty = floatval($this->input->post('qty'));
                      $supplier_id = $this->input->post('supplier_id');
                      $sub_total = $price * $qty ;
                      $date = date('Y-m-d H:i:s', strtotime($this->input->post('date'))); 
                        $material= array(
                            'type_id'=> $this->input->post('type_id'),
                            'supplier_id'=> $supplier_id,
                            'name'=>$this->input->post('name'),
                            'description'=>$this->input->post('desc'),
                            'unit'=>$this->input->post('unit'),
                            'unit_price'=>$price,
                            'quantity'=>$qty,
                            'sub_total'=>   $sub_total,
                            'operator_id'=>$this->operator,
                            'create_date'=>$date                           
                        );
                       $save =  $this->model->save('raw_material', $material);
                      if($save){
                             $account = array(
                               'credit'=>$sub_total,
                               'user_id'=> $supplier_id,
                               'purpose'=>'buy',
                               'ref_id'=>$save,
                               'operator_id'=>$this->operator
                            );

                          $this->db->insert('account', $account);
                      }

                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                       redirect('new_add/new_material','refresh');
                }
        
    }


function staff_info_add($id=''){
  if($id==''){
    $id = $this->input->post('edit_id');
    if($id ==''){
      
        $this->session->set_flashdata(array('alert'=>'No Identification Detected ! ', 'alert_type'=>'alert alert-danger'));
                             
         redirect('view/staff_list');
         exit();
    }
  }


 
       $this->form_validation->set_rules('username', 'User name', 'trim|required|is_unique[users.username]',array('is_unique' => 'This Username already in Use. Try Another one.'));
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
        $this->form_validation->set_rules('dep', 'Department', 'trim|required');
        
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
       $this->form_validation->set_rules('conf', 'Password Confirmation', 'trim|required|matches[pass]');
       if ($this->form_validation->run() == FALSE)
                {
                      $data= array('title'=> 'Employee', 'subtitle'=>'staff','error'=>validation_errors(), 'edit_id'=>$id);
                       $data['dep'] = $this->model->getData('department');            
                     $this->load->view('staff/access_assign_form', $data);
                }else{

                    $update_array = array(
                        'username'=>$this->input->post('username'),
                        'password'=>md5($this->input->post('pass')),
                        'branch_id'=>$this->input->post('branch'),
                        'department_id'=>$this->input->post('dep')
                    );
                    $this->db->where('id', $id);
                    $this->db->update('users', $update_array);
                    $this->session->set_flashdata(array('alert'=>'Username and Password Created for Login. ', 'alert_type'=>'alert alert-success'));
                    redirect('view/staff_list');

                }
      
    
}



function raw_material_consume(){
      $data= array('title'=> 'Material', 'subtitle'=>'consume','error'=>'');             

                $this->form_validation->set_rules('type_id', 'Type Name ', 'required|trim');
               $this->form_validation->set_rules('unit', 'Unit Name ', 'required|trim');
               $this->form_validation->set_rules('qty', 'Quantity ', 'required|trim|numeric');

                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                         $data['type'] = $this->model->getData('raw_material_type', 'status', '1');
                         $this->load->view('raw_material/consume_form', $data);
                }
                else
                {
                        $type= array(
                            'material_type_id'=> $this->input->post('type_id'),
                            'unit'=>$this->input->post('unit'),
                            'qty'=>$this->input->post('qty'),
                            'operator_id'=>$this->operator
                        );

                        $this->model->save('material_consume', $type);
                        $this->session->set_flashdata(array('alert'=>'Material Consumed Saved  ! ', 'alert_type'=>'alert alert-success'));
                        redirect('new_add/raw_material_consume', 'refresh');
                        
                }
                
               
}


function raw_material_recycle(){
      $data= array('title'=> 'Material', 'subtitle'=>'recycle','error'=>'');             

                $this->form_validation->set_rules('type_id', 'Material Type Name ', 'required|trim');
               $this->form_validation->set_rules('unit', 'Unit Name ', 'required|trim');
               $this->form_validation->set_rules('input_waste_qty', 'First Stage Waste Quantity ', 'required|trim|numeric');
               $this->form_validation->set_rules('output_waste_qty', 'Final Waste Quantity ', 'required|trim|numeric');
               $this->form_validation->set_rules('recycle_qty', 'Recycle Quantity', 'required|trim|numeric');
               $this->form_validation->set_rules('uncountable_qty', 'Uncountable Material Quantity', 'required|trim|numeric');
                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                         $data['type'] = $this->model->getData('raw_material_type', 'status', '1');
                         $this->load->view('raw_material/recycle_form', $data);
                }
                else
                {
                        $type= array(
                            'material_type_id'=> $this->input->post('type_id'),
                            'unit'=>$this->input->post('unit'),
                            'recycle_qty'=>$this->input->post('recycle_qty'),
                            'final_waste_qty'=>$this->input->post('output_waste_qty'),
                            'from_waste_qty'=>$this->input->post('input_waste_qty'),
                            'uncountable_qty'=>$this->input->post('uncountable_qty'),
                            'operator_id'=>$this->operator
                        );

                        $this->model->save('recycle', $type);
                        $this->session->set_flashdata(array('alert'=>'Recycle Data Updated  ! ', 'alert_type'=>'alert alert-success'));
                        redirect('new_add/raw_material_recycle', 'refresh');
                        
                }
      
}



function attendence(){
            $data= array('title'=> 'Employee', 'subtitle'=>'attendence','error'=>'');
             
                  $this->form_validation->set_rules('dep', 'Department ', 'required|trim');
               $this->form_validation->set_rules('employee', 'Employee Name', 'required|trim|min_length[0]');
               $this->form_validation->set_rules('hour', 'Total Hour', 'required|trim|greater_than[0]|numeric');
              $this->form_validation->set_rules('date', 'Attendence Date', 'required|trim');


                if ($this->form_validation->run() == FALSE)
                {
                        $data['error'] = validation_errors();
                        $data['dep'] = $this->model->getData('department');                                              
                        $this->load->view('employee/attendence_form', $data);
                }
                else
                {       
                      
                         $hour = $this->input->post('hour');
                         $employee_id = $this->input->post('employee'); 
                         $date = $this->input->post('date');
                         $dep_id = $this->input->post('dep');
                       

                                $attendence= array(
                                    'user_id'=> $employee_id,
                                    'hour'=>$hour,
                                    'attendence_date'=>date('Y-m-d', strtotime($date)),
                                    'operator_id'=>$this->operator                              
                                );
                                $this->model->save('attendence', $attendence);
                     
                       
                               $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                           redirect(current_url(), 'refresh');
                       
                }

     }  





//end
}

?>
