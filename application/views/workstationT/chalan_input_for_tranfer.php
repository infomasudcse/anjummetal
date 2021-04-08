<?php  $this->load->view('workstationtwo/inc/header'); ?>

            <section class="content-header">

                <h1>

                   Spare Parts Description

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

                                    <h2>Create Spare Parts Chalan</h2>

                                    <?php

                                            echo form_open('workstationtwo/createSparePartsChalan', array('class'=>'form form-horizontal' ,'id'=>'final_form'));
                                                $supplier = $this->model->getData('users', 'role', 'supplier');
                                            
                                    ?>
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

                                      <label for="prselect" class="col-sm-2 col-form-label">Select Supplier</label>

                                      <div class="col-sm-6">

                                            <select class="form-control" type="text" name="supplier_id" id="buyerSelect"  required>

                                                  <!--  <option value="">Select Supplier</option>-->

                                            <?php

                                                  if(!empty($supplier)){

                                                    foreach($supplier as $user){

                                                      echo '<option value="'.$user['id'].'">'.$user['full_name'].'</option>';

                                                    }

                                                  }



                                            ?>

                                            

                                        </select>

                                      </div>

                                    </div>
                                     <div class="form-group row"> 
                                        <div class="col-sm-10">

                                            <button type="button" class="btn btn-primary pull-right" id="submit_btn">Save Chalan</button>

                                      </div>

                                    </div>



                                  </form>

                                  </div>

                                </div>

                             </div>


                    </div>

                </div>

            </section>



<?php  $this->load->view('workstationtwo/inc/footer'); ?>

<script>
  
$(document).ready(function(){
  $('#submit_btn').click(function(e){
        var chalan_no = $("#chalan_no").val();
        var ch_date = $("#date").val();
       
        if(chalan_no=='' || ch_date==''){
         
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




            