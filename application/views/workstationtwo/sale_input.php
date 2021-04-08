<?php  $this->load->view('workstationtwo/inc/header'); ?>

<section class="content-header">

    <h1>

       SALE

    </h1>

    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="breadcrumb-item active"><a href="#">Sale </a></li>

    </ol>

</section>
            <!-- Main content -->

<section class="content">

<div class="row">
     <div class="col-sm-12"> <a class="btn btn-info pull-right" href="<?=base_url()?>workstationtwo/sale_product"> <<-- Back</a></div>
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

            <h2>Sale Invoice</h2>

            <?php

                    echo form_open('workstationtwo/final_sale_chalan', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

                     $customer = $this->model->getData('users', 'role', 'buyer');
            ?>
                <div class="form-group row">

                <label for="to_customer" class="col-sm-2 col-form-label">Sale To </label>

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

                <label for="chalan_no" class="col-sm-2 col-form-label">Invoice No. </label>

                <div class="col-sm-6">

                      <input class="form-control" type="text" name="chalan_no" value="<?php echo set_value('chalan_no'); ?>" id="chalan_no" placeholder="000" autocomplete="off" required>

                </div>

            </div>

            <div class="form-group row">

                <label for="date" class="col-sm-2 col-form-label">Invoice Date. </label>

                <div class="col-sm-6">

                      <input class="form-control datepicker" type="date" name="chalan_date" value="<?php echo set_value('chalan_date'); ?>" id="date" placeholder="000" autocomplete="off" required>

                </div>

            </div>
            <div class="form-group row">

                <label for="other_expense" class="col-sm-2 col-form-label">Other Expense. </label>

                <div class="col-sm-6">

                      <input class="form-control" type="number" name="other_expense" value="<?php echo set_value('other_expense'); ?>" id="other_expense" value="0" autocomplete="off" required>

                </div>

            </div>

             <div class="form-group row">

                <label for="discount" class="col-sm-2 col-form-label">Discount </label>

                <div class="col-sm-6">

                      <input class="form-control" type="number" name="discount" value="<?php echo set_value('discount'); ?>" id="discount" value="0" autocomplete="off" required>

                </div>

            </div>

           <hr/> 

              <div class="form-group row">

                <label for="date" class="col-sm-2 col-form-label">Payment </label>

                <div class="col-sm-6">

                      <input class="form-control " type="number" name="payment" value="<?php echo set_value('payment'); ?>" id="payment" placeholder="000" autocomplete="off" required>

                </div>

            </div>
              <div class="form-group row">

                <label for="to_customer" class="col-sm-2 col-form-label">Payment type </label>

                <div class="col-sm-6">

                     <select class="form-control" type="text" name="payment_type" id="payment_type"  required>
                           <option value="cash">Cash</option>
                           <option value="cheque">Cheque</option>
                           <option value="TT">TT</option>
                           <option value="rejection">Rejection</option>                             

              </select>

                </div>
              </div>
              
              <div class="form-group row" id="extradiv" style="display:none;">
                
                <div class="col-sm-3">
                  <label for="name" class="col-form-label">Bank Name *</label>
                  <input class="form-control" type="text" name="bankname" id="name" />
                </div>
                 <div class="col-sm-3">
                  <label for="cnumber" class="col-form-label">Cheque/TT Number *</label>
                  <input class="form-control" type="text" name="chequenumber" id="cnumber" />
                </div>
                 <div class="col-sm-3">
                  <label for="checkdate" class="col-form-label">Check Date * </label>
                  <input class="form-control" type="date" name="checkdate" id="checkdate" />
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

    </div>
  </div>
</section>



<?php  $this->load->view('workstationtwo/inc/footer'); ?>

<script>
  
$(document).ready(function(){


  
      $( "#payment_type" ).change(function() {
        var selected = $(this).val();
        if(selected =='cheque' || selected == 'TT'){
            $("#extradiv").slideDown();
        }else{
          $("#extradiv").slideUp();
        }
       
      });
  


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




            