<?php

// Please Dont try to understand anything by scope variable/funciton name. this project modified over and over. code are copied and pasted here and there for fast delivery. 


defined('BASEPATH') OR exit('No direct script access allowed');

class Workstationone extends CI_Controller {	

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
 $this->department = 1;               
}

public function index()	{
  $data= array('title'=> 'Dashboard', 'subtitle'=>'');
  $this->load->view('workstationone/dashboard', $data);	
}
function waste_material(){
  $data= array('title'=> 'Waste', 'subtitle'=>'waste','error'=>'');             

  $this->form_validation->set_rules('unit', 'Unit Name ', 'required|trim');
   $this->form_validation->set_rules('qty', 'Quantity ', 'required|trim|numeric');

    if ($this->form_validation->run() == FALSE)
    {
            $data['error'] = validation_errors();
             $this->load->view('workstationone/waste_material', $data);
    }
    else
    {
            $type= array(
                'unit'=>$this->input->post('unit'),
                'qty'=>$this->input->post('qty'),
                'operator_id'=>$this->operator
            );

            $this->model->save('waste', $type);
            $this->session->set_flashdata(array('alert'=>'Waste Material Saved  ! ', 'alert_type'=>'alert alert-success'));
            redirect('workstationone/waste_material', 'refresh');
            
    }
                
}

function getWaste(){
      $data = array();
    $waste = $this->db->order_by('id','desc')->get('waste')->result_array();
    if(!empty($waste)){
      foreach($waste as $key=>$val){
        
        $data[$key] = array(
          date('d-m-Y', strtotime($val['created_at'])),
          $val['qty'].' '.$val['unit'],
          $val['status'],        );
      }
    }

    header('Content-Type: application/json;charset=utf-8');
    echo json_encode(array('data'=>$data));
  }


