<?php  $this->load->view('inc/header'); ?>

            <section class="content-header">

                <h1>Accessories Add/Remove</h1>

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

                                     <h3>Add / Remove Accessories</h3>

                                 </div>

                                 <div class="col-sm-6">

                                     
                                 </div>

                             </div> 



                            <div class="row">

                              <div class="col-sm-10">   

                            <?php

                                    echo form_open('new_add/accessories_add_orremove', array('class'=>'form form-horizontal'));



                            ?>



                            <div class="form-group row">

                              <label for="example-text-input" class="col-sm-2 col-form-label"> Select Accessories</label>

                              <div class="col-sm-10">

                                <select name="accessory" class="form-control" required>
                                  <?php 
                                        if($accessories->num_rows() > 0){
                                          foreach ($accessories->result_array() as $value) {
                                              echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                          }
                                        }

                                  ?>
                                </select>

                              </div>

                            </div>
                            <div class="form-group row">

                              <label for="example-text-input" class="col-sm-2 col-form-label"> Quantity</label>

                              <div class="col-sm-10">

                                <input name="qty" class="form-control" type="number" >
                                 
                              </div>

                            </div>
                            <div class="form-group row">
                              <label for="example-text-input" class="col-sm-2 col-form-label"> Select Action</label>

                              <div class="col-sm-10">

                              <div class="radio">
                                  <input type="radio" id="Option_1" name="info" value="add">
                                  <label for="Option_1"> Add </label>                    
                              </div>
                              <div class="radio">
                                  <input type="radio" id="Option_2" name="info" value="remove">
                                  <label for="Option_2"> Remove </label>   
                              </div>

                              <div class="radio">
                                  <input type="radio" id="Option_3" name="info" value="balance" checked="">
                                  <label for="Option_3">Show Balance</label>   
                              </div>

                          </div>
                        </div>

                           

                            <div class="form-group row">

                              <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>

                              <div class="col-sm-10">

                                <button type="submit" class="btn btn-info pull-right">Proceed</button>

                              </div>

                            </div>



                         </form>
                         <hr/>
                       </div>

                     </div>

                       <div class="row">

                        <div class="col-sm-10"> 
                           <h2>Accessories Stock </h2>
                                  <table class="table" id="accessories_stock_table">
                                      <thead>
                                      <tr>
                                          <th>SL.</th>
                                          <th>Name</th>
                                          <th>Added</th>
                                          <th>Removed</th>
                                          <th>Date</th>
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
  
var accessories_stock_table ='';

$(document).ready(function(){


accessories_stock_table = $("#accessories_stock_table").DataTable({ 'ajax': url+'view/get_all_accessories_stock'});

});

</script>
