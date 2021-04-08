<?php  $this->load->view('inc/header'); ?>

            



            <section class="content-header">

                <h1>

                    DEPARTMENT

                </h1>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="breadcrumb-item active"><a href="#">Department</a></li>

                </ol>

            </section>



            <!-- Main content -->

            <section class="content">

                <div class="row">

                    <div class="col-sm-12">

                      

                        <div class="row">

                            <div class="col-xl-12 col-12 pr-0">

                                <div class="">

                                    <?php 

                                            

                                            $alert = $this->session->flashdata('alert');

                                            $alert_type = $this->session->flashdata('alert_type');

                                            

                                        if($alert!=''){

                                            echo '<div class="'.$alert_type.'">'.$alert.'</div>';

                                        }



                                        if(isset($error)){

                                            echo '<div class="alert alert-danger">'.$error.'</div>';

                                        }

                                    ?>

                                </div>

                                <!-- /.box -->

                            </div>

                            <div class="col-xl-12 col-12 pr-0">

                               

                                <div class="box box-body">

                                   



                                    <!-- <div class="row">

                                      <div class="col-sm-10">   

                                    <php

                                            echo form_open('new_add/new_department', array('class'=>'form form-horizontal'));



                                    ?>



                                    <div class="form-group row">

                                      <label for="example-text-input" class="col-sm-2 col-form-label">Department Name</label>

                                      <div class="col-sm-10">

                                        <input class="form-control" type="text" name="name" value="<?php echo set_value('name'); ?>" id="example-text-input" required>

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

                             </div> -->





                                </div>

                                <!-- /.box -->

                            </div>





                        </div>

                    </div>

                    <div class="col-sm-12">

                       <div class="box box-body">

                         <table id="department_table" class="display table table-bordered" cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>Department Name</th>                                       

                                        <th>Action</th>

                                      

                                        

                                    </tr>

                                </thead>

                        </table>

                      </div>



                    </div>

                </div>







                









            </section>



<?php  $this->load->view('inc/footer'); ?>



            