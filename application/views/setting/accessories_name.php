<?php  $this->load->view('inc/header'); ?>

            <section class="content-header">

                <h1>Accessories</h1>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="breadcrumb-item active"><a href="#">Accessories</a></li>

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

                                     <h3>Add New Accessories</h3>

                                 </div>

                                 <div class="col-sm-6">

                                     
                                 </div>

                             </div> 



                            <div class="row">

                              <div class="col-sm-10">   

                            <?php

                                    echo form_open('new_add/new_accessories_name', array('class'=>'form form-horizontal'));



                            ?>



                            <div class="form-group row">

                              <label for="example-text-input" class="col-sm-2 col-form-label"> Name</label>

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

                     </div>

                       <div class="row">

                              <div class="col-sm-10"> 
                                <h2>Accessories Name </h2>
                                  <table class="table" id="accessories_name_table">
                                      <thead>
                                      <tr>
                                          <th>SL.</th>
                                          <th>Name</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                    </thead>
                                  </table>

                              </div>
                        </div>      

                        </div>

                        <!-- /.box -->

                    </div>



                    



                </div>

            </section>



<?php  $this->load->view('inc/footer'); ?>
<script>
  
var accessories_name_table ='';

$(document).ready(function(){


accessories_name_table = $("#accessories_name_table").DataTable({ 'ajax': url+'view/get_all_accessories_name'});

});

</script>