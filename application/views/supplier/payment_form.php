<?php  $this->load->view('inc/header'); ?>


<section class="content-header">
<h1>  Supplier  Debit /  Credit  </h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="#">Supplier </a></li>
</ol>
</section>
<section class="content">

<div class="row">

<div class="col-xl-12 col-12 pr-0">

<div class="">

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
    <h2>Add To Supplier Ladger</h2>

  <?php

          echo form_open('new_add/save_supplier_payment', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

            $supplier = get_people_of_branch('supplier');

  ?>
     <div class="form-group row">
    <label for="prselect" class="col-sm-2 col-form-label"></label>
    
    <div class="col-sm-10">
        <a href="<?=base_url('view/supplier_list')?>" class="btn pull-right btn-sm btn-info">Supplier</a>
         <a href="<?=base_url('view/supplier_payment_list')?>" class="btn btn-sm pull-right btn-success" style="margin:0px 10px" >Payment History</a>
    </div>
  </div>

  <div class="form-group row">
    <label for="prselect" class="col-sm-2 col-form-label">Select Supplier *</label>
    <div class="col-sm-6">
          <select class="form-control"  name="buyer_id" id="buyerSelect"  required>
                  <option value="">Select Supplier </option>
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
    <label for="material" class="col-sm-2 col-form-label">Select Material </label>
    <div class="col-sm-6">
          <select class="form-control"  name="material" id="material" >
                  <option value="0">Select Material </option>
          <?php

                if(!empty($material)){

                  foreach($material as $mat){

                    echo '<option value="'.$mat['type_id'].'">'.$mat['type_name'].'</option>';

                  }
                }
          ?>                    

      </select>
    </div>   
  </div>

  <div class="form-group row">
    <label for="weight" class="col-sm-2 col-form-label"> Total Weight </label>
    <div class="col-sm-6">
          <input class="form-control" type="number" step="0.001" name="weight" id="weight" placeholder="000"/>
    </div>
    
  </div>







  <div class="form-group row">
    <label for="Account" class="col-sm-2 col-form-label">Account Type *</label>
    <div class="col-sm-6">
    <select class="form-control"  name="account_type" id="Account"  required>
    <option value="debit">Debit</option>
    <option value="credit">Credit</option>
                                

    </select>
    </div>
</div>

  <div class="form-group row">
    <label for="prselect" class="col-sm-2 col-form-label"> Amount *</label>
    <div class="col-sm-6">
          <input class="form-control" type="number" name="amount" id="buyeramount" placeholder="000" required/>
    </div>
    
  </div>
  
<div class="form-group row">
  <label for="prselect" class="col-sm-2 col-form-label"> Date *</label>
  <div class="col-sm-6">
  <input class="form-control datepicker" type="date" name="paymentdate" id="paymentdate"  required/>
</div>

</div>

<div class="form-group row">
<label for="to_customer" class="col-sm-2 col-form-label">type *</label>
<div class="col-sm-6">
<select class="form-control" type="text" name="payment_type" id="payment_type"  required>
<option value="cash">Cash</option>
<option value="cheque">Cheque</option>
                            

</select>
</div>
</div>


<div class="form-group row" id="extradiv" style="display:none;">

<div class="col-sm-3">
  <label for="name" class="col-form-label">Bank Name *</label>
  <input class="form-control" type="text" name="bankname" id="name" />
</div>
 <div class="col-sm-3">
  <label for="cnumber" class="col-form-label">Cheque Number *</label>
  <input class="form-control" type="text" name="chequenumber" id="cnumber" />
</div>
 <div class="col-sm-3">
  <label for="checkdate" class="col-form-label">Check Date *</label>
  <input class="form-control" type="date" name="checkdate" id="checkdate" />
</div>

</div>

 <div class="form-group row">
  <label for="prselect" class="col-sm-2 col-form-label"></label>
  
  <div class="col-sm-10">
       <button onClick="return confirm('Are You Sure ? ')" type="submit" class="btn btn-primary pull-right" id="submit_btn">Save</button>
  </div>
</div>


</form>

</div>

</div>

</div>





<div class="row">

<div class="col-sm-9">





</div>

</div>  





</div>







</div>

</section>



<?php  $this->load->view('inc/footer'); ?>

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

});

</script>




            