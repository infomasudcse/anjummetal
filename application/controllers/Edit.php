<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {	

	public function __construct()

       {

            parent::__construct();
             $user = $this->session->userdata('user_info');
            if($user['user_id']!= 1 || $user['is_login'] != 1 || $user['role'] !='admin'){
                $this->session->set_flashdata("alert", "You Must Login With Valid Username/Password! ('~') ");
                redirect('authentication/');
            }

            $this->load->model('common_model', 'model', true);                    

       }
      
     function update_users_password(){
         $this->load->library('form_validation');
         $this->form_validation->set_rules('id', 'Identification ', 'required|trim');
         $this->form_validation->set_rules('name', 'Name ', 'required|trim');
         $this->form_validation->set_rules('username', 'User Name ', 'required|trim');
         $this->form_validation->set_rules('password', 'Password ', 'required|trim');
         if ($this->form_validation->run() == FALSE)
          {
            $data= array('title'=> 'Settings', 'subtitle'=>'password','error'=>validation_errors());
            $data['users'] = $this->db->where('role','admin')->or_where('role','staff')->where('status',1)->get('users')->result_array();
            $this->load->view('auth/change_password', $data);
          }else{
            $id = $this->input->post('id');
            $uparray=array(
              'username'=>$this->input->post('username'),
              'password'=>md5($this->input->post('password')),
              'full_name'=>$this->input->post('name'),
            );
            $this->db->where('id',$id);
            $sql = $this->db->get('users');
            if($sql->num_rows() == 1){
              $this->db->where('id', $id);
              $this->db->update('users',$uparray);
               $this->session->set_flashdata(array('alert'=>'User Updated  ! ', 'alert_type'=>'alert alert-success'));
            }
             redirect('edit/update_users_password');
          }  
     } 

    function assets($id=''){
        if($id==''){
          $id = $this->input->post('edit_id');
        }
        if($id!=''){
          $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Assets Name ', 'required|trim');
          $this->form_validation->set_rules('cost', 'Cost', 'trim');
          $this->form_validation->set_rules('qty', 'quantity', 'required|trim|greater_than[0]|numeric');
          $this->form_validation->set_rules('desc', 'Description', 'trim');
           $this->form_validation->set_rules('note', 'Note', 'trim');
           $this->form_validation->set_rules('date', 'Date', 'required|trim');

         if ($this->form_validation->run() == FALSE)
              {
                   $this->session->set_flashdata(array('alert'=>validation_errors(), 'alert_type'=>'alert alert-success'));
                   $this->load->view('company/edit_asset', array('id'=>$id));
              }else{
                  $this->db->where('id', $id);
                  $old = $this->db->get('assets')->row_array();
                  unset($old['created_at']);
                  unset($old['id']);
                  $note = $this->input->post('note').' - '.json_encode($old);
                  $assets = array(
                    'name'=>$this->input->post('name'),
                    'cost'=>$this->input->post('cost'),
                    'qty'=>$this->input->post('qty'),
                    'description'=>$this->input->post('desc'),
                    'created_at'=>date('Y-m-d', strtotime($this->input->post('date')))
                  );
                  $this->db->where('id', $id);
                  $this->db->update('assets', $assets);
                 
                  $this->db->insert('assets_edit_note', array('asset_id'=>$id,'note'=>$note));
                   $this->session->set_flashdata(array('alert'=>'Assets Updated  ! ', 'alert_type'=>'alert alert-success'));
                   redirect('view/asset', 'refresh');
              }


        }else{
          redirect('view/asset', 'refresh');
        }
    }   


	public function people($id=''){
                  if($id==''){
                      $id = $this->input->post('edit_id');
                      if($id == ''){
                             $this->session->set_flashdata(array('alert'=>'No Identification Detected ! ', 'alert_type'=>'alert alert-danger'));
                             $page =  $this->session->userdata('prev_page');
                            redirect('view/'.$page);
                          }
                    }
                $data= array('title'=> 'People', 'subtitle'=>'','error'=>'');
                 $users = $this->model->getData('users', 'id', $id);
                  $data['user'] = $users[0];
                $this->load->library('form_validation');

                $this->form_validation->set_rules('type', 'People Type', 'required|trim|min_length[3]',
        array('min_length' => 'You Must Select People Type !'));
                $this->form_validation->set_rules('name', 'Full Name', 'required|min_length[3]');
                $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[11]');

                if ($this->form_validation->run() == FALSE)
                {
                       
                        $data['error'] = validation_errors();
                        $this->load->view('employee/employee_edit_form', $data);
                }
                else
                {                     
                 $image = $data['user']['image'];
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

                       $new_user= array(

                            'full_name'=> $this->input->post('name'),
                            'dob'=> date('Y-m-d h:s:i', strtotime($this->input->post('dob'))),
                            'nid'=>$this->input->post('nid'),
                            'address'=>$this->input->post('address'),
                            'mobile'=>$this->input->post('mobile'),
                            'comments'=>$this->input->post('comments'),
                            'role'=>$this->input->post('type'),
                            'image'=>$image,
                            'metal_id'=>uniqid()
                        );

                         $this->model->update('users', $new_user, 'id', $id);                       
                          $this->session->set_flashdata(array('alert'=>'Updated  ! ', 'alert_type'=>'alert alert-success'));
                         $page =  $this->session->userdata('prev_page');
                          redirect('view/'.$page);
                         
                }
    }

	public function raw_material($id=''){
		if($id==''){
			$id = $this->input->post('edit_id');
			if($id == ''){
						 $this->session->set_flashdata(array('alert'=>'No Identification Detected ! ', 'alert_type'=>'alert alert-danger'));
						redirect('view/raw_material');
					}
		}
		 $this->load->library('form_validation');

                 $this->form_validation->set_rules('supplier_id', 'Supplier ', 'required');
               $this->form_validation->set_rules('type_id', 'Material Type ', 'required');
               $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[3]');
               $this->form_validation->set_rules('desc', 'Description', 'trim');
               $this->form_validation->set_rules('unit', 'Unit', 'required');
               $this->form_validation->set_rules('price', 'Unit Price ', 'required|trim|greater_than[0]');
               $this->form_validation->set_rules('qty', 'Quantity', 'required|trim|greater_than[0]');

                if ($this->form_validation->run() == FALSE)
                {

					$data_array = $this->model->getData('raw_material', 'raw_material_id', $id);
					$data = array('title'=> 'Raw Material', 'subtitle'=>'','error'=> validation_errors());
					$data['type'] = $this->model->getData('raw_material_type', 'status', '1');
					$data['material'] = $data_array[0];
           $data['supplier'] = $this->model->getData('users', 'role', 'supplier');
					$this->load->view('raw_material/raw_material_edit_form', $data);
				}else{

						$id = $this->input->post('edit_id');
					$material= array(
                            'type_id'=> $this->input->post('type_id'),
                             'supplier_id'=> $this->input->post('supplier_id'),
                            'name'=>$this->input->post('name'),
                            'description'=>$this->input->post('desc'),
                            'unit'=>$this->input->post('unit'),
                            'unit_price'=>$this->input->post('price'),
                            'quantity'=>$this->input->post('qty')
                              
                        );

                        $this->model->update('raw_material', $material,'raw_material_id',$id);
                        $this->session->set_flashdata(array('alert'=>'Updated  ! ', 'alert_type'=>'alert alert-primary'));
                       redirect('view/raw_material');
				}	
	}






}



