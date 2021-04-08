<?php  $this->load->view('inc/header'); ?>
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.css"></script>            

            <section class="content-header">
                <h1>
                    EMPLOYEE
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="#">Employee</a></li>
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
                                     <h3>Add Employee</h3>
                                 </div>
                                 <div class="col-sm-6">
                                     <a href="<?=base_url('view/employee_list')?>" class="btn pull-right btn-sm btn-primary">View All</a>
                                 </div>
                             </div>   
                            <?php
                                    echo form_open_multipart('new_add/employee', array('class'=>'form form-horizontal'));

                            ?>

                            <div class="form-group row">
                              <label for="example-text-input" class="col-sm-2 col-form-label">Full Name</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="<?php echo set_value('name'); ?>" id="example-text-input" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label">Mobile</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" id="example-text-textarea" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                              <div class="col-sm-10">
                                <input class="form-control datepicker" type="text" name="dob" value="<?php echo set_value('dob'); ?>" id="dob" required>
                              </div>
                            </div>

                             <div class="form-group row">
                              <label for="nid" class="col-sm-2 col-form-label">NID</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="nid" value="<?php echo set_value('nid'); ?>" id="nid" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="address" class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="address" value="<?php echo set_value('address'); ?>" id="address" required>
                              </div>
                            </div>
                               <div class="form-group row">
                              <label for="comments" class="col-sm-2 col-form-label">Comments</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" name="comments" value="<?php echo set_value('comments'); ?>" id="comments" required>
                              </div>
                            </div>
                               <div class="form-group row">
                              <label for="pic" class="col-sm-2 col-form-label">Picture</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="file" name="image" />
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                              </div>
                            </div>

                         </form>
                        </div>
                        <!-- /.box -->
                    </div>

                    

                </div>
            </section>

<?php  $this->load->view('inc/footer'); ?>
 <script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
            'format':'dd-mm-yyyy'
        });
    });


</script>
            