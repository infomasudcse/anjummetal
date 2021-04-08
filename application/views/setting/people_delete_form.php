<?php  $this->load->view('inc/header'); ?>
<section class="content-header">
<h1> Delete </h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="#">Delete </a></li>
</ol>
</section>
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

<div class="row">

<div class="col-sm-12">

<div class="box box-body">
    <h2>Delete </h2>

  <?php

          echo form_open('delete/people_delete_form', array('class'=>'form form-horizontal' ,'id'=>'final_form'));

  ?>
    
  <div class="form-group row">
    <label for="prselect" class="col-sm-2 col-form-label">Select People *</label>
    <div class="col-sm-6">
          <select class="form-control" name="type" id="prselect"  required>
                  <option value="0">Select people </option>
                  <option value="buyer">Buyer</option>
                  <option value="supplier">Supplier </option>
         
      </select>
    </div>  
  </div>  
  <div class="form-group row">
    <label for="peopleSelect" class="col-sm-2 col-form-label">Select Buyer/ Supplier *</label>
    <div class="col-sm-6">
          <select class="form-control"  name="people_id" id="peopleSelect"  required>
                  <option value="">Select People First </option>
         
      </select>
    </div>
   
  </div>
  <div class="row">
    <div class="col-2 col-form-level">Select Delete Type * </div>
    <div class="col-10">
<div class="form-group">
  <div class="radio">
      <input type="radio" id="Option_1" name="info" value="all">
      <label for="Option_1">All (Information, Ladger, Account, Chalans )</label>                    
  </div>
  <div class="radio">
      <input type="radio" id="Option_2" name="info" value="only">
      <label for="Option_2"> Activity( Ladger, Account, Chalans )</label>   
  </div>

  <div class="radio">
      <input type="radio" id="Option_3" name="info" value="account" checked>
      <label for="Option_3"> Account( Ladger, Account)</label>   
  </div>

    </div>
  </div>
 </div> 


 <div class="form-group row">
  <label for="prselect" class="col-sm-2 col-form-label"></label>
  
  <div class="col-sm-10">
       <button onClick="return confirm('Are You Sure ? ')" type="submit" class="btn btn-primary pull-right" id="submit_btn">Proceed..</button>
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
$('#prselect').change(function(){
  $('#peopleSelect').html('');
var html = '';
var typeId = $(this).val();
$.post( url+"delete/get_people_with_type", { type_id: typeId })
  .done(function( data ) {    
    $('#peopleSelect').html(data);
  }); 
});
});
</script>




            