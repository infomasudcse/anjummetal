<?php  $this->load->view('workstationone/inc/header'); ?>

            <section class="content-header">

                <h1>

                   Raw Material Old

                </h1>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="breadcrumb-item active"><a href="#">New chalan </a></li>

                </ol>

            </section>
            <!-- Main content -->

            <section class="content">

                <div class="row">
                     
                    <div class="col-xl-12 col-12 pr-0">

                        <div id="alert_div">

                            <?php 

                                    $staff = $this->session->userdata('user_info');

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

                              <div class="row">
                               

                                <div class="col-sm-12">

                                  <div class="box box-body">

                                    <h2>Create Chalan</h2>

                                    <?php

        echo form_open('workstationone/oldRawMaterial', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

                                            
                                    ?>

      
            
                <div class="form-group row">

                    <label for="totweight" class="col-sm-2 col-form-label">Total Weight. </label>

                    <div class="col-sm-6">

                          <input class="form-control" type="number" step="0.001" name="totweight" value="<?php echo set_value('totweight'); ?>" id="totweight" placeholder="000" autocomplete="off" required>

                    </div>

                </div>
         
                                     <div class="form-group row">

                                        <label for="date" class="col-sm-2 col-form-label"> </label>

                                        <div class="col-sm-6"></div>
                                         <div class="col-sm-4">
                                             <input id="submit_btn" class="btn btn-primary" type="submit" >
                                      </div>

                                    </div>

                                  </form>

                                  </div>

                                </div>

                             </div>

                        

                    </div>



                    



                </div>

            </section>



<?php  $this->load->view('workstationone/inc/footer'); ?>




            