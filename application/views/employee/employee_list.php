<?php  $this->load->view('inc/header'); ?>

            



            <section class="content-header">

                <h1>

                    Employee List

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

                            ?>

                        </div>

                        <!-- /.box -->

                    </div>

                    <div class="col-xl-12 col-12 pr-0">

                      

                        <div class="box box-body">

                            <div class="row">

                                <div class="col-sm-6">

                                     <h3>Employee</h3>

                                 </div>

                                 <div class="col-sm-6">

                                     <a href="<?=base_url('new_add/new_employee')?>" class="btn btn-sm pull-right btn-primary">Add New</a>

                                 </div>

                             </div>   

                            <table id="employee_list" class="display table table-bordered" cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>Job Start</th>

                                        <th>Full Name</th>

                                        <th>Mobile</th>

                                        <th>Department</th>

                                        <th>Production</th>                                       

                                        <th>Status</th>

                                        <th>Action.</th>                                        

                                    </tr>

                                </thead>

                               

                        </table>



                        </div>

                        <!-- /.box -->

                    </div>



                    



                </div>

            </section>



<?php  $this->load->view('inc/footer'); ?>



            