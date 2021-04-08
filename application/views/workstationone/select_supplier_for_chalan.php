<?php  $this->load->view('workstationone/inc/header'); ?>

            <section class="content-header">

                <h1>

                   Raw Material Description

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

                                            echo form_open('workstationone/createMaterialChalan', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

                                            
                                    ?>

      <div class="form-group row">

          <label for="prselect" class="col-sm-2 col-form-label">Select Supplier</label>

          <div class="col-sm-6">

            <select class="form-control" type="text" name="supplier_id" id="buyerSelect"  required>
              <option value="">Select Supplier</option>
                 <?php
                      if(!empty($supplier)){
                        foreach($supplier as $user){
                            echo '<option value="'.$user['id'].'">'.$user['full_name'].'</option>';
                        }
                      }
                  ?>
            </select>
          </div>
         <div class="col-sm-4">
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

<script>
  
$(document).ready(function(){
     $( "#payment_type" ).change(function() {
        var selected = $(this).val();
        if(selected =='cheque'){
            $("#extradiv").slideDown();
        }else{
          $("#extradiv").slideUp();
        }
       
      });
  

  $('#submit_btn').click(function(e){
        var chalan_no = $("#chalan_no").val();
        var ch_date = $("#date").val();
        var val = $('#buyerSelect').val();
        console.log(chalan_no+ch_date+val);
        if(chalan_no=='' || ch_date=='' || val==''){
            console.log('heree');
            $("#alert_div").html('<div class="alert alert-danger">Check Input Fields ! </div>');
        }else{
        //var confirm = confirm('Ar You Sure To Proceed ?');
        if(confirm('Ar You Sure To Proceed ?')){
            $('#final_form').submit();
        }else{
          return false;
        }
      }
  });
});

</script>




            