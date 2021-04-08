<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WorkstationT extends CI_Controller {	

	public function __construct()

 {
  parent::__construct();
             //departmant id = 2 user_id = 3
  $user = $this->session->userdata('user_info');
  if($user['user_id']!= 3 || $user['is_login'] != 1){
   $this->session->set_flashdata("alert", "You Must Login With Valid Username/Password ! ('~') ");
   redirect('authentication/');
 }

 $this->load->model('common_model', 'model', true);  
 $this->load->library('cart');
 $this->load->library('form_validation');
 $this->department = 2;
 $this->operator = $user['user_id'];                
}

public function index()	{
  $data= array('title'=> 'Dashboard', 'subtitle'=>'');
  $this->load->view('workstationtwo/dashboard', $data);	
}

function createSparePartsChalan(){
  $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
  $this->form_validation->set_rules('supplier_id', 'Supplier Selection ', 'required|trim');
  $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[spare_parts_chalan.chalan_no]', array('is_unique' => 'This %s  already added !'));
  if ($this->form_validation->run() == FALSE)
  {
   $data= array('title'=> 'SpareParts', 'subtitle'=>'','error'=> validation_errors());
   $data['error'] = validation_errors();                      
   $data['supplier'] = $this->model->getData('users', 'role', 'supplier');                       
   $this->load->view('workstationtwo/chalan_input_for_tranfer', $data);

 }
 else
 {  
  $items =  $this->cart->contents();
  $insert_id = 0;
  if(!empty($items)){ 

    $price = 0;  
    $pdata['chalan_no'] = $this->input->post('chalan_no');                       
    $pdata['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
    $pdata['supplier_id'] = $this->input->post('supplier_id');
    $pdata['department']=$this->department;
    $pdata['operator_id']=$this->operator;
    $pdata['total']= 0; 
    foreach($items as $item){
      $sParts= array(
        'chalan_no' =>  $pdata['chalan_no'],
        'chalan_date'=>$pdata['chalan_date'],
        'department_id'=>$this->department,
        'parts_id'=> $item['id'],
        'qty'=>$item['qty'],
        'price'=>$item['price'],                 
        'subtotal'=>$item['subtotal'],
        'unit'=>$item['options']['unit']                            
      );
      $insert_id =  $this->model->save('spare_parts_receive', $sParts);
    }  

    $insert_id =  $this->model->save('spare_parts_chalan', $pdata);
    $this->cart->destroy();
    $this->session->set_flashdata(array('alert'=>'Chalan Saved  ! ', 'alert_type'=>'alert alert-success'));

  }else{
   $this->session->set_flashdata(array('alert'=>'No Item To Create Chalan  ! ', 'alert_type'=>'alert alert-warning'));

 } 
 redirect('workstationtwo/spare_parts');
}
}

function update_parts_cart(){
  foreach($this->input->post() as $item){
    $data = array(
      'rowid' => $item['rowid'],
      'qty'   => $item['qty']
    );

    $this->cart->update($data);
  }

  redirect('workstationtwo/spare_parts');
}

function spare_parts(){
 $data= array('title'=> 'SpareParts', 'subtitle'=>'','error'=>'');
 $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                  
 $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
 if ($this->form_validation->run() == FALSE)
 {
   $data['error']= validation_errors();
   $data['product_type'] = $this->model->getData('spare_parts');
   $this->load->view('workstationtwo/spare_parts_form', $data);
 }
 else
 {
  $quantity = $this->input->post('qty');

  $unit = $this->input->post('unit');
  $product_id =  $this->input->post('product_id');
  $product_name = get_parts_name($product_id);
  $cdata = array(
    'id'      => $product_id,
    'price'=>0,
    'qty'     => $quantity,                                                 
    'name'    => $product_name,
    'options'=>array('unit'=>$unit)
  );                       
  $this->cart->insert($cdata);   
  redirect(current_url());
}

}


function delivery(){
 $data= array('title'=> 'Delivery', 'subtitle'=>'','error'=>'');
 $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                  
 $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
 if ($this->form_validation->run() == FALSE)
 {
   $data['error']= validation_errors();   
   $this->load->view('workstationtwo/product_sale_form', $data);
 }
 else
 {
  $quantity = $this->input->post('qty');
  $unit = $this->input->post('unit');
  $product_id =  $this->input->post('product_id');
  $product_name = get_product_type_name($product_id);
  $cdata = array(
    'id'      => $product_id,
    'price'=>0,
    'qty'     => $quantity,                                                 
    'name'    => $product_name,
    'options'=>array('unit'=>$unit)
  );                       
  $this->cart->insert($cdata);   
  redirect(current_url());
}

}

function update_delivery_cart(){
  foreach($this->input->post() as $item){
    $data = array(
      'rowid' => $item['rowid'],
      'qty'   => $item['qty']
    );

    $this->cart->update($data);
  }

  redirect('workstationtwo/delivery');

}

function deliveryChalan(){
 $data= array('title'=> 'Delivery', 'subtitle'=>'','error'=>'');
 $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
 $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[product_sale_chalan.chalan_no]', array('is_unique' => 'This %s  name already added !'));
 if ($this->form_validation->run() == FALSE)
 {
  $data['error']= validation_errors();
  $this->load->view('workstationtwo/sale_input',$data);
}else{

  $items =  $this->cart->contents();
  $insert_id = 0;
  if(!empty($items)){

    $sdata['chalan_no'] = $this->input->post('chalan_no');                       
    $sdata['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
    $sdata['from_dep'] = $this->department;//replace if need 
    $sdata['buyer_id'] = $this->input->post('to_customer');
    $sdata['operator_id']=$this->operator;
    $sdata['total']= 0; 
    foreach($items as $item){
      $sale= array(
        'chalan_no' =>  $sdata['chalan_no'],        
        'product_type_id'=> $item['id'],  
        'chalan_date'=> $sdata['chalan_date'],   
        'qty'=>$item['qty'],
        'price'=>$item['price'], 
        'department_id'=>$this->department,
        'buyer_id'=>  $sdata['buyer_id'],                
        'subtotal'=>$item['subtotal'],
        'unit'=>$item['options']['unit']                            
      );
      $insert_id =  $this->model->save('product_sell', $sale);
    }

    $this->db->insert('product_sale_chalan',$sdata);  
    $this->cart->destroy();
    $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
  }else{
    $this->session->set_flashdata(array('alert'=>'No Product to Create Chalan  ! ', 'alert_type'=>'alert alert-warning'));
  }
  redirect('workstationtwo/delivery');
}

}





function final_acc_chalan(){

  $pdata=array('title'=>'','subtitile'=>'','error'=>'');
  $this->form_validation->set_rules('acc_id', 'Accessories Name', 'required|trim');               
  $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
  $this->form_validation->set_rules('supplier_id', 'Supplier Selection ', 'required|trim');              
  $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
  $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[accessories_receive_chalan.chalan_no]', array('is_unique' => 'This %s  already added !'));
  if ($this->form_validation->run() == FALSE)
  {
   $pdata['error']=  validation_errors();                       

 }
 else
 {  
   $quantity = $this->input->post('qty');
   $price = 0;  

   $acc_id =  $this->input->post('acc_id');

   $insert_id = 0;

   $data['chalan_no'] = $this->input->post('chalan_no');
   $data['supplier_id'] = $this->input->post('supplier_id');
   $data['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
   $data['operator_id']=$this->operator; 
   $data['total']= 0; 

   $material= array(
    'chalan_no' =>  $data['chalan_no'],
    'chalan_date'=>date('Y-m-d',strtotime($this->input->post('chalan_date'))),
    'acc_id'=> $acc_id,
    'supplier_id'=> $data['supplier_id'],
    'qty'=>$quantity,
    'unit'=>$this->input->post('unit'),
    'price'=>0,
    'subtotal'=>0                            
  );
   $insert_id =  $this->model->save('accessories_receive', $material);

   $this->db->insert('accessories_receive_chalan',$data);    


   $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));

 }
 $pdata['acc'] = $this->model->getData('accessories', 'status', 1);
 $this->load->view('workstationtwo/select_accessories_supplier', $pdata); 

}

function select_acc_supplier(){
    $data=array('title'=>'Accessories','subtitile'=>'','error'=>'');
    $this->form_validation->set_rules('supplier_id', 'Supplier Selection ', 'required|trim');           
    $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
    $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[accessories_receive_chalan.chalan_no]', array('is_unique' => 'This %s  already added !'));
  if ($this->form_validation->run() == FALSE)
  {
   $data['error']=  validation_errors();                       
   $this->load->view('workstationtwo/select_accessories_supplier', $data);
  }
  else
 {  
   
    $items =  $this->cart->contents();
    $insert_id = 0;
  if(!empty($items)){ 
      $adata['chalan_no'] = $this->input->post('chalan_no');
      $adata['supplier_id'] = $this->input->post('supplier_id');
      $adata['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
      $adata['operator_id']=$this->operator; 
      $adata['department_id']=$this->department;
      $adata['total']= 0;    
    foreach($items as $item){
      $accessories = array(
         'chalan_no' =>  $adata['chalan_no'],
         'chalan_date'=>$adata['chalan_date'],
         'acc_id'=> $item['id'],    
         'qty'=>$item['qty'],
         'unit'=>$item['options']['unit'],
         'price'=>0,
         'subtotal'=>0                            
        );
        $insert_id =  $this->model->save('accessories_receive', $accessories);
    }  
   

   $this->db->insert('accessories_receive_chalan',$adata);    
   $this->cart->destroy();

   $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
  }else{
    $this->session->set_flashdata(array('alert'=>'Can not process chalan  ! ', 'alert_type'=>'alert alert-warning'));
  }
  redirect('workstationtwo/accessoriesDescription');
}
}

function update_acc_cart(){
    foreach($this->input->post() as $item){
    $data = array(
      'rowid' => $item['rowid'],
      'qty'   => $item['qty']
    );

    $this->cart->update($data);
  }

  redirect('workstationtwo/accessoriesDescription');

}

function accessoriesDescription(){
  $pdata=array('title'=>'Accessories','subtitile'=>'','error'=>'');
  $this->form_validation->set_rules('acc_id', 'Accessories Name', 'required|trim');               
  $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
  if ($this->form_validation->run() == FALSE)
  {
   $pdata['error']= validation_errors();  
   $pdata['acc'] = $this->model->getData('accessories', 'status', 1);
   $this->load->view('workstationtwo/acc_input', $pdata);
 }else{
    $quantity = $this->input->post('qty');
    $unit = $this->input->post('unit');
    $product_id =  $this->input->post('acc_id');
    $product_name = get_accessories_name($product_id);
    $cdata = array(
    'id'      => $product_id,
    'price'=>0,
    'qty'     => $quantity,                                                 
    'name'    => $product_name,
    'options'=>array('unit'=>$unit)
    );                       
    $this->cart->insert($cdata);   
    redirect(current_url());
 }
}



function receive_spare_parts(){               
  $pdata['error']='';
  $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
  $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[goods_receive_chalan.chalan_no]', array('is_unique' => 'This %s  name already added !'));
  $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                        
  $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
  if ($this->form_validation->run() == FALSE)
  {
   $pdata['error']= validation_errors();                       


 }
 else
 {  
   $quantity = $this->input->post('qty');
   $price = 0;                   
   $product_id =  $this->input->post('product_id');                   
   $insert_id = 0;

   $data['chalan_no'] = $this->input->post('chalan_no');                       
   $data['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
   $data['supplier_id'] = $this->input->post('supplier_id');
   $data['department'] = 2;
   $data['operator_id']=$this->operator;
   $data['total']= 0; 

   $parts= array(
    'chalan_no' =>  $data['chalan_no'],
    'chalan_date'=>date('Y-m-d',strtotime($this->input->post('chalan_date'))),
    'parts_id'=> $product_id,
    'supplier_id'=> $data['supplier_id'],                                  
    'qty'=>$quantity,
    'price'=>0,
    'unit'=>$this->input->post('unit'),
    'subtotal'=>0                            
  );
   $insert_id =  $this->model->save('spare_parts_receive', $parts);

   $this->db->insert('spare_parts_chalan',$data);    
   $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));

 }
 $pdata['product_type'] = $this->model->getData('spare_parts');                     

 $this->load->view('workstationtwo/product_transfer_form', $pdata); 

}

function scrabChalan(){
  $pdata= array('title'=> 'Scrab', 'subtitle'=>'','error'=>'');

  $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                        
  $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
  $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
  $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[scrab_delivery_chalan.chalan_no]', array('is_unique' => 'This %s  already added !'));
  if ($this->form_validation->run() == FALSE)
  {
   $pdata['error']= validation_errors();

 }
 else
 {  
   $quantity = $this->input->post('qty');
   $price = 0;  
   $unit = $this->input->post('unit');
   $product_id =  $this->input->post('product_id');

   $data['chalan_no'] = $this->input->post('chalan_no');                       
   $data['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
                        $data['from_dep'] = 2;//replace if need 
                        $data['buyer_id'] = $this->input->post('to_customer');
                        $data['operator_id']=$this->operator;
                        $data['total']= 0; 
                        
                        $sale= array(
                          'chalan_no' =>  $data['chalan_no'],
                          'chalan_date'=>date('Y-m-d',strtotime($this->input->post('chalan_date'))),
                          'product_id'=> $product_id,
                          'from_dep'=>$data['from_dep'],
                          'buyer_id'=> $data['buyer_id'],
                          'qty'=>$quantity,
                          'price'=>0,
                          'unit'=>$unit,
                          'subtotal'=>0                            
                        );
                        $insert_id =  $this->model->save('scrab_delivery', $sale);

                        $this->db->insert('scrab_delivery_chalan',$data);    


                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
                      }
                      $pdata['product_type'] = $this->model->getData('scrab');  
                      $this->load->view('workstationtwo/scrabe_chalan', $pdata);


                    }


                    function report(){

                      $data= array('title'=> 'Report', 'subtitle'=>'','error'=>'');
                      $this->load->view('workstationtwo/report', $data);

                    } 


                    function accessories_table(){
                      $data=array();
                      $chalans= $this->db->get('accessories_receive_chalan')->result_array();
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

                    function receive_goods_chalan(){
                      $data=array();
                      $chalans= $this->db->get('spare_parts_chalan')->result_array();
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

                    function delivery_scrab_table(){
                      $data=array();
                      $chalans= $this->db->where('from_dep',2)->get('scrab_delivery_chalan')->result_array();
                      if(!empty($chalans)){
                        $i=1;
                        foreach($chalans as $key=>$val){

                          $supplier = get_user_info_by_id($val['buyer_id']);

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

                    function product_chalans(){
                      $data=array();
                      $chalans= $this->db->where('from_dep',2)->get('product_sale_chalan')->result_array();
                      if(!empty($chalans)){
                        $i=1;
                        foreach($chalans as $key=>$val){

                          $supplier = get_user_info_by_id($val['buyer_id']);

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


//end 
                  }


/*  



function sale_product(){
 $data= array('title'=> '', 'subtitle'=>'','error'=>'');

 $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                        
 $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');


 if ($this->form_validation->run() == FALSE)
 {
  $data['error'] = validation_errors();                      
  $data['product_type'] = $this->model->getData('product_type');                     
  $this->load->view('workstationtwo/product_sale_form', $data);
}
else
{       


 $quantity = $this->input->post('qty');
 $price = 0;  
 $unit = $this->input->post('unit');
 $product_id =  $this->input->post('product_id');
 $product_name = get_product_type_name($product_id);
 $cdata = array(
  'id'      => $product_id,
  'qty'     => $quantity,
  'price'   => $price,                           
  'name'    => $product_name,
  'options'=>array('unit'=>$this->input->post('unit'))
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
 $data= array('title'=> '', 'subtitle'=>'','error'=>'');
 $this->load->view('workstationtwo/sale_input', $data);
}

function finish_goods(){ 
  $pdata= array('title'=> '', 'subtitle'=>'','error'=>'');              
  $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                        
  $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');                
  $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
  $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[product_sale_chalan.chalan_no]', array('is_unique' => 'This %s  already added !'));
  if ($this->form_validation->run() == FALSE)
  {
   $pdata['error']= validation_errors();                       

 }
 else
 {  
  $quantity = $this->input->post('qty');
  $price = 0;  
  $unit = $this->input->post('unit');
  $product_id =  $this->input->post('product_id');                  
  $insert_id = 0;

  $data['chalan_no'] = $this->input->post('chalan_no');                       
  $data['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
                        $data['from_dep'] = 2;//replace if need 
                        $data['buyer_id'] = $this->input->post('to_customer');
                        $data['operator_id']=$this->operator;
                        $data['total']= 0; 

                        $sale= array(
                          'chalan_no' =>  $data['chalan_no'],
                          'chalan_date'=>$data['chalan_date'],
                          'product_type_id'=> $product_id,
                          'department_id'=>$data['from_dep'],
                          'buyer_id'=> $data['buyer_id'],
                          'qty'=>$quantity,
                          'price'=>0,
                          'unit'=>$unit,
                          'subtotal'=>0                            
                        );
                        $insert_id =  $this->model->save('product_sell', $sale);

                        $this->db->insert('product_sale_chalan',$data);    

                        $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));



                      }

                      $pdata['product_type'] = $this->model->getData('product_type');
                      $this->load->view('workstationtwo/sale_input', $pdata);

                    }





*/                
