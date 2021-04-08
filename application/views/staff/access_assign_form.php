<?php  $this->load->view('inc/header'); ?>
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.css"></script>            

            <section class="content-header">
                <h1>
                    STAFF
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Staff</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-12 col-12 pr-0">
                        <div class="">
                            <?php 
                                    $alert = $this->session->flashdata('alert');
                                    $alert_type = $this->session->flashdata('alert_type');
                                    
                                if($alert!=''){
                                    echo '<div class="'.$alert_type.'">'.$alert.'</div>';
                                }

                                if($error!=''){
                                    echo '<div class="alert alert-danger">'.$error.'</div>';
                                }
                            ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-xl-12 col-12 pr-0">
                       
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                     <h3>Add Acess Information</h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/staff_list')?>" class="btn pull-right btn-sm btn-primary">Cancel</a>
                                 </div>
                             </div>   
                            <?php
                                    echo form_open_multipart('new_add/staff_info_add', array('class'=>'form form-horizontal'));

                                    $sql = $this->db->get('branch');
                                    $br = $sql->result_array();

                            ?>
                              <input type="hidden" name="edit_id" value="<?=$edit_id;?>" />
                              <div class="form-group row">
                              <label for="user" class="col-sm-2 col-form-label">Select Branch</label>
                              <div class="col-sm-10">
                                  <select class="form-control" type="text" name="branch" id="branch"  required>
                                  <option value="">Select Branch</option>
                                    <?php
                                    if(!empty($br)){
                                      foreach($br as $branch){

                                        echo '<option value="'.$branch['id'].'">'.$branch['name'].'</option>';


                                      }
                                    }

                                 ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="dept" class="col-sm-2 col-form-label">Select Department</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="dep" id="dept" required>
                                  <?php 
                                          if(is_array($dep) && !empty($dep)){
                                              foreach($dep as $dp){
                                                echo '<option value="'.$dp['department_id'].'">'.$dp['department_name'].'</option>';
                                              }
                                          }else{
                                            echo '<option value="0">No Employee Salary Type Define ! </option>';
                                          }

                                  ?>
                                   
                                </select>
                              </div>
                            </div>

                                

                            <div class="form-group row">
                              <label for="user" class="col-sm-2 col-form-label">Username</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" id="user" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="pass" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="password" name="pass"  id="pass" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="conf" class="col-sm-2 col-form-label">Confirm Password</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="password" name="conf"  id="conf" required>
                              </div>
                            </div>
                           

                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-info pull-right">Assign</button>
                              </div>
                            </div>

                         </form>
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>
 

            