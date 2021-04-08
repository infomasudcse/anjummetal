<?php  $this->load->view('inc/header'); ?>          

<section class="content-header">
    <h1>
        Report  
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Report </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
       
        <div class="col-xl-12 col-12 pr-0">
           
            <div class="box box-body">
                <div class="row">
                    <div class="col-sm-6">
                         <h3>Production Report </h3>
                     </div>
                 </div>   
                <?php
                        echo form_open('report/show_production_details', array('class'=>'form form-horizontal'));

                ?>
                <div class="form-group row">

        <label for="product_id" class="col-sm-2 col-form-label">Select Product Type</label>
        <div class="col-sm-8">
              <select class="form-control" type="text" name="type_id" id="catSelect" >

                <?php 
                if(!empty($type)){
                  echo '<option value="0">All </option>';
                  foreach($type as $product_type){                     
                     echo '<option value="'.$product_type['product_type_id'].'">'.$product_type['type_name'].'</option>';                    
                  }
                }else{
                  echo '<option>No product type defined ! </option>';
                }
                ?>                              

              </select>

            </div>
            </div>
            <div class="form-group row">
            <label for="product_id" class="col-sm-2 col-form-label">Select Product</label>
            <div class="col-sm-8">
              <select class="form-control" type="text" name="product_id" id="PSelect" >
              </select>
            </div>
          </div>
              
                <div class="form-group row">
                  <label for="dob" class="col-sm-2 col-form-label">From Date </label>
                  <div class="col-sm-6">
                    <input class="form-control" type="date" placeholder="dd-mm-yyyy" name="from"  />
                  </div>
                  
                </div>
                 <div class="form-group row">
                  <label for="dob" class="col-sm-2 col-form-label">To Date </label>
                  <div class="col-sm-6">
                    <input class="form-control" type="date" placeholder="dd-mm-yyyy" name="to"  />
                  </div>
                  
                </div>
                <div class="form-group row">
                  <label for="example-text-textarea" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-info pull-right">Check</button>
                  </div>
                </div>

             </form>
            </div>
            <!-- /.box -->
        </div>

        

    </div>
</section>

<?php  $this->load->view('inc/footer'); ?>
<script>
$(document).ready(function(){
$('#catSelect').change(function(){
  $('#PSelect').html('');
var html = '';
var typeId = $(this).val();
$.post( url+"workstationone/get_product_with_productID", { type_id: typeId })
  .done(function( data ) { 

    $('#PSelect').html('<option value="0">All</option>'+data);
  }); 
});
});
</script>

            