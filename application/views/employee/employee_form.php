<?php  $this->load->view('inc/header'); ?>

<script src="<?=base_url()?>assets/css/bootstrap-datepicker.css"></script>            



            <section class="content-header">

                <h1>

                    PEOPLE

                </h1>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="breadcrumb-item active"><a href="#">People</a></li>

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

                                     <h3>Add People</h3>

                                 </div>

                                 <div class="col-sm-6">

                                     

                                 </div>

                             </div>   

                            <?php

                                    echo form_open_multipart('new_add/people', array('class'=>'form form-horizontal'));



                            ?>

                            <div class="form-group row">

                              <label for="examplput" class="col-sm-2 col-form-label">People Type</label>

                              <div class="col-sm-10">

                                <select class="form-control" name="type" id="examplput" required>

                                    <option value="0">Select People Type First</option>

                                    <option value="buyer">Buyer</option>                                   

                                    <option value="staff">Staff</option>

                                    <option value="supplier">Supplier</option>



                                </select>

                              </div>

                            </div>

                            

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

                                <input class="form-control datepicker" type="text" placeholder="dd-mm-yyyy" name="dob" value="<?php echo set_value('dob'); ?>" id="dob" />

                              </div>

                            </div>



                             <div class="form-group row">

                              <label for="nid" class="col-sm-2 col-form-label">NID</label>

                              <div class="col-sm-10">

                                <input class="form-control" type="text" name="nid" value="<?php echo set_value('nid'); ?>" id="nid" />

                              </div>

                            </div>



                            <div class="form-group row">

                              <label for="address" class="col-sm-2 col-form-label">Address</label>

                              <div class="col-sm-10">

                                <input class="form-control" type="text" name="address" value="<?php echo set_value('address'); ?>" id="address" />

                              </div>

                            </div>

                               <div class="form-group row">

                              <label for="comments" class="col-sm-2 col-form-label">Comments</label>

                              <div class="col-sm-10">

                                <input class="form-control" type="text" name="comments" value="<?php echo set_value('comments'); ?>" id="comments" />

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





        $('#examplput').blur(function(){

          var select = $('#examplput').val();

          if(select === '0'){

            $('#examplput').css('border','1px solid red');

          }

        });

         $('#examplput2').blur(function(){

          var select = $('#examplput2').val();

          if(select === '0'){

            $('#examplput2').css('border','1px solid red');

          }

        });

    });





</script>

            