public function oldRawMaterial(){
    $this->form_validation->set_rules('totweight', 'Total Weight', 'required|trim');
    if ($this->form_validation->run() == FALSE)
    {
      $data['error'] = validation_errors();                      
      $data['title'] = 'Old Material';
      $this->load->view('workstationone/oldmaterialentryform', $data);
    }else{
      
      $mdata['chalan_no'] = '00';
      $mdata['supplier_id'] = '2';
      $mdata['chalan_date']= date('Y-m-d');
      $mdata['operator_id']=$this->operator;
      $mdata['total']='0.00';
      $mdata['totweight'] = $this->input->post('totweight');
      $this->db->insert('raw_material_chalan',$mdata);
       $this->session->set_flashdata(array('alert'=>' OLD Raw Material Saved !', 'alert_type'=>'alert alert-success'));

      redirect('workstationone','refresh');
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

function createMaterialChalan(){
 $data= array('title'=> 'RawMaterial', 'subtitle'=>'','error'=>'');             
 $this->form_validation->set_rules('supplier_id', 'Supplier Selection ', 'required|trim');
 $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
 $this->form_validation->set_rules('chalan_no', 'Chalan Number ', 'required|min_length[3]|is_unique[raw_material_chalan.chalan_no]', array('is_unique' => 'This %s  already Exists !'));

 if ($this->form_validation->run() == FALSE)
 {
  $data['error'] = validation_errors();                      
  $data['supplier'] = $this->model->getData('users', 'role', 'supplier');
  $this->load->view('workstationone/select_supplier_for_chalan', $data);
}
else
{ 

  $items =  $this->cart->contents();
  $insert_id = 0;
  if(!empty($items)){ 
    $payment_type =  $this->input->post('payment_type');
    $total_weight = 0;                  
    $mdata['chalan_no'] = $this->input->post('chalan_no');
    $mdata['supplier_id'] = $this->input->post('supplier_id');
    $mdata['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
    $mdata['operator_id']=$this->operator;
    $mdata['total']= $this->cart->total(); 
     $this->db->insert('raw_material_chalan',$mdata);
     $material_chalan_id = $this->db->insert_id(); 
    foreach($items as $item){
      $material= array(
        'material_chalan_id'=>$material_chalan_id,
        'chalan_no' =>  $mdata['chalan_no'],
        'material_id'=> $item['id'],
        'supplier_id'=> $mdata['supplier_id'],
        'quantity'=>$item['qty'],
        'price'=>$item['price'],                 
        'subtotal'=>$item['subtotal']                            
      );
      $insert_id =  $this->model->save('raw_material', $material);
      $total_weight += $item['qty'];
    }
    $updateData = array('totweight' => $total_weight );
    $this->db->where('id',$material_chalan_id);
    $this->db->update('raw_material_chalan', $updateData);

    // $account_data = array(
    //   'user_id'=>$mdata['supplier_id'],
    //   'credit'=>$mdata['total'],
    //   'purpose'=>'sale',
    //   'user_type'=>'supplier',
    //   'chalan_id'=>$material_chalan_id,
    //   'chalan_no'=> $mdata['chalan_no'],
    //   'payment_date'=> $mdata['chalan_date'],
    //   'operator_id'=> $this->operator);
    // $this->db->insert('account_supplier',$account_data);
   
    $this->cart->destroy();
    $this->session->set_flashdata(array('alert'=>'Chalan Saved  ! ', 'alert_type'=>'alert alert-success'));

  }else{
   $this->session->set_flashdata(array('alert'=>'Can not Save Empty Chalan  ! ', 'alert_type'=>'alert alert-warning'));

 }
 redirect('workstationone/newRawMaterialInput');
}

}


function newRawMaterialInput(){
  $data= array('title'=> 'RawMaterial', 'subtitle'=>'','error'=>'');             
  $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');
  $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
  if ($this->form_validation->run() == FALSE)
  {
    $data['error'] = validation_errors();                      
    $data['material'] = $this->model->getData('raw_material_type', 'status', 1); 
    $this->load->view('workstationone/raw_material_input', $data);
  }
  else
  { 

    $quantity = $this->input->post('qty');
    $price = 0;  
         // $unit = $this->input->post('unit');
    $product_id =  $this->input->post('product_id');
    $product_name = get_material_type_name($product_id);
    $cdata = array(
      'id'      => $product_id,
      'price'=>0,
      'qty'     => $quantity,                                                 
      'name'    => $product_name,
                      //'options'=>array('unit'=>$this->input->post('unit'))
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

  redirect('workstationone/newRawMaterialInput');

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
   $this->load->view('workstationone/chalan_input_for_tranfer', $data);

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
 redirect('workstationone/spare_parts');
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

  redirect('workstationone/spare_parts');
}

function spare_parts(){
 $data= array('title'=> 'SpareParts', 'subtitle'=>'','error'=>'');
 $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                  
 $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
 if ($this->form_validation->run() == FALSE)
 {
   $data['error']= validation_errors();
   $data['product_type'] = $this->model->getData('spare_parts');
   $this->load->view('workstationone/spare_parts_form', $data);
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

function get_product_with_productID(){
  $id = $this->input->post('type_id');
  $str='';
$products = $this->db->where('product_type_id',$id)->get('product');
if(!empty($products->result_array())){
  foreach($products->result_array() as $product){
    $str .='<option value="'.$product['product_id'].'">'.$product['product_name'].'</option>'; 
  }
}

  echo $str;
}


function cancelChalan($controller,$method){
    
      $this->cart->destroy();
      redirect($controller.'/'.$method);

  } 


function delivery(){
 $data= array('title'=> 'Delivery', 'subtitle'=>'','error'=>'');
 $this->form_validation->set_rules('product_id', 'Product Select ', 'required|trim');                
 $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');
 if ($this->form_validation->run() == FALSE)
 {
   $data['error']= validation_errors();   
   $this->load->view('workstationone/finish_product_form', $data);
 }
 else
 {

  $quantity = $this->input->post('qty');
  $unit = $this->input->post('unit');
  $product_id =  $this->input->post('product_id');
  $product = get_product_info($product_id);
  $cdata = array(
    'id' => $product_id,
    'price'=>0,
    'qty'     => $quantity,                                                 
    'name'    => $product['product_name'],
    'options'=>array('unit'=>$unit,'weight'=>$product['weight'],'type_id'=>$product['product_type_id'])
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

  redirect('workstationone/delivery');

}

function deliveryChalan(){
 $data= array('title'=> 'Delivery', 'subtitle'=>'','error'=>'');
 $this->form_validation->set_rules('chalan_date', 'Date', 'required|trim');
 $this->form_validation->set_rules('chalanType','Select Chalan Type', 'required');
 $this->form_validation->set_rules('chalan_no', 'Chalan No ', 'required|min_length[3]|is_unique[product_stock_chalan.chalan_no]', array('is_unique' => 'This %s  name already added !'));
 if ($this->form_validation->run() == FALSE)
 {
  $data['error']= validation_errors();
  $this->load->view('workstationone/sale_input',$data);
}else{

  $items =  $this->cart->contents();
  $insert_id = 0;
  if(!empty($items)){

    $sdata['chalan_no'] = $this->input->post('chalan_no');                       
    $sdata['chalan_date']= date('Y-m-d',strtotime($this->input->post('chalan_date')));
    $sdata['type'] = $this->input->post('chalanType');
    $sdata['operator_id']=$this->operator;
    $sdata['total']= 0; 
    $this->db->insert('product_stock_chalan',$sdata);
    $stock_chalan_id = $this->db->insert_id(); 
    $totWht=0;
    foreach($items as $item){
      
       $item_weight =  floatval($item['options']['weight']);
          if($item_weight > 0.00){
             $weight =  $item['qty'] * $item_weight;
           }else{
            $weight = $item['qty'] * 1;
         }
      $stock= array(
        'stock_chalan_id'=>$stock_chalan_id,
        'chalan_no' =>  $sdata['chalan_no'],        
        'product_id'=> $item['id'], 
        'product_type_id'=>$item['options']['type_id'],     
        'qty'=>$item['qty'],
        'price'=>$item['price'], 
        'weight'=>$weight,
        'unit'=>$item['options']['unit'],
        'chalan_date'=> $sdata['chalan_date']                         
      );
      $insert_id =  $this->model->save('product_stock', $stock);
      $totWht +=  $weight;
    }
    $updateData = array('totweight' => $totWht );
            $this->db->where('id',$stock_chalan_id);
            $this->db->update('product_stock_chalan', $updateData);
    
    $this->cart->destroy();
    $this->session->set_flashdata(array('alert'=>'Saved  ! ', 'alert_type'=>'alert alert-success'));
  }else{
    $this->session->set_flashdata(array('alert'=>'No Product to Create Chalan  ! ', 'alert_type'=>'alert alert-warning'));
  }
  redirect('workstationone/delivery');
}

}


function report(){

  $data= array('title'=> 'Report', 'subtitle'=>'','error'=>'');
  $this->load->view('workstationone/report', $data);

}  



function delivery_goods(){
  $data=array();
  $chalans= $this->db->get('product_stock_chalan')->result_array();
  if(!empty($chalans)){
    $i=1;
    foreach($chalans as $key=>$val){

     

      $data[$key] = array(
        $i,
        date('d-m-Y', strtotime($val['chalan_date'])),
        $val['chalan_no'],                    
        ucfirst($val['status']) ,
        '<a class="btn btn-xs btn-default" href="'.base_url().'workstationone/viewFinishProductChalan/'.$val['id'].'" >View</a>'           
      );
      $i++;
    }
  }

  header('Content-Type: application/json;charset=utf-8');
  echo json_encode(array('data'=>$data));
}
function spare_parts_table(){
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
        ucfirst($supplier['full_name']),               
        ucfirst($val['status']) ,
        '<a class="btn btn-xs btn-default" href="'.base_url().'workstationone/viewChalan/spareParts/'.$val['id'].'" >View</a>'           
      );
      $i++;
    }
  }

  header('Content-Type: application/json;charset=utf-8');
  echo json_encode(array('data'=>$data));
}
function material_table(){
  $data=array();
  $chalans= $this->db->get('raw_material_chalan')->result_array();
  if(!empty($chalans)){
    $i=1;
    foreach($chalans as $key=>$val){

      $supplier = get_user_info($val['supplier_id']);

      $data[$key] = array(
        $i,
        date('d-m-Y', strtotime($val['chalan_date'])),
        $val['chalan_no'],
        ucfirst($supplier['full_name']), 
        $val['totweight'],              
        ucfirst($val['status']),
        '<a class="btn btn-xs btn-default" href="'.base_url().'workstationone/viewRawMaterialChalan/'.$val['id'].'" >View</a>'            
      );
      $i++;
    }
  }

  header('Content-Type: application/json;charset=utf-8');
  echo json_encode(array('data'=>$data));
}

function viewRawMaterialChalan($id){ 
  $data['chalan'] = $this->db->where('id',$id)->get('raw_material_chalan')->row_array();
  $data['items'] = $this->db->where('material_chalan_id',$id)->get('raw_material')->result_array();
  $this->load->view('chalans/raw_material_chalan', $data);
}

function viewFinishProductChalan($id){ 

   $data['chalan'] = $this->db->where('id',$id)->get('product_stock_chalan')->row_array();
  $data['items'] = $this->db->where('stock_chalan_id',$id)->get('product_stock')->result_array();
  $this->load->view('chalans/finish_product_chalan', $data);
}




function viewChalan($chalanType,$chalanId){

  // you get chalanTable and itemTable 
  $tables = getTablesName($chalanType);
  if($tables['chalanTable'] !='' && $tables['itemTable'] !=''){
    //echo $tables['chalanTable'].$tables['itemTable'];
    //$dep = 1;
    $chalanData = $this->model->getChalanData($tables['chalanTable'],'id',$chalanId,$tables['itemTable']);
   // echo '<pre>';
   // print_r($chalanData);
   
   $this->load->view('chalans/'.$tables['chalanTable'] , array('chalan_data'=>$chalanData,'chalanType'=>$chalanType)); 

  }else{

    $this->session->set_flashdata(array('alert'=>'Chalan Not Found ! ', 'alert_type'=>'alert alert-warning'));
    redirect('workstationone');

  }





}


}

//Removed All old Code

