<?php  $this->load->view('workstationtwo/inc/header'); ?>

            <section class="content-header">

                <h1>

                   Scarb chalan

                </h1>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="breadcrumb-item active"><a href="#">Chalan </a></li>

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

                                    <h2>Scrab Chalan</h2>

                                    <?php

                                            echo form_open('workstationtwo/scrabChalan', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

                                             $customer = $this->model->getData('users', 'role', 'buyer');
                                    ?>
                                        <div class="form-group row">

                                        <label for="to_customer" class="col-sm-2 col-form-label">Delivery To </label>

                                        <div class="col-sm-6">

                                              <select class="form-control" type="text" name="to_customer" id="to_customer"  required>
                                                       <?php

                                                  if(!empty($customer)){

                                                    foreach($customer as $user){

                                                      echo '<option value="'.$user['id'].'">'.$user['full_name'].'</option>';

                                                    }

                                                  }



                                            ?>

                                                                                                

                                          </select>

                                        </div>
                                      </div>

                                      <div class="form-group row">

                                        <label for="chalan_no" class="col-sm-2 col-form-label">Chalan No. </label>

                                        <div class="col-sm-6">

                                              <input class="form-control" type="text" name="chalan_no" value="<?php echo set_value('chalan_no'); ?>" id="chalan_no" placeholder="000" autocomplete="off" required>

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label for="date" class="col-sm-2 col-form-label">Chalan Date. </label>

                                        <div class="col-sm-6">

                                              <input class="form-control datepicker" type="date" name="chalan_date" value="<?php echo set_value('chalan_date'); ?>" id="date" placeholder="000" autocomplete="off" required>

                                        </div>

                                    </div>
                                       <div class="form-group row">

                                        <label for="product_id" class="col-sm-2 col-form-label">Select Product</label>

                                        <div class="col-sm-6">

                                              <select class="form-control" type="text" name="product_id" id="buyerSelect"  required>

                                                      <?php 
                                                          if(!empty($product_type)){
                                                            foreach($product_type as $product){
                                                              echo '<option value="'.$product['id'].'">'.$product['name'].'</option>';
                                                            }
                                                          }

                                                      ?>                                           

                                          </select>

                                        </div>
                                      </div>
                                       
                                    <div class="form-group row">

                                      <label for="qty" class="col-sm-2 col-form-label">Quantity</label>

                                      <div class="col-sm-6">

                                            <input class="form-control" type="text" name="qty" value="<?php echo set_value('qty'); ?>" id="qty" placeholder="0"  autocomplete="off"  required>

                                      </div>

                                    </div>

                                     <div class="form-group row">

                                        <label for="unit" class="col-sm-2 col-form-label">Select Unit</label>

                                        <div class="col-sm-6">

                                              <select class="form-control" type="text" name="unit" id="unit"  required>

                                                     <option value="Kg">Kg</option>     
                                                   
                                          </select>

                                        </div>
                                      </div>  
                                   

                                         
                                     <div class="form-group row"> 
                                        <div class="col-sm-10">

                                            <button type="button" class="btn btn-primary pull-right" id="submit_btn">Finish</button>

                                      </div>

                                    </div>



                                  </form>

                                  </div>

                                </div>

                             </div>

                        

                           

                             <div class="row">

                                 

                             </div>  

                        

                        

                    </div>



                    



                </div>

            </section>



<?php  $this->load->view('workstationthree/inc/footer'); ?>

<script>
  
$(document).ready(function(){
  $('#submit_btn').click(function(e){
        var chalan_no = $("#chalan_no").val();
        var ch_date = $("#date").val();
        var val = $('#to_customer').val();
        if(chalan_no=='' || ch_date==''|| val==''){
         
            $("#alert_div").html('<div class="alert alert-danger">Check Input Fields ! </div>');
        }else{
      
        if(confirm('Ar You Sure To Proceed ?')){
            $('#final_form').submit();
        }else{
          return false;
        }
      }
  });
});

</script>




            