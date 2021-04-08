<?php  $this->load->view('inc/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/plugin/sweetalert/sweetalert.css">
<style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{background-color:#398bf794;}
  .form-horizontal{padding:30px;}
  .blue{color:blue;font-weight:bold;}
</style>
<section class="content-header">
    <h1> Supplier Payments </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Paymets </a></li>
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
                ?>
            </div> 
        </div>
        <div class="col-xl-12 col-12 pr-0">
          <div class="row">
               <div class="col-sm-12"><a href="<?=base_url()?>new_add/save_supplier_payment" class="btn btn-info pull-right">Add Debit/Credit </a></div>


            <div class="col-sm-12">
             <div class="box box-default">
                 
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- Nav tabs -->
              
              <!-- Tab panes -->
              
                    <h3>All Payments</h3>
                      <table class="table" id="supplier_paymets_table">
                        <thead>
                          <tr>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Sale/Payment</th>                         
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Goods</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        
                      </table>
                  
               
                  </div>
                  <!-- /.box-body -->
                </div>

            </div>

         </div>  

        </div>

    </div>

</section>



<?php  $this->load->view('inc/footer'); ?>

 <script src="<?=base_url()?>assets/plugin/sweetalert/sweetalert.min.js"></script>

 
<script>
   var supplier_paymets_table='';
$(document).ready(function(){

  
  supplier_paymets_table =  $('#supplier_paymets_table').DataTable({
      'ajax': url+'view/supplier_paymets_table'
   });
 
});
$(document).on('click', '.blue' , function(){
    
    var title = $(this).attr('title');
    var res = title.replaceAll('/', "<br>");
    var newHtml = '<b>'+res+'</b> ';
     swal({ 
             html:true,
             title: "Details !  ", 
             text: newHtml,
                      
             closeOnCancel: true              
             });
});

$(document).on('click', '.delete_btn' , function(){
    var dataId = $(this).attr('data-id');
    var title = $(this).attr('data-buyer');
    var newHtml = ' Are You Sure to Delete the Payment of <b>'+title+'</b> ? ';
     swal({ 
             html:true,
             title: "Confirmation !  ", 
             text: newHtml,
             showCancelButton: true, 
             confirmButtonColor: "#f44336", 
             cancelButtonColor: "#D9534F", 
             confirmButtonText: "Yes, Delete", 
             cancelButtonText: "Cancel", 
             closeOnConfirm: false, 
             closeOnCancel: true ,
               showLoaderOnConfirm: true
             }, function(isConfirm){ 
                 if (isConfirm) {
                            $.post(url+'delete/delete_supplier_payments',{ payment_id:dataId},function(obj){
                                    
                                     if(obj.rs== '1'){
                                     swal("Success!", obj.msg, "success"); 
                                           supplier_paymets_table.ajax.reload();
                                     }else{
                                     swal("Failed!", obj.msg, "error"); 
                                    }
                                });
                 } 
        });
});



$(document).on('click', '.verify_btn' , function(){
    var dataId = $(this).attr('data-id');
    var title = $(this).attr('data-buyer');
    var newHtml = ' Are You Sure to Verify the Payment of <b>'+title+'</b> ? ';
     swal({ 
             html:true,
             title: "Confirmation !  ", 
             text: newHtml,
             showCancelButton: true, 
             confirmButtonColor: "#f44336", 
             cancelButtonColor: "#D9534F", 
             confirmButtonText: "Yes, Verify", 
             cancelButtonText: "Cancel", 
             closeOnConfirm: false, 
             closeOnCancel: true ,
               showLoaderOnConfirm: true
             }, function(isConfirm){ 
                 if (isConfirm) {
                            $.post(url+'report/verify_supplier_payments',{ payment_id:dataId},function(obj){
                                    
                                     if(obj.rs== '1'){
                                     swal("Success!", obj.msg, "success"); 
                                           supplier_paymets_table.ajax.reload();
                                     }else{
                                     swal("Failed!", obj.msg, "error"); 
                                    }
                                });
                 } 
        });
    
});



</script>




            